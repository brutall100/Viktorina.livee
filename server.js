const express = require("express");
const mysql = require("mysql2");
require("dotenv").config();

const app = express();

app.use(function (req, res, next) {
  res.header("Access-Control-Allow-Origin", "*");
  res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
  next();
});

let cachedData = null;
let bonusLita = 0;
let count = 0;

const connectionPool = mysql.createPool({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_DATABASE
});

const generateBonus = () => {
  const interval = Math.floor(Math.random() * 30000) + 30000;

  setTimeout(() => {
    bonusLita = Math.floor(Math.random() * 5) * 10 + 10;
    console.log(`Generated bonus: ${bonusLita}`);
    setTimeout(() => {
      bonusLita = 0;
      console.log(`Removed bonus: ${bonusLita}`);
    }, 5000);
    count++;
    if (count < 10000000) {
      generateBonus();
    }
  }, interval);
};
generateBonus();

const refreshData = (callback) => {
  connectionPool.getConnection((err, connection) => {
    if (err) {
      console.error("Error getting connection:", err);
      return;
    }

    const sql = "SELECT id, question, answer FROM main_database WHERE LENGTH(question) - LENGTH(REPLACE(question, ' ', '')) + 1 <= 21 ORDER BY RAND() LIMIT 1";

    connection.query(sql, (err, results) => {
      if (err) {
        connection.release();
        throw err;
      }

      const randomNumber = Math.floor(Math.random() * 5) + 1;

      if (cachedData) {
        saveOldData(connection, cachedData); // Save old data before refreshing
      }

      cachedData = {
        ...results[0],
        lita: randomNumber,
        bonusLita: bonusLita
      };

      console.log(cachedData);
      console.log(cachedData.id);
      connection.release();
      callback(cachedData);
    });
  });
};

const saveOldData = (connection, oldData) => {
  const sql = "INSERT INTO old_qna (old_id, old_question, old_answer) VALUES (?, ?, ?)";
  const values = [oldData.id, oldData.question, oldData.answer];

  connection.query(sql, values, (err, results) => {
    if (err) console.error("Error saving old data:", err);
    else console.log("Old data saved:", oldData);
  });
};

let previousLitaiSum = null;
let lastRefreshTime = null;

const checkLitaiSum = () => {
  // Declare the connection variable at the function scope
  const connection = mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_DATABASE
  });

  setInterval(() => {
    connectionPool.getConnection((err, connection) => {
      if (err) {
        console.error("Error getting connection:", err);
        return;
      }

      const sql = "SELECT litai_sum FROM super_users";

      connection.query(sql, (err, results) => {
        connection.release(); // Release the connection when done

        if (err) throw err;

        const litaiSums = results.map((result) => result.litai_sum);
        const totalLitaiSum = litaiSums.reduce((sum, litaiSum) => sum + litaiSum, 0);

        console.log(`Total litai sum: ${totalLitaiSum}`);

        if (previousLitaiSum !== null && totalLitaiSum !== previousLitaiSum) {
          lastRefreshTime = new Date();
          if (cachedData) {
           
          }
          refreshData((data) => {
            cachedData = data;
          });
        }

        previousLitaiSum = totalLitaiSum;
      });
    });

    console.log("Checking litai_sum at", new Date());
  }, 1000);

  setInterval(() => {
    const currentTime = new Date();
    if (lastRefreshTime === null || currentTime - lastRefreshTime >= 45000) {
      lastRefreshTime = currentTime;
      if (cachedData) {
        refreshData((data) => {
          cachedData = data;
        });
      }
    }
  }, 45000); // Interval of 45 seconds
};

checkLitaiSum();

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

const PORT = process.env.PORT3
app.listen(PORT, () => {
  console.log(`Serveris prisijunges on http://localhost:${PORT}`)
})

//
// C:\xampp\htdocs\aldas\Viktorina.live> node server.js
