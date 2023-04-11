<?php
// Include database connection file
include_once 'config.php';

if (isset($_POST['submit'])) {
    // Sanitize user inputs
    $username = $con->real_escape_string($_POST['username']);
    $password = $con->real_escape_string(md5($_POST['password']));
    $name = $con->real_escape_string($_POST['name']);
    $role = $con->real_escape_string($_POST['role']);

    // Insert user data into the database
    $query = "INSERT INTO admins (name, username, password, role) VALUES ('$name', '$username', '$password', '$role')";
    $result = $con->query($query);

    // Redirect to login page if registration is successful
    if ($result) {
        header('Location: login.php');
        exit();
    } else {
        $errorMsg = 'Registration failed. Please try again.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="container d-flex justify-content-center">
    <div class="row col-8">
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
            </div>
            <!-- Allows the user to sign up as any role. -->
            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" name="role" required>
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="pollingOfficer">Polling Officer</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="form-group">
                <p>Already have an account? <a href="login.php" class="ps-2">Login</a></p>
                <input type="submit" name="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
<footer>
    <script src="js/bootstrap.bundle.min.js"></script>
</footer>
</body>
</html>
