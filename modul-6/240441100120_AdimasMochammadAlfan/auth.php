<?php
require_once 'config.php';

// Fungsi untuk registrasi
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
    $_SESSION['pesan'] = "Registrasi berhasil! Silakan login.";
    header("Location: index.php");
    exit();
}

// Fungsi untuk login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    $user = mysqli_fetch_assoc($result);
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Username atau password salah!";
    }
}

// Fungsi untuk logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>