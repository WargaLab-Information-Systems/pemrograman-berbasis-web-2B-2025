<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login']) || !isset($_SESSION['nip'])) {
    echo "login dulu!";
    exit;
}

$nip = $_SESSION['nip'];
$sql = "SELECT * FROM karyawan_absensi WHERE nip = ?";
$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    die("QUERY ERROR: " . mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, "s", $nip);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Datanya gadaaaa woe, diquery dulu sana.";
    exit;

    
}

$user = mysqli_fetch_assoc($result);
$foto_path = "img/default.jpg";
$exts = ['jpg', 'jpeg', 'png', 'gif'];
foreach ($exts as $ext) {
    $path = "img/" . $nip . "." . $ext;
    if (file_exists($path)) {
        $foto_path = $path;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="src/profile.css" rel="stylesheet" />
    <title>Profile</title>
</head>
<body>
    <?php include "layout/ds.php"; ?>
  <h1>PROFILE</h1>
    <div class="profile-container">
        <img src="<?= $foto_path ?>" alt="Foto Profil" class="profile-photo" />

        <div class="profile-info">
            <table>
                <tr><th>NIP</th><td><?= isset($user['nip']) ? htmlspecialchars($user['nip']) : '' ?></td></tr>
                <tr><th>Nama</th><td><?= isset($user['nama']) ? htmlspecialchars($user['nama']) : '' ?></td></tr>
                <tr><th>Umur</th><td><?= isset($user['umur']) ? htmlspecialchars($user['umur']) : '' ?></td></tr>
                <tr><th>Jenis Kelamin</th><td><?= isset($user['jenis_kelamin']) ? htmlspecialchars($user['jenis_kelamin']) : '' ?></td></tr>
                <tr><th>Departemen</th><td><?= isset($user['departemen']) ? htmlspecialchars($user['departemen']) : '' ?></td></tr>
                <tr><th>Jabatan</th><td><?= isset($user['jabatan']) ? htmlspecialchars($user['jabatan']) : '' ?></td></tr>
                <tr><th>Asal kota</th><td><?= isset($user['Asal_kota']) ? htmlspecialchars($user['Asal_kota']) : '' ?></td></tr>
            </table>
        </div>
    </div>


</body>

<footer style="color: #1c0a0a; padding: 20px 0; text-align: center;">
  <p>&copy; 2025 siskaisn Website. All rights reserved.</p>
  <p>Contact: <a href="https://www.instagram.com/sissssskaaaaaisn?igsh=MTMxaG8zODQ2ZncybA==" style="color: #1c0a0a; text-decoration: underline;">@sissssskaaaaaisn</a></p>
</footer>
 
</html>
