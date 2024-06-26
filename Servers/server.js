const express = require("express")
const mysql = require("mysql2")
const cors = require("cors") 
const path = require("path")
require("dotenv").config({ path: path.join(__dirname, ".env") })

const app = express()

// Define allowed origins
const allowedOrigins = ["https://www.viktorina.live", "https://www.viktorina.fun", "http://localhost"]

// CORS options
const corsOptions = {
  origin: (origin, callback) => {
    if (!origin || allowedOrigins.includes(origin)) {
      callback(null, true)
    } else {
      callback(new Error("Not allowed by CORS"))
    }
  }
}

// Use cors middleware
app.use(cors(corsOptions))

let cachedData = null
let bonusLita = 0
let count = 0

const connectionPool = mysql.createPool({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_DATABASE,
  port: process.env.DB_PORT
})

const generateBonus = () => {
  const interval = Math.floor(Math.random() * 30000) + 40000

  setTimeout(() => {
    bonusLita = Math.floor(Math.random() * 5) * 10 + 10
    console.log(`Generated bonus: ${bonusLita}`)
    setTimeout(() => {
      bonusLita = 0
      console.log(`Removed bonus: ${bonusLita}`)
    }, 5000)
    count++
    if (count < 10000000) {
      generateBonus()
    }
  }, interval)
}
generateBonus()

const refreshData = (callback) => {
  connectionPool.getConnection((err, connection) => {
    if (err) {
      console.error("Error getting connection:", err)
      return
    }

    const sql = "SELECT id, question, answer FROM main_database WHERE LENGTH(question) - LENGTH(REPLACE(question, ' ', '')) + 1 <= 21 ORDER BY RAND() LIMIT 1"

    connection.query(sql, (err, results) => {
      if (err) {
        connection.release()
        throw err
      }

      const randomNumber = Math.floor(Math.random() * 5) + 1

      if (cachedData) {
        saveOldData(connection, cachedData) // Save old data before refreshing
      }

      cachedData = {
        ...results[0],
        lita: randomNumber,
        bonusLita: bonusLita
      }

      console.log(cachedData)
      console.log(cachedData.id)
      connection.release()
      callback(cachedData)
    })
  })
}

const saveOldData = (connection, oldData) => {
  const sql = "INSERT INTO old_qna (old_id, old_question, old_answer, timestamp) VALUES (?, ?, ?, NOW())" // Use NOW() to insert the current timestamp

  const values = [oldData.id, oldData.question, oldData.answer]

  connection.query(sql, values, (err, results) => {
    if (err) {
      console.error("Error saving old data:", err)
    } else {
      console.log("Old data saved:", oldData)
    }
  })
}

let previousLitaiSum = null
let lastRefreshTime = null

const checkLitaiSum = () => {
  const connection = mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_DATABASE,
    port: process.env.DB_PORT
  })

  setInterval(() => {
    connectionPool.getConnection((err, connection) => {
      if (err) {
        console.error("Error getting connection:", err)
        return
      }

      const sql = "SELECT litai_sum FROM super_users"

      connection.query(sql, (err, results) => {
        connection.release() // Release the connection when done

        if (err) throw err

        const litaiSums = results.map((result) => result.litai_sum)
        const totalLitaiSum = litaiSums.reduce((sum, litaiSum) => sum + litaiSum, 0)

        console.log(`Total litai sum: ${totalLitaiSum}`)

        if (previousLitaiSum !== null && totalLitaiSum !== previousLitaiSum) {
          lastRefreshTime = new Date()
          refreshData((data) => {
            cachedData = data
          })
        }

        previousLitaiSum = totalLitaiSum
      })
    })

    console.log("Checking litai_sum at", new Date())
  }, 1000)

  setInterval(() => {
    const currentTime = new Date()
    if (lastRefreshTime === null || currentTime - lastRefreshTime >= 45000) {
      lastRefreshTime = currentTime
      if (cachedData) {
        refreshData((data) => {
          cachedData = data
        })
      }
    }
  }, 45000) // Interval of 45 seconds
}

checkLitaiSum()

//
const MAX_OLD_QNA_COUNT = 100

const checkAndManageOldQnaCount = () => {
  const connection = mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_DATABASE,
    port: process.env.DB_PORT
  })

  connection.connect((err) => {
    if (err) {
      console.error("Error connecting to database:", err)
      return
    }

    const countQuery = "SELECT COUNT(*) AS qnaCount FROM old_qna"
    connection.query(countQuery, (err, results) => {
      if (err) {
        console.error("Error querying database:", err)
        connection.end()
        return
      }

      const qnaCount = results[0].qnaCount
      console.log(`Total IDs in old_qna: ${qnaCount}`)

      const recordsToDelete = qnaCount - MAX_OLD_QNA_COUNT

      if (recordsToDelete > 0) {
        const deleteQuery = `DELETE FROM old_qna ORDER BY id LIMIT ${recordsToDelete}`
        connection.query(deleteQuery, (err, results) => {
          if (err) {
            console.error("Error deleting records from old_qna:", err)
          } else {
            console.log(`${recordsToDelete} old records deleted from old_qna`)
          }
          connection.end()
        })
      } else {
        connection.end()
      }
    })
  })
}
setInterval(checkAndManageOldQnaCount, 600000) // 10 Minutes

app.get("/old-data", (req, res) => {
  console.log("Fetching old question data...")

  connectionPool.getConnection((err, connection) => {
    if (err) {
      console.error("Error getting connection:", err)
      return res.status(500).json({ error: "Error getting database connection" })
    }

    const sql = "SELECT old_id, old_question, old_answer, timestamp FROM old_qna ORDER BY id DESC LIMIT 50" // 50 Old klausimu siuncia i a_index.js

    connection.query(sql, (err, results) => {
      connection.release()

      if (err) {
        console.error("Error querying old data:", err)
        return res.status(500).json({ error: "Error querying old data" })
      }

      console.log("Fetched old question data:", results)

      return res.json({ oldData: results })
    })
  })
})

app.get("/data", (req, res) => {
  if (!cachedData) {
    refreshData((data) => {
      cachedData = data
      res.send({
        data: cachedData
      })
    })
  } else {
    res.send({
      data: cachedData
    })
  }
})

const PORT = process.env.PORT1
app.listen(PORT, () => {
  console.log(`Server <main-server> is connected to: http://localhost:${PORT}`)
})

//
//  node server.js

// Start a Node.js Script: pm2 start startServers.pm2.json
// List Running Processes: pm2 list
// View Logs for a Process: pm2 logs
// Monitor CPU/Memory Usage: pm2 monit
// pm2 restart all
// pm2 delete <pid> 1
