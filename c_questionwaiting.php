<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_set_cookie_params(['SameSite' => 'none', 'httponly' => true, 'Secure' => true]);

session_start();

include 'x_configDB.php';

$name = $_SESSION['nick_name'] ?? "";
$level = $_SESSION['user_lvl'] ?? "";
$points = $_SESSION['points'] ?? "";
$user_id = $_SESSION['user_id'] ?? "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="300">
  <title>Naujai sukurti klausimai</title>
  <link rel="stylesheet" type="text/css" href=" c_questionwaiting.css">
</head>
<body>
<div class="header-wrapper">
  <?php include 'Header/header.php'; ?>
</div>
<main>
    <div class="button-wrapper">
      <button id="btn-perkelti-klausimus" class="btn-perkelti-klausimus">Perkelti</button>
    </div>
    
    <div class="table-wrapper">
      <button id="btn-drop-bottom" class="btn-drop-bottom">Į APAČIA</button>
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
        
        // // Conection from Include
     
          mysqli_set_charset($conn, "utf8mb4");
          $sql = "SELECT id, user, question, answer, vote_count FROM $dbname.question_answer";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
              // Output the data
              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['user'] . "</td>";
                //echo "<td>" . $row['question'] ."  [". mb_detect_encoding($row['question']) . "]</td>";
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
      <button id="btn-drop-top" class="btn-drop-top">Į VIRŠŲ</button>
    </div>
  </main>  
  
  <div class = "footer-wrapper">
      <?php include './Footer/footer.php'; ?>
  </div>

<script>
  // ! Padaryti normalu balsavima atbalsavima prideti lita uz balsavima
//// UPVOTE
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
                if (text === "Success") {
                    if (button.classList.contains("upvoted")) {
                        button.classList.remove("upvoted");
                        button.textContent = "Upvote";
                    } else {
                        button.classList.add("upvoted");
                        button.textContent = "Cancel Vote";
                    }
                }
                setTimeout(function() {
                    location.reload();
                }, 50);
            })
            .catch(function(error) {
                console.log('Request failed', error);
            });
    });
});


//// DOWNVOTE
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
                if (text === "Success") {
                    if (button.classList.contains("downvoted")) {
                        button.classList.remove("downvoted");
                        button.textContent = "Downvote";
                    } else {
                        button.classList.add("downvoted");
                        button.textContent = "Cancel Vote";
                    }
                }
                setTimeout(function() {
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
        url: " transferData.php",
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

<!-- Paslepia BTN kad tik 4 ir 5 levelis galetu paspausti -->
<script>
  function toggleButtonVisibility() {
    var userLevel = "<?php echo isset($_SESSION['level']) ? $_SESSION['level'] : ''; ?>";

    if (userLevel === '4' || userLevel === '5') {
      document.getElementById("btn-perkelti-klausimus").style.display = "block";
    } else {
      document.getElementById("btn-perkelti-klausimus").style.display = "none";
    }
  }
  toggleButtonVisibility();
</script>

<!-- BTN To Bottom and To Top -->
<script>
  document.getElementById('btn-drop-bottom').addEventListener('click', function() {
  const pageHeight = document.documentElement.scrollHeight

  window.scrollTo({
    top: pageHeight,
    behavior: 'smooth'
  })
}) 

  document.getElementById('btn-drop-top').addEventListener('click', function() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    })
  })
</script>

</body>
</html>
