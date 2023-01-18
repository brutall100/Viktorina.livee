<html>
<head>
  <title>My Page</title>
  <link rel="stylesheet" type="text/css" href="http://localhost/aldas/Viktorina.live/headerstyle.css" />
  <link rel="stylesheet" type="text/css" href="http://localhost/aldas/Viktorina.live/newguestion.css" />
  <!-- Style laikinai bus perkeltas virsun -->
  <style>  
      table {
    width: 50%;
    border-collapse: collapse;
  }

  table, td, th {
    border: 1px solid black;
    padding: 5px;
  }

  th {
    text-align: left;
  }

  </style>
   <!-- Meta refresh kas 5 min -->
  <meta http-equiv="refresh" content="300">
</head>
<body>
  <h1>Welcome to my page</h1>


  <table style="margin: 0 auto;">
    <tr>
      <th>Number</th>
      <th>User</th>
      <th>Question</th>
      <th>Answer</th>
    </tr>

    
    <?php
      // Connect to the database
      $host = 'localhost';
      $user = 'root';
      $password = '';
      $dbname = 'viktorina';

      $conn = mysqli_connect($host, $user, $password, $dbname);

      // Check connection
      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }

      // Select the data from the database
      $sql = "SELECT id, user, question, answer FROM viktorina.question_answer";
      $result = mysqli_query($conn, $sql);

      $counter = 1;
      if (mysqli_num_rows($result) > 0) {
          // Output the data
          while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['user'] . "</td>";
            echo "<td>" . $row['question'] . "</td>";
            echo "<td>" . $row['answer'] . "</td>";
            echo "<td>
            <button class='upvote' data-id='". $row['id'] ."'>Upvote</button>
            <button class='downvote' data-id='". $row['id'] ."'>Downvote</button>
            </td>";
            $counter++;
        }
        
      } else {
          echo "0 results";
      }

      // Close the connection
      mysqli_close($conn);
    ?>
  </table>
</body>
</html>

<script>
document.querySelectorAll('.upvote').forEach(function(button) {
  button.addEventListener('click', function() {
    var id = this.dataset.id;
    fetch('upvote.php?id=' + id)
      .then(function(response) {
        return response.text();
      })
      .then(function(text) {
        console.log(text);
        // Do something with the response
      })
      .catch(function(error) {
        console.log('Request failed', error);
      });
  });
});


document.querySelectorAll('.downvote').forEach(function(button) {
  button.addEventListener('click', function() {
    var id = this.dataset.id;
    fetch('downvote.php?id=' + id)
      .then(function(response) {
        return response.text();
      })
      .then(function(text) {
        console.log(text);
        // Do something with the response
      })
      .catch(function(error) {
        console.log('Request failed', error);
      });
  });
});


</script>

