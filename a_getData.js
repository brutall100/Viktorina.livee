const mysql = require('mysql2');

const refreshData = () => {
    const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'viktorina'
  });

  connection.connect();

  const sql = 'SELECT id, question, answer FROM question_answer ORDER BY RAND() LIMIT 1';

  connection.query(sql, (err, results) => {
    if (err) throw err;

    const data = JSON.stringify(results);
    console.log(data);
    connection.end();
    setTimeout(refreshData, 10000);
  });
};

refreshData();


// module.exports = data;
exports.refreshData = refreshData;



// node a_getData.js
// node a_getData.js


  