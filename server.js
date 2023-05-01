const express = require("express")
const mysql = require("mysql2")
const app = express()
const port = 3000

app.use(function (req, res, next) {
  res.header("Access-Control-Allow-Origin", "*")
  res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept")
  next()
})

let cachedData = null
let bonusLita = 0
let count = 0

const generateBonus = () => {
  const interval = Math.floor(Math.random() * 30000) + 30000 // Generate a random interval in milliseconds between 30000 and 60000 [Gal dar reikes tobulinti]

  setTimeout(() => {
    bonusLita = Math.floor(Math.random() * 5) * 10 + 10 // Generuoja random bonus tarp 10 and 50
    console.log(`Generated bonus: ${bonusLita}`)
    setTimeout(() => {
      bonusLita = 0
      console.log(`Removed bonus: ${bonusLita}`) // Pasalina Bonus po 5 sekundziu
    }, 5000)
    count++
    if (count < 10000000) {
      generateBonus()
    }
  }, interval)
}
generateBonus()

const refreshData = (callback) => {
  const connection = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "viktorina"
  });

  connection.connect();

  const sql = "SELECT id, question, answer FROM main_database WHERE LENGTH(question) - LENGTH(REPLACE(question, ' ', '')) + 1 <= 21 ORDER BY RAND() LIMIT 1";

  connection.query(sql, (err, results) => {
    if (err) throw err;

    const randomNumber = Math.floor(Math.random() * 5) + 1;

    const cachedData = {
      ...results[0],
      lita: randomNumber,
      bonusLita: bonusLita
    };

    console.log(cachedData);
    console.log(cachedData.id);
    connection.end();
    callback(cachedData);
  });
};


// Serverio refreshas kas 45 sekundes.Ir tikrina litai_sum.
let previousLitaiSum = null
let lastRefreshTime = null

const checkLitaiSum = () => {
  setInterval(() => {
    const connection = mysql.createConnection({
      host: "localhost",
      user: "root",
      password: "",
      database: "viktorina"
    })

    connection.connect()

    const sql = "SELECT litai_sum FROM super_users"

    connection.query(sql, (err, results) => {
      if (err) throw err

      const litaiSums = results.map((result) => result.litai_sum)
      const totalLitaiSum = litaiSums.reduce((sum, litaiSum) => sum + litaiSum, 0)

      console.log(`Total litai sum: ${totalLitaiSum}`)

      if (previousLitaiSum !== null && totalLitaiSum !== previousLitaiSum) {
        console.log(`Refreshing data due to change in litai_sum: ${totalLitaiSum}`)
        lastRefreshTime = new Date()
        refreshData((data) => {
          cachedData = data
        })
      }

      previousLitaiSum = totalLitaiSum
    })

    connection.end()

    console.log("Checking litai_sum at", new Date())
  }, 1000) // interval of 1 seconds  Nesenai pakeista 2023 04 15 buvo 5000

  setInterval(() => {
    const currentTime = new Date()
    if (lastRefreshTime === null || currentTime - lastRefreshTime >= 45000) {
      // serverio refreshas
      console.log(`Refreshing data every 45 seconds`)
      lastRefreshTime = currentTime
      refreshData((data) => {
        cachedData = data
      })
    }
  }, 1000) // interval of 1 seconds  Nesenai pakeista 2023 04 15 buvo 5000
}

checkLitaiSum()

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

app.listen(port, () => {
  console.log(`Serveris prisijunges on http://localhost:${port}`)
})

// 
// C:\xampp\htdocs\aldas\Viktorina.live> node server.js
