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

    //Resets the value of all votes
    $query = "UPDATE poll_results SET num_votes = 0";
    $result = $con->query($query);

    if ($result == true) {
        header("Location: login.php");
        die();
    } else {
        $errorMsg = "An error occurred while updating the poll results.";
    }
}
?>

<?php

if (isset($_POST['finish'])){
    $query = "SELECT * FROM poll_results WHERE num_votes > 0 ORDER BY num_votes DESC LIMIT 1;";
    $result = $con->query($query);

    while ($row = mysqli_fetch_assoc($result)) {
        // Process each row from the result set
        echo 'The winner is '.$row['username'] . ' with ' . $row['num_votes'] . ' votes'. '<br>';
        $query = "UPDATE poll_results SET num_votes = 0";
        $result = $con->query($query);
        die();
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
    <?php if($_SESSION['ROLE'] == 'admin'){ ?>
        <h1>Create Poll</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="question">Question:</label>
                <input type="text" class="form-control" name="question" id="question" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Create Poll</button>
        </form>
    <?php } ?>
    <?php if($_SESSION['ROLE'] == 'pollingOfficer' || $_SESSION['ROLE'] == 'admin'){ ?>
        <h1>Manage Poll</h1>
        <form action="" method="post">
            <div class="col-6">
                <button type="submit" class="btn btn-primary" name="finish">Declare Winner</button>
            </div>
        </form>

        <h2>Two highest voting record</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Number of Votes</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //$query = "SELECT * FROM poll_results WHERE num_votes > 0 ORDER BY num_votes DESC";
                $query = "SELECT * FROM poll_results WHERE num_votes >= 0 ORDER BY num_votes DESC LIMIT 2;";
                $result = $con->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_array()) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']?></td>
                            <td><?php echo $row['username']?></td>
                            <td><?php echo $row['num_votes']?></td>
                        </tr>
                    <?php	}
                }else{
                    echo "<h2>No record found!</h2>";
                } ?>
                </tbody>
            </table>
        </div>

        <h2>Lowest voting record</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Number of Votes</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //$query = "SELECT * FROM poll_results WHERE num_votes > 0 ORDER BY num_votes DESC";
                $query = "SELECT * FROM poll_results WHERE num_votes >= 0 ORDER BY num_votes ASC LIMIT 1;";
                $result = $con->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_array()) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']?></td>
                            <td><?php echo $row['username']?></td>
                            <td><?php echo $row['num_votes']?></td>
                        </tr>
                    <?php	}
                }else{
                    echo "<h2>No record found!</h2>";
                } ?>
                </tbody>
            </table>
        </div>

        <h2>Full voting record</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Number of Votes</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM poll_results WHERE num_votes >= 0 ORDER BY num_votes DESC";
                $result = $con->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_array()) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']?></td>
                            <td><?php echo $row['username']?></td>
                            <td><?php echo $row['num_votes']?></td>
                        </tr>
                    <?php	}
                }else{
                    echo "<h2>No record found!</h2>";
                } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
</html>
