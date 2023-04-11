<?php
// Include database connection file
include_once('config.php');
session_start();

if (!isset($_SESSION['total_votes'])) {
    $_SESSION['total_votes'] = 0;
}
// Retrieve the poll question from the database
$query = "SELECT question FROM polls LIMIT 1";
$result = $con->query($query);
$question = '';
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $question = $row['question'];
}

if (isset($_POST['submit'])) {
    $username = $con->real_escape_string($_SESSION['USERNAME']);
    $num_votes = $con->real_escape_string($_SESSION['total_votes']);

    // Check if username already exists in the database
    $query = "SELECT * FROM poll_results WHERE username = '$username'";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        // If username already exists, update the row
        $query = "UPDATE poll_results SET num_votes = '$num_votes'+ num_votes, created = current_time() WHERE username = '$username'";
    } else {
        // If username doesn't exist, insert a new row
        $role = $con->real_escape_string($_SESSION['ROLE']);
        $query = "INSERT INTO poll_results (username, role, num_votes, created) VALUES ('$username', '$role', '$num_votes', current_time())";
    }

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
$max_votes = 5; // maximum number of total votes allowed
$total_votes = $_SESSION['total_votes']; // get current total votes
if ($total_votes >= $max_votes) {
    echo "Maximum number of total votes reached.";
} else {
    if (isset($_POST['no_vote'])) {
        $_SESSION['no_click'] += 1;
        $_SESSION['total_votes'] += 1;
    } else if (isset($_POST['yes_vote'])){
        $_SESSION['yes_click'] += 1;
        $_SESSION['total_votes'] += 1;
    } else {
        $_SESSION['yes_click'] = 0;
        $_SESSION['no_click'] = 0;
        $_SESSION['total_votes'] = 0;
    }
}

$yes_click = $_SESSION['yes_click'];
$no_click = $_SESSION['no_click'];
$total_votes = $_SESSION['total_votes'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="container d-flex justify-content-center align-items-center">
    <div class="row">
        <div class="col">
            <form action="" method="post">
                <div class="col-12">
                    <p><?php echo $question?></p>
                </div>
                <div class="col-4">
                    <div class="row">
                        <button type="submit" class="btn btn-success" name="yes_vote">Yes</button>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <button type="submit" class="btn btn-danger" name="no_vote">No</button>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col">
            <div class="row">
                <div class="col-12">
                    <p>Yes</p>
                    <span class='badge bg-success'><?php echo $_SESSION['yes_click']; ?></span>
                </div>
                <div class="col-12">
                    <p>No</p>
                    <span class='badge bg-success'><?php echo $_SESSION['no_click']; ?></span>
                </div>
                <div class="col-12">
                    <p>Total Votes <?php echo $_SESSION['total_votes']; ?>/<?php echo 5; ?></p>
                    <span class='badge bg-success'><?php echo $_SESSION['total_votes']; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
