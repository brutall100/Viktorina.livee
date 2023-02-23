<?php

if (isset($_GET['name'])) {
  $name = $_GET['name'];
  $conn = mysqli_connect("localhost", "root", "", "viktorina");
  $query = "SELECT user_lvl, litai_sum FROM super_users WHERE nick_name = '$name'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $level = $row['user_lvl'];
    $points = $row['litai_sum'];
    mysqli_close($conn);
  }
}

session_start();

if (isset($_GET['name']) && isset($_GET['email']) && isset($_GET['level']) && isset($_GET['points'])) {
  $name = $_GET['name'];
  $email = $_GET['email'];
  $level = $_GET['level'];
  $points = $_GET['points'];
}
?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Viktorina.live</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="http://localhost/aldas/Viktorina.live/a_style.css" />
    <link rel="stylesheet" href="http://localhost/aldas/Viktorina.live/aa_headerstyle.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />  
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  </head>

  <body>
    <header class="header">
      <ul>
        <img class="logo" src="http://localhost/aldas/Viktorina.live/images/icons/viktorina_logo.png" />
        <div>
          <li><a href="http://localhost/aldas/Viktorina.live/a_index.php">Viktorina</a></li>
          <li><a href="http://localhost/aldas/Viktorina.live/c_questionwaiting.php">Naujienos</a></li>
          <li><a href="http://localhost/aldas/Viktorina.live/b_newquestionindex.php?name=<?php echo $name ?>&level=<?php echo $level ?>&points=<?php echo $points ?>">Irašyti klausimą</a></li>
        </div> 
        <div>
         
        </div>  
      </ul>
    </header>

<!-- bandymas -->
<div id="dataContainer"></div>
<div id="lita"></div>
<div id="lita-bonus"></div>




<?php
if (isset($_GET['name'])) {
  $name = $_GET['name'];
  $conn = mysqli_connect("localhost", "root", "", "viktorina");
  $query = "SELECT user_lvl, litai_sum FROM super_users WHERE nick_name = '$name'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $level = $row['user_lvl'];
    $points = $row['litai_sum'];
    echo "Welcome, $name! Your current level is $level and you have $points points.";
    echo "<br><button onclick=\"window.location.href='statistic.php?name=$name'\">Logout</button>"; // Pass the nickname as a query parameter
  } else {
    echo "User not found!";
  }
  mysqli_close($conn);
} else {
  echo "Welcome!";
}
?>



<!-- bandymas -->

    <section>
      <div class="litas-container">
        <div class="litas-container-img" id="litai-img-bonus"></div>
        <div class="litas-container-img" id="litai-img"></div>
      </div>
    </section>

    <main class="super-container">
      <div class="points-container">
        <div class="super" id="points"></div>
        <div class="super" id="bonus-points"></div>
      </div>
      <div class="super" id="question"></div>
      <div class="super" id="answer"></div>
      <div class="" id="dot-answer"></div>
      <div class="" id="dot-answer-lenght"></div>

      <form action="" id="answer-form" method="post">
        <label for="answer-input">Atsakymas:</label>
        <input type="text" id="answer-input" name="answer-input" />
        <button class="submit-btn" type="submit-answer">Submit</button>
      </form>
    </main>

    <script type="text/javascript" src="http://localhost/aldas/Viktorina.live/a_index.js"></script>
    <footer class="footer">
      <object
        data="http://localhost/aldas/Viktorina.live/Footer/footer.html"
        class="imported-footer">
      </object>
    </footer>
  </body>
</html>
