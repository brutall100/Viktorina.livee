<!DOCTYPE html>
<html lang="en">
<head>
    <title>Viktorina.live</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="http://localhost/Viktorina.live/Header/header.css" />
</head>

<body>
<header class="header">
  <ul>
    <div class="logo-container">
      <img class="logo" src="http://localhost/Viktorina.live/images/icons/vk9.jpg" alt="viktorina-logo" aria-label="Viktorina logotipas, kvadratas su išdėstytomis figūromis " />
    </div>
    <div class="menu-container"><!--  NEZINAU KAS GERIAU AR INFO AR FORUMAS AR PALIKTI ABU AR DAR KAS NAUDOJA TUOS FORUMUS.  kA MANAI???? -->
      <li><a href="http://localhost/Viktorina.live/a_index.php?name=<?php echo $name ?>&level=<?php echo $level ?>&points=<?php echo $points ?>&user_id=<?php echo $user_id ?>">Viktorina</a></li>
      <li><a href="#?name=<?php echo $name ?>&level=<?php echo $level ?>&points=<?php echo $points ?>&user_id=<?php echo $user_id ?>">Forumas</a></li>
      <li><a href="http://localhost/Viktorina.live/c_questionwaiting.php?name=<?php echo $name ?>&level=<?php echo $level ?>&points=<?php echo $points ?>&user_id=<?php echo $user_id ?>">Naujienos</a></li>
      <li><a href="http://localhost/Viktorina.live/b_newquestionindex.php?name=<?php echo $name ?>&level=<?php echo $level ?>&points=<?php echo $points ?>&user_id=<?php echo $user_id ?>">Irašyti klausimą</a></li>
      <div class="dropdown">
        <li class="dropbtn">Info</li>
        <div class="dropdown-content">
          <a href="#">Naujienos</a>
          <a href="#">Pasiūlymai</a>
          <a href="#">Puslapio klaidos</a>
          <a href="#">Pasiūlymai balsuoti</a>
          <a href="#">Balsavimas</a>
          <a href="#">Klaidos klausime</a><!-- Jei pastebejote klaida viename is klausimu prasome nurodyti kluasimo nr ir priezasti kodel manote jog klausimas neteisingas -->
        </div>
      </div>
    </div>
    <div class="logout-container">
      <button id="btn-atsijungti">Atsijungti</button>
    </div>
  </ul>
</header>

<?php if (isset($name)) { ?>
  <script>
    const logoutButton = document.getElementById('btn-atsijungti');
    const name = "<?php echo $name ?>";
    logoutButton.addEventListener('click', () => {
      window.location.href = `http://localhost/Viktorina.live/Statistica/statistic.php?name=${name}`;
    });
  </script>
<?php } ?>

</body>
</html>


