<?php
include "koneksi.php";

$nim = $_GET['nim'];
$result = mysqli_query($conn, "SELECT * FROM mhs WHERE nim=$nim");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $asal = $_POST['asal'];
    mysqli_query($conn, "UPDATE mhs SET nama='$nama', asal='$asal' WHERE nim=$nim");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <a href="index.php" class="back-link">← Kembali ke Daftar</a>
        <h2>Edit Data Mahasiswa</h2>
        <form method="POST">
            <input type="text" name="nama" value="<?= $data['nama'] ?>" placeholder="Nama Mahasiswa" required>
            <input type="text" name="asal" value="<?= $data['asal'] ?>" placeholder="Asal Daerah" required>
            <button type="submit" name="update">Perbarui Data</button>
        </form>
    </div>
</body>

</html>