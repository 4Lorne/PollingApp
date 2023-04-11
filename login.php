<!--
Code is heavily inspired by the website below and refactored to fit the assignment requirements
https://webscodex.medium.com/creating-multi-user-role-based-admin-using-php-mysql-and-bootstrap-dbebf2740411
-->

<!--
TODO: Polling officer declare result
      View voting records
      Set user votes to 0 when new poll is created
-->

<?php
session_start();
if (isset($_SESSION['ID'])) {
    header("Location:dashboard.php");
    exit();
}
// Include database connectivity

include_once('config.php');

if (isset($_POST['submit'])) {
    $errorMsg = "";
    $username = $con->real_escape_string($_POST['username']);
    $password = $con->real_escape_string(md5($_POST['password']));
    if (!empty($username) || !empty($password)) {
        $query = "SELECT * FROM admins WHERE username = '$username'";
        $result = $con->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['ID'] = $row['id'];
            $_SESSION['ROLE'] = $row['role'];
            $_SESSION['USERNAME'] = $row['username'];
            $_SESSION['NAME'] = $row['name'];
            //Depending on the route, the user will be routed to the appropriate page
            header("Location:dashboard.php");

            die();
        } else {
            $errorMsg = "No user found on this username";
        }
    } else {
        $errorMsg = "Username and Password is required";
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
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
<div class="container d-flex justify-content-center">
    <div class="row col-8">
        <form action="" method="POST" class="pt-4">
            <?php if (isset($errorMsg)) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $errorMsg; ?>
                </div>
            <?php } ?>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <p>Not registered yet ?<a href="register.php"> Register here</a></p>
                <input type="submit" name="submit" class="btn btn-success" value="Login">
            </div>
        </form>
    </div>
</div>
</body>
<footer>
    <script src="js/bootstrap.bundle.min.js"></script>
</footer>
</html>
