<?php
session_start();

// Store the name and level in the session if they are present in the GET request
if (isset($_GET['name'])) {
  $_SESSION['name'] = $_GET['name'];
}
if (isset($_GET['level'])) {
  $_SESSION['level'] = $_GET['level'];
}

// Retrieve the name and level from the session
$name = isset($_SESSION['name']) ? $_SESSION['name'] : "";
$level = isset($_SESSION['level']) ? $_SESSION['level'] : "";
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Naujo klausimo įrašymas</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/aldas/Viktorina.live/aa_headerstyle.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost/aldas/Viktorina.live/b_newguestion.css" />
    
  </head>
  <body>
    <header class="header">
        <ul>
          <img class="logo" src="http://localhost/aldas/Viktorina.live/images/icons/viktorina_logo.png" />
          <div>
            <li><a href="http://localhost/aldas/Viktorina.live/a_index.php">Viktorina</a></li>
            <li><a href="http://localhost/aldas/Viktorina.live/c_questionwaiting.php">Naujienos</a></li>
            <li><a href="http://localhost/aldas/Viktorina.live/b_newquestionindex.php">Irašyti klausimą</a></li>
          </div> 
          
          <div>
          </div> 

        </ul>
      </header>
    <!-- Registered user fiils automatic , not registered ip or useful info-->

    <main class="main">
      <div class="main-form">
        <form action="http://localhost/aldas/Viktorina.live/b_newquestion.php" method="post">
          <label for="name">Autorius:</label>
          <input type="text" id="name" name="name" value="<?php echo $name; ?>" />
          
          <label for="question">Klausimas:</label>
          <input type="text" id="question" name="question" />
          
          <label for="answer">Atsakymas:</label>
          <input type="text" id="answer" name="answer" />

          <input type="submit" value="Įrašyti" />
        </form>
      </div>
      <br/>       
      <div class="main-info">
        <?php if (!empty($name) && !empty($level)): ?>
          <p>Autorius: <?php echo $name; ?></p>
          <p>Lygis: <?php echo $level; ?></p>
        <?php endif; ?>
      </div>
    </main>

    <footer class="footer">
      <object
        data="http://localhost/aldas/Viktorina.live/Footer/footer.html"
        class="imported-footer">
      </object>
    </footer>
  </body>
</html>
