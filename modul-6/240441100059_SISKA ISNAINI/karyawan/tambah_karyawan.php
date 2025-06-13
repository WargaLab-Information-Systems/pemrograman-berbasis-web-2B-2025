<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ./daftar.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Tambah Karyawan</title>
  <link rel="stylesheet" href="../src/putput.css" />
</head>

<body>

<a href="../pengaturan.php" class="btn-back">Kembali</a>
<h1>TAMBAH DATA KARYAWAN</h1>

<?php if (isset($_GET['pesan'])) echo "<p>" . htmlspecialchars($_GET['pesan']) . "</p>"; ?>

<form action="proses_tambah.php" method="POST">
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
