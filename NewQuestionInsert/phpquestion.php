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

// Get the form data
$name = $_POST['name'];
$question = $_POST['question'];
$answer = $_POST['answer'];
$data = date("Y-m-d"); // current date

// Insert the data into the database
$sql = "INSERT INTO viktorina.question_answer (user, question, answer, data) VALUES ('$name', '$question', '$answer', '$data')";
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>

