const express = require('express');
const axios = require('axios');
const bodyParser = require('body-parser');
const mysql = require('mysql');

const app = express();

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// create a connection to your MySQL database
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'viktorina'
});

connection.connect((err) => {
  if (err) throw err;
  console.log('Connected to database Viktorina');
});

app.post('/login', (req, res) => {
  const { nick_name, user_password } = req.body;
  // perform login validation with nick_name and user_password
  const sql = `SELECT * FROM super_users WHERE nick_name = ? AND user_password = ?`;
  connection.query(sql, [nick_name, user_password], (err, result) => {
    if (err) throw err;
    if (result.length > 0) {
      // handle successful login
      res.send('Login successful');
    } else {
      // handle login error
      res.send('Invalid username or password');
    }
  });
});

app.post('/register', (req, res) => {
  const { nick_name, user_email, user_password } = req.body;
  // create new user account with nick_name, user_email, and user_password
  const sql = `INSERT INTO super_users (nick_name, user_email, user_password) VALUES (?, ?, ?)`;
  connection.query(sql, [nick_name, user_email, user_password], (err, result) => {
    if (err) throw err;
    // handle successful registration
    res.send('Registration successful');
  });
});

app.listen(4000, () => {
  console.log('Server listening on port 4000');
});

