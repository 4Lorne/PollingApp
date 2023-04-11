<?php
session_start();
// Include database connectivity
include_once('config.php');

if (isset($_POST['submit'])) {
    $question = $con->real_escape_string($_POST['question']);

    // Check if a question already exists
    $query = "SELECT * FROM polls LIMIT 1";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        // Update the existing question
        $query = "UPDATE polls SET question='$question' WHERE id=1";
    } else {
        // Insert the new question
        $query = "INSERT INTO polls (question) VALUES ('$question')";
    }
    $row = $result->fetch_assoc();
    $_SESSION['question'] = $row['question'];
    // Execute the query
    $result = $con->query($query);

    if ($result == true) {
        header("Location: login.php");
        die();
    } else {
        $errorMsg = "An error occurred while updating the poll results.";
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Poll</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="container">
    <h1>Create Poll</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="question">Question:</label>
            <input type="text" class="form-control" name="question" id="question" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Create Poll</button>
    </form>
</div>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
</html>
