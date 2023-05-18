<?php
session_start();
if (isset($_GET['name'])) {
  $_SESSION['name'] = $_GET['name'];
}
if (isset($_GET['level'])) {
  $_SESSION['level'] = $_GET['level'];
}
if (isset($_GET['points'])) {
  $_SESSION['points'] = $_GET['points'];
}
if (isset($_GET['user_id'])) {
  $_SESSION['user_id'] = $_GET['user_id'];
}
$name = isset($_SESSION['name']) ? $_SESSION['name'] : "";
$level = isset($_SESSION['level']) ? $_SESSION['level'] : "";
$points = isset($_SESSION['points']) ? $_SESSION['points'] : "";
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Naujai sukurti klausimai</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="300">
  <link rel="stylesheet" type="text/css" href="http://localhost/aldas/Viktorina.live/b_newguestion.css" />
</head>


<body>
<?php include 'Header/header.php'; ?>
  <main>
    <table class="table">
      <tr>
        <th>Numeris</th>
        <th>Autorius</th>
        <th>Klausimas</th>
        <th>Atsakymas</th>
        <th>Priimti</th>
        <th>Atmesti</th>
        <th>Rezultatas</th>
      </tr>
      <?php
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $dbname = 'viktorina';

        $conn = mysqli_connect($host, $user, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT id, user, question, answer, vote_count FROM viktorina.question_answer";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Output the data
            while($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $row['id'] . "</td>";
              echo "<td>" . $row['user'] . "</td>";
              echo "<td>" . $row['question'] . "</td>";
              echo "<td>" . $row['answer'] . "</td>";
              echo "<td><button class='upvote' data-id='". $row['id'] ."'></button></td>";
              echo "<td><button class='downvote' data-id='". $row['id'] ."'></button></td>";
              echo "<td class='vote_count " . ($row['vote_count'] >= 0 ? 'positive' : 'negative') . "'>" . $row['vote_count'] . "</td>";
          }   
        } else {
            echo "0 results";
        }
        mysqli_close($conn);
      ?>
    </table>
  </main>  

  <footer class="footer">
    <object
      data="http://localhost/aldas/Viktorina.live/Footer/footer.html"
      class="imported-footer">
    </object>
  </footer>
</body>

</html>

<script>
// UPVOTE
document.querySelectorAll('.upvote').forEach(function(button) {
  button.addEventListener('click', function() {
    var id = this.dataset.id;
    var user_id = "<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>";
    fetch('c_upvote.php?id=' + id + '&user_id=' + user_id)
      .then(function(response) {
        return response.text();
      })
      .then(function(text) {
        console.log(text);
        setTimeout(function(){
          location.reload();
        }, 50);
      })
      .catch(function(error) {
        console.log('Request failed', error);
      });
  });
});

// DOWNVOTE
document.querySelectorAll('.downvote').forEach(function(button) {
  button.addEventListener('click', function() {
    var id = this.dataset.id;
    var user_id = "<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>";
    fetch('c_downvote.php?id=' + id + '&user_id=' + user_id)
      .then(function(response) {
        return response.text();
      })
      .then(function(text) {
        console.log(text);
        setTimeout(function(){
          location.reload();
        }, 50);
      })
      .catch(function(error) {
        console.log('Request failed', error);
      });
  });
});
</script>

 
             <!-- perkelia klausimus i kita DB naudojant transferData.php -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
		$(function() {
			$("#btn-perkelti-klausimus").click(function() {
				$.ajax({
					url: "http://localhost/aldas/Viktorina.live/transferData.php",
					method: "post",
					success: function(response) {
						console.log(response);
					},
					error: function(xhr, status, error) {
						console.log("Error: " + error);
					}
				});
			});
		});
</script>



