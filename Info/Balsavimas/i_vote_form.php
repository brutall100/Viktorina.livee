<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../x_configDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $suggestion = $_POST["suggestion"] ?? "";
    $username = $_POST["username"] ?? "";
    $userlevel = $_POST["userlevel"] ?? "";
    $userid = $_POST["userid"] ?? "";
    $points = $_POST["points"] ?? "";

    if (!empty($suggestion) && !empty($username) && !empty($userlevel) && !empty($userid) && !empty($points)) {
        //// Check if the user has required points or level
        $query = "SELECT litai_sum AS points, user_lvl AS user_level FROM super_users WHERE user_id = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param("i", $userid);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $userPoints = $row['points'];
        $userLevel = $row['user_level'];

        if ($userLevel >= 3 || $userPoints >= 100000) {
            if ($userLevel < 3) {
                //// If the user level is less than 3, deduct 100,000 litai from their account
                $deduct_query = "UPDATE super_users SET litai_sum = litai_sum - 100000 WHERE user_id = ?";
                $deduct_statement = $conn->prepare($deduct_query);
                $deduct_statement->bind_param("i", $userid);
                $deduct_statement->execute();
                $deduct_statement->close();
            }

            //// Check for duplicate suggestion
            $duplicate_query = "SELECT COUNT(*) AS count FROM x_vote_suggestion WHERE usid = ? AND suggestion = ?";
            $duplicate_statement = $conn->prepare($duplicate_query);
            $duplicate_statement->bind_param("is", $userid, $suggestion);
            $duplicate_statement->execute();
            $duplicate_result = $duplicate_statement->get_result();
            $duplicate_row = $duplicate_result->fetch_assoc();
            $duplicate_count = $duplicate_row['count'];
            $duplicate_statement->close();

            if ($duplicate_count == 0) {
                //// Insert the suggestion into the database
                $insert_query = "INSERT INTO x_vote_suggestion (usname, usid, suggestion) VALUES (?, ?, ?)";
                $insert_statement = $conn->prepare($insert_query);
                $insert_statement->bind_param("sis", $username, $userid, $suggestion);
                $insert_statement->execute();
                $insert_statement->close();

                $message = "Balsavimo pasiūlymas įrašytas.";
            } else {
                $message = "Toks balsavimo siūlymas jau egzistuoja.";
            }
        } else {
            $message = "Norėdami teikti siūlymą balsavimui, jums reikia turėti bent 100 000 Litų arba būti 3 lygio.";
        }

        include '../style.php';

        $statement->close();
        $conn->close();
    } else {
        $message = "Oi nei! Atrodo, kad pamiršote užpildyti kai kuriuos laukus!";
        include '../style.php';
    }
} else {
    $message = "Form not submitted.";
    include '../style.php';
}
echo $message;
?>



