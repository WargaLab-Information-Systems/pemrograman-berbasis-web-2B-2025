<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input_pass = $_POST['logpass'];
    $username = $_SESSION['login'];

    $query = mysqli_query($conn, "SELECT password FROM users WHERE username='$username'");
    $data = mysqli_fetch_assoc($query);

    if ($data && password_verify($input_pass, $data['password'])) {
        session_destroy();
        header("Location: login.php");
        exit;
    } else {
        $err = "Password salah. coba lagi.";
    }
}
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Konfirmasi Keluar</title>
    <link href="src/ppp.css" rel="stylesheet" />
</head>
<body class="flex flex-col min-h-screen">
    <div class="card">
        <h4 class="title">Yakin mau keluar nih?</h4>
        <?php if ($err): ?>
            <div class="notif"><?= htmlspecialchars($err) ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="field">
                <svg class="input-icon" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                    <path d="M80 192V144C80 64.47 144.5 0 224 0C303.5 0 368 64.47 368 144V192H384C419.3 192 448 220.7 448 256V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V256C0 220.7 28.65 192 64 192H80zM144 192H304V144C304 99.82 268.2 64 224 64C179.8 64 144 99.82 144 144V192z"></path>
                </svg>
                <input 
                    autocomplete="off" 
                    id="logpass" 
                    name="logpass" 
                    type="password" 
                    class="input-field" 
                    placeholder="Password" 
                    required 
                />
            </div>

            <div class="form-buttons">
                <a href="index.php" class="btn cancel">Batal</a>
                <button class="btn submit" type="submit">Keluar</button>
            </div>
        </form>
    </div>

    <footer style="color: white; padding: 20px 0; text-align: center;">
        <p>&copy; 2025 siskaisn Website. All rights reserved.</p>
        <p>Contact: <a href="https://www.instagram.com/sissssskaaaaaisn?igsh=MTMxaG8zODQ2ZncybA==" style="color: white; text-decoration: underline;">@sissssskaaaaaisn</a></p>
    </footer>
</body>
</html>
