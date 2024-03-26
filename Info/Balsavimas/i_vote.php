<?php
session_start();
$name = $_SESSION['nick_name'] ?? "";
$level = $_SESSION['user_lvl'] ?? "";
$points = $_SESSION['points'] ?? "";
$user_id = $_SESSION['user_id'] ?? "";
?>

<!DOCTYPE html>
<html lang="lt">

<head>
    <title>Balsavimas</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="i_vote.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="header-wrapper">
        <?php include '../../Header/header.php'; ?>
    </div>

    <main class="main-content">
        <section id="vote-section" class="vote-section">
            <!-- Content related to the ongoing vote -->
            <!-- Include elements to display vote progress, options, etc. -->
        </section>

        <div class="right-sections">                                       <!-- Vote suggestions -->
            <section id="vote-suggestions" class="vote-suggestions">
                <form action="i_vote_form.php" method="post" class="vote-suggestion-form">
                    <div class="form-inline">
                        <div class="label-block">
                            <label for="username"><i class="fas fa-user"></i> Username</label>
                            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($name); ?>" readonly>
                        </div>
                        <div class="label-block">
                            <label for="userlevel"><i class="fas fa-level-up-alt"></i> User Level</label>
                            <input type="text" id="userlevel" name="userlevel" value="<?php echo htmlspecialchars($level); ?>" readonly>
                        </div>
                        <input type="hidden" name="userid" value="<?php echo htmlspecialchars($user_id); ?>">
                        <input type="hidden" name="points" value="<?php echo htmlspecialchars($points); ?>">
                    </div>

                    <div class="form-block"  data-tooltip="Siūlymas balsuoti kainuoja 100 000 Litų. </br> Galima įrašyti nuo 3 lygio.">
                        <label for="suggestion"><i class="fas fa-comment"></i> Suggestion</label>
                        <textarea id="suggestion" name="suggestion" placeholder="Your suggestion" class="suggestion-textarea"></textarea>

                        <button type="submit" class="submit-button"><i class="fas fa-check"></i> Submit</button>
                    </div>
                </form>
            </section>


            <section id="view-suggestions" class="view-suggestions">       <!-- Wiev suggestions -->
                <div class="view-it" id="view-it">
                    
                </div>
            </section>
        </div>
    </main>

    <div class="footer-wrapper">
        <?php include '../../Footer/footer.php'; ?>
    </div>
</body>
<script type="text/javascript" src="i_vote.js" defer></script>
</html>