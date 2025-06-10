<?php 
session_start();
include '../koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: ./daftar.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $umur = (int)$_POST['umur']; 
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jabatan = $_POST['jabatan'];
    $departemen = $_POST['departemen'];
    $kota_asal = $_POST['kota_asal'];

    if ($nip && $nama) {
        if ($umur < 0) {
            $pesan = "Umur harus berupa angka positif.";
        } else {
            $sql = "INSERT INTO karyawan_absensi 
            (nip, nama, umur, jenis_kelamin, jabatan, departemen, kota_asal) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);
            if (!$stmt) {
                die("Prepare failed: " . mysqli_error($conn));
            }

            mysqli_stmt_bind_param($stmt, "ssissss", 
                $nip, $nama, $umur, $jenis_kelamin, $jabatan, $departemen, $kota_asal);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: daftar.php");
                exit;
            } else {
                $pesan = "Error saat menyimpan: " . mysqli_stmt_error($stmt);
            }
        }
    } else {
        $pesan = "NIP dan Nama wajib diisi.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Tambah Kayawan</title>
<link rel="stylesheet" href="../src/putput.css" />

</head>

<body>

<a href="../pengaturan.php" class="btn-back">Kembali</a>
  <h1>TAMBAH DATA KARYAWAN</h1>

  <?php if (isset($pesan)) echo "<p>" . htmlspecialchars($pesan) . "</p>"; ?>

<form action="input.php" method="POST">
  <div class="form-columns">

    <div class="form-column">
      <div class="form-row">
        <label for="nip">NIP:</label>
        <input type="text" name="nip" id="nip" required>
      </div>
      <div class="form-row">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required>
      </div>
      <div class="form-row">
        <label for="umur">Umur:</label>
        <input type="number" name="umur" id="umur" required>
      </div>
      <div class="form-row">
        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select name="jenis_kelamin" id="jenis_kelamin" required>
          <option value="">--Pilih Jenis Kelamin--</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>
    </div>

    <div class="form-column">
      <div class="form-row">
        <label for="jabatan">Jabatan:</label>
        <input type="text" name="jabatan" id="jabatan">
      </div>
      <div class="form-row">
        <label for="departemen">Departemen:</label>
        <input type="text" name="departemen" id="departemen">
      </div>
      <div class="form-row">
        <label for="kota_asal">Asal Kota:</label>
        <input type="text" name="kota_asal" id="kota_asal">
      </div>
    </div>

  </div>
<button class="submit-btn" type="submit">Simpan</button>


  </form>
</body>
<footer style="color: #1c0a0a; padding: 20px 0; text-align: center;">
  <p>&copy; 2025 siskaisn Website. All rights reserved.</p>
  <p>Contact: <a href="https://www.instagram.com/sissssskaaaaaisn?igsh=MTMxaG8zODQ2ZncybA==" style="color: #1c0a0a; text-decoration: underline;">@sissssskaaaaaisn</a></p>
</footer>

</html>