<?php
  // Start a session
  session_start();

  // Connect to the database
  $db = mysqli_connect('hostname', 'username', 'password', 'database');

  // Check if the login form was submitted
  if (isset($_POST['submit'])) {
    // Get the username and password entered by the user
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Query the database to see if the user's credentials are valid
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
      // Set a session variable to indicate that the user is logged in
      $_SESSION['logged_in'] = true;
      // Redirect the user to the restricted content page
      header('location: content.php');
    } else {
      // Display an error message if the login fails
      $error = "Invalid email or password";
    }
  }
?>
