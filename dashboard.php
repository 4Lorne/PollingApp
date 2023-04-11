<?php
session_start();
// Include database connection file
include_once('config.php');
if (!isset($_SESSION['ID'])) {
    header("Location:login.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-info sticky-top flex-md-nowrap p-10">
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="logout.php">Hi, <?php echo ucwords($_SESSION['NAME']); ?> Log out</a>
        </li>
    </ul>
</nav>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="">
                            <span data-feather="home"></span>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <?php if($_SESSION['ROLE'] == 'user'){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="vote.php">
                                <span data-feather="thumbs-up"></span>
                                Vote
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($_SESSION['ROLE'] == 'pollingOfficer'){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="create.php">
                                <span data-feather="users"></span>
                                Create a Poll
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['ROLE'] == 'admin') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="create.php">
                                <span data-feather="users"></span>
                                Create a Poll
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
                <h1 class="h2">Dashboard</h1>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Created</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($_SESSION['ROLE'] == "admin") {
                        $query = "SELECT * FROM admins";
                        $result = $con->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_array()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo $row['username']?></td>
                                    <td><?php echo $row['role']?></td>
                                    <td><?php echo date('d-M-Y', strtotime($row['created']))?></td>
                                </tr>
                            <?php	}
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    feather.replace();
</script>
</body>
</html>