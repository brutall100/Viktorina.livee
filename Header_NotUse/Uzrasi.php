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
  $sql = "SELECT id, user, question, answer, vote_count, date FROM viktorina.question_answer";
  $result = mysqli_query($conn, $sql);

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
        </td>";
        echo "<td>
        <button class='downvote' data-id='". $row['id'] ."'>Downvote</button>
        </td>";
        echo "<td class='vote_count " . ($row['vote_count'] >= 0 ? 'positive' : 'negative') . "'>" . $row['vote_count'] . "</td>";

        // Check if the question is older than a week and has a positive vote count
        $date = new DateTime($row['date']);
        $now = new DateTime();
        $interval = $now->diff($date);
        if($interval->days >= 7 && $row['vote_count'] > 0) {
          // Insert the question into the super_database
          $sql = "INSERT INTO viktorina.super_database (id, question, answer) VALUES ('".$row['id']."','".$row['question']."','".$row['answer']."')";
          mysqli_query($conn, $sql);
          // Delete the question from the question_answer table
          $sql = "DELETE FROM viktorina.question_answer WHERE id = '".$row['id']."'";
          mysqli_query($conn, $sql);
        }
        // Check if the question is older than a week and has a negative vote count
        if($interval->days >= 7 && $row['vote_count'] < 0) {
          // Delete the question from the question_answer table
          $sql = "DELETE FROM viktorina.question_answer WHERE id = '".$row['id']."'";
          mysqli_query($conn, $sql);
        }
    }
        
  } else {
    echo "0 results";
}

// Close the connection
mysqli_close($conn);
?>
