const express = require("express")
const mysql = require("mysql")
const rateLimit = require("express-rate-limit")
const path = require("path")
require("dotenv").config({ path: path.join(__dirname, ".env") })

const app = express()

const limiter = rateLimit({
  windowMs: 301 * 1000, // 61 sekunde kolkas paskui (300s) 5min laiko turi praeti kol serveris leis perkrovima
  max: 1 // limit each IP to 1 requests per windowMs
})
app.use(limiter)

app.use(express.json())
app.use(express.urlencoded({ extended: true }))

app.use(function (req, res, next) {
  res.header("Access-Control-Allow-Origin", "*")
  res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept")
  next()
})

const connection = mysql.createConnection({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_DATABASE
})

connection.connect()

app.get("/game3_server", (req, res) => {
  connection.query('SELECT id, question, answer FROM main_database WHERE LENGTH(question) - LENGTH(REPLACE(question, " ", "")) + 1 > 21 ORDER BY RAND() LIMIT 1', function (error, results, fields) {
    if (error) throw error
    const question = results[0].question
    const answer = results[0].answer
    const id = results[0].id
    res.json({ question, answer, id })
  })
})


const PORT = process.env.PORT3 
app.listen(PORT, () => {
  console.log(`Serveris prisijunges prie: http://localhost:${PORT}`)
})

// node game3server.js
