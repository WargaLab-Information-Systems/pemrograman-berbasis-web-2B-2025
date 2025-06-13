<?php
require 'config.php';
requireLogin();

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Employee System</a>
            <div class="navbar-nav">
                <a class="nav-link" href="?logout">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Employee Management</h5>
                    </div>
                    <div class="card-body">
                        <a href="employees.php" class="btn btn-primary">Manage Employees</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Attendance Management</h5>
                    </div>
                    <div class="card-body">
                        <a href="attendance.php" class="btn btn-primary">Manage Attendance</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>