<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Viktorina.live</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="http://localhost/aldas/Viktorina.live/a_style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />  
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  </head>

  <?php
session_start();
if (isset($_GET['name'])) {
  $name = $_GET['name'];
  $conn = mysqli_connect("localhost", "root", "", "viktorina");
  $query = "SELECT user_lvl, litai_sum, user_id FROM super_users WHERE nick_name = '$name'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $level = $row['user_lvl'];
    $points = $row['litai_sum'];
    $user_id = $row['user_id'];
    mysqli_close($conn);
  }
  if (isset($_GET['level']) && isset($_GET['points'])) {
    $level = $_GET['level'];
    $points = $_GET['points'];
  }
}

      echo "<div id='user-data' data-name='$name' data-level='$level' data-points='$points'></div>";
?>  




<body>
<?php include 'Header/header.php'; ?>
  
    <!-- bandymas -->
    <div id="dataContainer"></div>
    <div id="lita"></div>
    <div id="lita-bonus"></div>

    <?php
    if (isset($_GET['name'])) {
      $name = $_GET['name'];
      $conn = mysqli_connect("localhost", "root", "", "viktorina");
      $query = "SELECT user_lvl, litai_sum, litai_sum_today, user_id FROM super_users WHERE nick_name = '$name'";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $level = $row['user_lvl'];
        $points = $row['litai_sum'];
        $points_today = $row['litai_sum_today'];
        $user_id = $row['user_id'];
        echo "Welcome, $name! Your current level is $level and you have $points points.Today's points $points_today . Your id: $user_id";
      
      } else {
        echo "User not found!";
      }
      mysqli_close($conn);
    } else {
      echo "Welcome!";
    }
    ?>


    <section class="today-top">
      <button class="today-top-btn" id="today-top-btn" >Šiandienos TOP 10</button>
    </section>

    <section class="litas-container">
      <div class="litas-container-img" id="litai-img-bonus"></div>
      <div class="litas-container-img" id="litai-img"></div>
    </section>

    <main class="super-container">
      <div class="points-container">
        <div class="" id="points"></div>
        <div class="" id="bonus-points"></div>
      </div>
      <div class="super-container-qna-section">
        <div class="" id="question"></div>
        <div class="" id="answer"></div>
      </div>
      <form action="a_index.php?name=<?php echo urlencode($_GET['name']); ?>" id="answer-form" method="post">
        <label for="answer-input">Atsakymas:</label>
        <input type="text" id="answer-input" name="answer-input" />
        <button class="submit-btn" type="submit">Submit</button>
      </form>
    </main>

    <section class="old-question-section">
      <div id="old-question">
      </div>
    </section>

    <script type="text/javascript" src="http://localhost/aldas/Viktorina.live/a_index.js"></script>
    <footer class="footer">
      <object
        data="http://localhost/aldas/Viktorina.live/Footer/footer.html"
        class="imported-footer">
      </object>
    </footer>
  </body>
</html>
