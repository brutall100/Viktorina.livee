<?php
  // Connect to the database
  $db = mysqli_connect('hostname', 'username', 'password', 'database');

  // Check if the registration form was submitted
  if (isset($_POST['submit'])) {
    // Get the form data
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Insert the new user into the database
    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    mysqli_query($db, $query);

    // Redirect the user to the login page
    header('location: login.php');
  }
?>
