const express = require('express');
const axios = require('axios');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const bcrypt = require('bcrypt');

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
  const sql = `SELECT * FROM super_users WHERE nick_name = ?`;
  connection.query(sql, [nick_name], (err, result) => {
    if (err) throw err;
    if (result.length > 0) {
      // compare hashed password with user's input password
      const { user_password: hashedPassword, user_email } = result[0];
      bcrypt.compare(user_password, hashedPassword, (err, match) => {
        if (err) throw err;
        if (match) {
          // handle successful login
          res.redirect(`http://localhost/aldas/Viktorina.live/a_index.php?name=${nick_name}&email=${user_email}`);
        } else {
          // handle login error
          res.send('Invalid username or password');
        }
      });
    } else {
      // handle login error
      res.send('Invalid username or password');
    }
  });
});

app.post('/register', (req, res) => {
  const { nick_name, user_email, user_password } = req.body;
  // hash the user's password before storing it in the database
  bcrypt.hash(user_password, 10, (err, hashedPassword) => {
    if (err) throw err;
    const currentDate = new Date().toISOString().slice(0, 20);// Get the current date in YYYY-MM-DD format
    // create new user account with nick_name, user_email, hashedPassword, and registration_date
    const sql = `INSERT INTO super_users (nick_name, user_email, user_password, registration_date) VALUES (?, ?, ?, DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s'))`;

    connection.query(sql, [nick_name, user_email, hashedPassword, currentDate], (err, result) => {
      if (err) throw err;
      // handle successful registration
      res.redirect(`http://localhost/aldas/Viktorina.live/a_index.php?name=${nick_name}&email=${user_email}`);
    });
  });
});


app.listen(4000, () => {
  console.log('Server listening on port 4000');
});


