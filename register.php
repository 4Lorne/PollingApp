<!--
Used to register new users of various roles.
-->

<?php
// Include database connection file
include_once('config.php');
if (isset($_POST['submit'])) {

    $username = $con->real_escape_string($_POST['username']);
    $password = $con->real_escape_string(md5($_POST['password']));
    $name     = $con->real_escape_string($_POST['name']);
    $role     = $con->real_escape_string($_POST['role']);
    $query  = "INSERT INTO admins (name,username,password,role) VALUES ('$name','$username','$password','$role')";
    $result = $con->query($query);
    //If the query is true, the web page will route to the login page.
    if ($result==true) {
        header("Location:login.php");
        die();
    }else{
        $errorMsg  = "You are not registered..please try again.";
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
    <title>Register</title>
</head>
<body>
<div class="container d-flex justify-content-center">
    <div class="row col-8">
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name" required="">
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" placeholder="Enter Username" required="">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" placeholder="Enter Password" required="">
            </div>
            <!-- Allows the user to sign up as any role. -->
            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" name="role" required="">
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="pollingOfficer">Polling Officer</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="form-group">
                <p>Already have account?<a href="login.php" class="ps-2">Login</a></p>
                <input type="submit" name="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
</body>
<footer>
    <script src="js/bootstrap.bundle.min.js"></script>
</footer>
</html>