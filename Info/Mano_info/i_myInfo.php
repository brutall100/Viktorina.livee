<?php
session_start();
$name = $_SESSION['nick_name'] ?? "";
$user_id = $_SESSION['user_id'] ?? ""; 

include('../../x_configDB.php'); 

$sql = "SELECT 
        u.user_lvl,
        u.litai_sum,
        u.litai_sum_today,
        u.litai_sum_week,
        u.litai_sum_month,
        u.gender_super,
        u.user_email,
        (SELECT COUNT(*) + 1 FROM super_users WHERE litai_sum > u.litai_sum) AS rank
        FROM super_users u
        WHERE u.nick_name = '$name' AND u.user_id = '$user_id'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $level = $row['user_lvl'];
    $points = $row['litai_sum'];
    $litai_sum_today = $row['litai_sum_today'];
    $litai_sum_week = $row['litai_sum_week'];
    $litai_sum_month = $row['litai_sum_month'];
    $gender_super = ($row['gender_super'] == 0) ? "Žmogus" : $row['gender_super'];
    $user_email = $row['user_email'];
    $user_rank = $row['rank']; // Rank added here
} else {
    $level = "N/A";
    $points = "N/A";
    $litai_sum_today = "N/A";
    $litai_sum_week = "N/A";
    $litai_sum_month = "N/A";
    $gender_super = "Žmogus";
    $user_email = "N/A";
    $user_rank = "N/A";
}

$sql2 = "SELECT COUNT(*) AS question_count 
         FROM question_answer 
         WHERE super_users_id = '$user_id'";
$result2 = mysqli_query($conn, $sql2);

if ($result2) {
    $row2 = mysqli_fetch_assoc($result2);
    $question_count = $row2['question_count'];
} else {
    $question_count = "N/A";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="lt">

<head>
    <title>Mano info</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tai yra interaktyvi viktorina, kurioje dalyviai atsako į įvairius klausimus ir gauna virtualius litus kaip atlygį. Ši viktorina yra unikali tuo, kad leidžia vartotojams ne tik atsakinėti į klausimus, bet ir kurti juos.">
    <meta name="keywords" content="viktorina, litai, bendravimas, mokymasis, smagumas ">
    <link rel="stylesheet" type="text/css" href="i_myInfo.css">
    <script src="https://kit.fontawesome.com/98ec1a4ef1.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="header-wrapper">
        <?php include '../../Header/header.php'; ?>
    </div>

    <nav class="user-header">
        <div class="user-header-btn">
            <button class="btn" data-target="name">Keisti Vardą <i class="fa-regular fa-user"></i></button>
        </div>
        <div class="user-header-btn">
            <button class="btn" data-target="gender">Keisti Lytį <i class="fa-solid fa-person-half-dress"></i></button>
        </div>        
        <div class="user-header-btn">
            <button class="btn" data-target="email">Keisti Email <i class="fa-regular fa-envelope"></i></button>
        </div>
        <div class="user-header-btn">
            <button class="btn" data-target="level">Keisti Lygį <i class="fa-solid fa-up-right-from-square"></i></button>
        </div>
    </nav>

    <div class="conatainer">
        <div class="content-user">
            <h1>Mano Informacija</h1>
            <div class="content-p">
                <div class="content-row">
                    <p>
                        <span class="first-span">Dalyvis:</span>
                        <span class="middle-span"><?php echo $name; ?></span>
                        <span class="last-span"></span>
                    </p>
                </div>
                <div class="content-row">
                    <p>
                        <span class="first-span">Lytis:</span>
                        <span class="middle-span"><?php echo $gender_super; ?></span>
                        <span class="last-span"></span>
                    </p>
                </div>
                <div class="content-row">
                    <p>
                        <span class="first-span">Email:</span>
                        <span class="middle-span"><?php echo $user_email; ?></span>
                        <span class="last-span"></span>
                    </p>
                </div>
                <div class="content-row">
                    <p>
                        <span class="first-span">Lygis:</span>
                        <span class="middle-span"><?php echo $level; ?></span>
                        <span class="last-span"></span>
                    </p>
                </div>
                <div class="content-row">
                    <p>
                        <span class="first-span">Id:</span>
                        <span class="middle-span"><?php echo $user_id; ?></span>
                        <span class="last-span"></span>
                    </p>
                </div>
                <div class="content-row">
                    <p>
                        <span class="first-span">Vieta TOPe:</span>
                        <span class="middle-span"><?php echo $user_rank; ?></span>
                        <span class="last-span"></span>
                    </p>
                </div>
                <div class="content-row">
                    <p>
                        <span class="first-span">Litai:</span>
                        <span class="middle-span"><?php echo $points; ?></span>
                        <span class="last-span"></span>
                    </p>
                </div>
                <div class="content-row">
                    <p>
                        <span class="first-span">Litai šiandien:</span>
                        <span class="middle-span"><?php echo $litai_sum_today; ?></span>
                        <span class="last-span"></span>
                    </p>
                </div>
                <div class="content-row">
                    <p>
                        <span class="first-span">Litai savaitės:</span>
                        <span class="middle-span"><?php echo $litai_sum_week; ?></span>
                        <span class="last-span"></span>
                    </p>
                </div>
                <div class="content-row">
                    <p>
                        <span class="first-span">Litai mėnesio:</span>
                        <span class="middle-span"><?php echo $litai_sum_month; ?></span>
                        <span class="last-span"></span>
                    </p>
                </div>
                <div class="content-row">
                    <p>
                        <span class="first-span">Įrašytą klausimų:</span>
                        <span class="middle-span"><?php echo $question_count; ?></span>
                        <span class="last-span"></span>
                    </p>
                </div>
            </div>



        </div>

        <div class="content-response">
            <h1>Keitimo info</h1>
            <div class="content-response-paragraph">
                <p class="pargraph_1"></p>
                <p class="pargraph_2"></p>
                
            </div>  
        </div>
    </div>

    <div class="footer-wrapper">
        <?php include '../../Footer/footer.php'; ?>
    </div>

    <script>
        var userName = <?php echo json_encode($name); ?>;
        var userId = <?php echo json_encode($user_id); ?>;
        var userLitai = <?php echo json_encode($points); ?>;
        var userGender = <?php echo json_encode($gender_super); ?>;
        var userEmail = <?php echo json_encode($user_email); ?>;
        var userLevel = <?php echo json_encode($level); ?>;
    </script>

    <script type="text/javascript" src="i_myInfo.js"></script>
</body>

</html>
