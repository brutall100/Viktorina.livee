const express = require("express")
const app = express()
const mysql = require("mysql2/promise")
require("dotenv").config()
const cors = require("cors")
app.use(cors())

const db = mysql.createPool({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_DATABASE
})

// Middleware to parse JSON and urlencoded request bodies
app.use(express.json())
app.use(express.urlencoded({ extended: true }))

// Define a route to handle saving messages
app.post("/save-message", async (req, res) => {
  try {
    const { user_id, message, user_name } = req.body // Extract the 'message' property from the request body

    // Insert the message into the database
    const [result] = await db.execute(
      // "INSERT INTO chat_app_db (chat_id, chat_msg) VALUES (NULL, ?)",
      "INSERT INTO chat_app_db (chat_id, chat_user_id, chat_msg, chat_user_name) VALUES (NULL, ?, ?, ?)",
      [user_id, message, user_name]
    )

    console.log("Query result:", result)

    if (result.affectedRows === 1) {
      // If the message was saved successfully, send a 200 OK response
      res.status(200).json({ message: "Message saved successfully" })
    } else {
      console.error("Error saving message:", result.message)
      res.status(500).json({ error: "Internal Server Error" })
    }
  } catch (error) {
    console.error("Error saving message:", error)
    res.status(500).json({ error: "Internal Server Error" })
  }
})

// Start the server
const PORT = process.env.PORT5
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`)
})

// node a_chat_server.js
