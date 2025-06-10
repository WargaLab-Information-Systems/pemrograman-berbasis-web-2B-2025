<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

$err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $input_pass = $_POST['password'];
  $username = $_SESSION['login'];

  $query = mysqli_query($conn, "SELECT password FROM users WHERE username='$username'");
  $data = mysqli_fetch_assoc($query);

  if (password_verify($input_pass, $data['password'])) {
    session_destroy();
    header("Location: login.php");
    exit;
  } else {
    $err = "Password salah. coba lagi.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <link href="src/logout.css" rel="stylesheet">
</head>
<body>
  <div class="logout-container">
    <div class="logout-box">
      <h2>Yakin mau keluar nih?</h2>
      <p>Masukkin Passwordnya dulu</p>

      <?php if ($err): ?>
        <div class="notif"><?= $err ?></div>
      <?php endif; ?>

      <form method="POST">
        <div class="input-group">
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="actions">
          <button type="button" class="btn cancel" onclick="window.location.href='index.php'">Batal</button>
          <button class="btn submit" type="submit">Keluar</button>

        </div>
      </form>
      </body>
</html>
