<?php
include '../../x_configDB.php'; 

$sql = "SELECT * FROM x_vote_suggestion ORDER BY id DESC LIMIT 12";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="vote-container">'; // Start of vote-container

    while ($row = $result->fetch_assoc()) {
        echo '<div class="vote-entry">';
        echo '<div class="vote-left">'; // Left section
        echo '<p><strong>Vote ID:</strong> ' . $row["id"] . '</p>';
        echo '<p><strong>Username:</strong> ' . $row["usname"] . '</p>';
        echo '<p><strong>User ID:</strong> ' . $row["usid"] . '</p>';
        echo '<p><strong>Suggestion:</strong> ' . $row["suggestion"] . '</p>';
        echo '</div>'; // End of vote-left

        echo '<div class="vote-right">'; // Right section
        // Add buttons for Yes and No
        echo '<div class="vote-buttons">';
        echo '<button class="vote-yes" data-vote-id="' . $row["id"] . '">Yes</button>';
        echo '<button class="vote-no" data-vote-id="' . $row["id"] . '">No</button>';        
        echo '</div>'; // End of vote-buttons
        echo '</div>'; // End of vote-right

        echo '</div>'; // End of vote-entry
    }

    echo '</div>'; // End of vote-container
} else {
    echo "No votes found.";
}
$conn->close();
?>


<style>
.vote-container {
    border: 1px solid green;

}

.vote-entry {
    margin-bottom: 10px;
    padding: 5px;
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    display: flex; 
    border: 1px solid blue;
    text-wrap: wrap;
}

.vote-left {
    flex: 3;
}

.vote-right {
    flex: 1;
    border: 1px solid black;
    display: flex; 
    justify-content: center; 
    align-items: center; 
}

.vote-entry p {
    text
}

.vote-entry p strong {
    font-weight: bold;
}

.vote-buttons {
    display: flex; 
    flex-direction: column;
    align-items: center; 
    border: 1px solid red;
}

.vote-buttons button {
    margin: .3em 0;
    width: 50px;
}

</style>



<?php
session_start();
$user_id = $_SESSION['user_id'] ?? "";

include '../../x_configDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voteId = $_POST['voteId'];
    $voteType = $_POST['voteType'];

        // Prepare and execute the insert statement
        if ($voteType === 'yes') {
            $sql = "INSERT INTO x_vote (yes_votes, vote_type, voter_id) VALUES (1, ?, ?)";
        } elseif ($voteType === 'no') {
            $sql = "INSERT INTO x_vote (no_votes, vote_type, voter_id) VALUES (1, ?, ?)";
        } else {
            echo 'Invalid vote type';
            exit;
        }

        $statement = $conn->prepare($sql);
        $statement->bind_param("si", $voteType, $user_id);
        $statement->execute();
        $statement->close();


    // Send response
    echo 'Vote submitted successfully';
} else {
    echo 'Invalid request';
}
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // PHP session variable user_id echoed into JavaScript
    var userId = <?php echo json_encode($user_id); ?>;

    $('.vote-yes, .vote-no').click(function() {
        var voteId = $(this).data('vote-id');
        var voteType = $(this).hasClass('vote-yes') ? 'yes' : 'no';

        // Log the vote ID, vote type, and user ID before submitting
        console.log('Vote ID:', voteId);
        console.log('Vote Type:', voteType);
        console.log('User ID:', userId);

        $.ajax({
            url: 'update_vote.php',
            method: 'POST',
            data: { voteId: voteId, voteType: voteType },
            success: function(response) {
                console.log('Vote submitted successfully');
                // Optionally, you can update the UI or display a message to the user here
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});
</script>

