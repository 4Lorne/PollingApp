<?php include('server.php') ?>

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
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" >
                <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <!--<div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>-->
            <button type="reset" id="submitButton" class="btn btn-primary col-2 mt-2 ms-2 submit-button">Register</button>
            <script type="text/javascript">
                document.getElementById("submitButton").onclick = function () {
                    location.href = "login.php";
                };
            </script>
        </form>
    </div>

    <!--<div class="col-sm-12 text-center">
        <h1>Login</h1>

    </div>
</div>
<div class="row">
    <div class="col-sm-8 text-center">
        <h2>Username</h2>
        <button type="button" class="btn btn-primary">Sign Up</button>
    </div>
</div>-->
</div>

<!-- https://webscodex.medium.com/creating-multi-user-role-based-admin-using-php-mysql-and-bootstrap-dbebf2740411 -->
</body>


<footer>
    <script src="js/bootstrap.bundle.min.js"></script>
</footer>
</html>
