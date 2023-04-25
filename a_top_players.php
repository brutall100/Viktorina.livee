<?php
if (isset($_GET['get_top_players'])) {
  $conn = mysqli_connect("localhost", "root", "", "viktorina");
  $query = "SELECT nick_name, litai_sum_today FROM super_users ORDER BY litai_sum_today DESC LIMIT 10";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    echo "<h3>Today's top 10 players:</h3>";
    echo "<ol>";
    while ($row = mysqli_fetch_assoc($result)) {
      $name = $row['nick_name'];
      $points_today = $row['litai_sum_today'];
      echo "<li>$name - $points_today points today</li>";
    }
    echo "</ol>";
  } else {
    echo "No players found!";
  }
  mysqli_close($conn);
}
?>

<!-- Paapaudus Btn a_index.php parodys sios dienos top 10 pagal litus -->