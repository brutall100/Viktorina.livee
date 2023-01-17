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
$ip = $_SERVER['REMOTE_ADDR'];

$message = "Naujas klausimas sukurtas sėkmingai. Klausimas irašytas į laikinają duomenų bazę. Kur bus apdorojamas.";
if (empty($question) || empty($answer)) {
    $message = "Klaida: ne visi laukai užpildyti. Klausimas ir atsakymas yra būtini.";
}

// Check if any of the fields are empty
if (empty($question) || empty($answer)) {
    echo $message;
} else {
    // Insert the data into the database
    $sql = "INSERT INTO viktorina.question_answer (user, question, answer, data, ip) VALUES ('$name', '$question', '$answer', '$data','$ip')";
    if (mysqli_query($conn, $sql)) {
        echo $message;
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    }
    // Close the connection
    mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
  <head>
    <style>
    /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed;/* Stay in place */
      background-color:green; 
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
      background-color: #fefefe;
      margin: auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }

    /* The Close Button */
    .close {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }
    </style>
  </head>
  
  <body>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p><?php echo $message; ?></p>
        </div>
    </div>
  </body>


<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
modal.style.display = "block";

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
  setTimeout(function(){
        location.href = "http://localhost/aldas/Viktorina.live/NewQuestionInsert/newquestionindex.html";
    }, 2000);
}

// Close the modal after 5 seconds
setTimeout(function(){
    modal.style.display = "none";
    location.href = "http://localhost/aldas/Viktorina.live/NewQuestionInsert/newquestionindex.html";
}, 5000);

</script>





