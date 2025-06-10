<?php
include "../koneksi.php";

if (!isset($_GET['nip'])) {
    header("Location: index.php");
    exit;
}

$nip = $_GET['nip'];

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jabatan = $_POST['jabatan'];
    $departemen = $_POST['departemen'];
    $asal_kota = $_POST['asal_kota'];

    $query = "UPDATE karyawan_absensi SET 
                nama='$nama', 
                umur='$umur', 
                jenis_kelamin='$jenis_kelamin', 
                jabatan='$jabatan', 
                departemen='$departemen', 
                kota_asal='$asal_kota' 
              WHERE nip='$nip'";

    mysqli_query($conn, $query);

    header("Location: daftar.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM karyawan_absensi WHERE nip='$nip'");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Data Karyawan</title>
    <link rel="stylesheet" href="../src/edit.css" />
</head>
<body>
<a href="../pengaturan.php" class="btn-back">Kembali</a>
<h1>EDIT DATA KARYAWAN</h1>
<div style="
    background-color: ##f8ecac;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    max-width: 800px;
    margin: 0 auto;
">

<form method="POST">
  <div class="form-columns">
    <div class="form-column">
      <div class="form-row">
        <label for="nip">NIP:</label>
        <input type="text" id="nip" name="nip" value="<?= htmlspecialchars($data['nip']) ?>" readonly />
      </div>

      <div class="form-row">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required />
      </div>

      <div class="form-row">
        <label for="umur">Umur:</label>
        <input type="number" id="umur" name="umur" value="<?= htmlspecialchars($data['umur']) ?>" min="0" />
      </div>

      <div class="form-row">
        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select name="jenis_kelamin" id="jenis_kelamin" required>
          <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
          <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
        </select>
      </div>
    </div>

    <div class="form-column">
      <div class="form-row">
        <label for="jabatan">Jabatan:</label>
        <input type="text" id="jabatan" name="jabatan" value="<?= htmlspecialchars($data['jabatan']) ?>" />
      </div>

      <div class="form-row">
        <label for="departemen">Departemen:</label>
        <input type="text" id="departemen" name="departemen" value="<?= htmlspecialchars($data['departemen']) ?>" />
      </div>

      <div class="form-row">
        <label for="asal_kota">Asal Kota:</label>
        <input type="text" id="asal_kota" name="asal_kota" value="<?= htmlspecialchars($data['kota_asal']) ?>" />
      </div>
    </div>
  </div>

  <button type="submit" name="update">Simpan</button>
</div>
</form>

</body>

<footer style="color: #1c0a0a; padding: 20px 0; text-align: center;">
  <p>&copy; 2025 siskaisn Website. All rights reserved.</p>
  <p>Contact: <a href="https://www.instagram.com/sissssskaaaaaisn?igsh=MTMxaG8zODQ2ZncybA==" style="color: #1c0a0a; text-decoration: underline;">@sissssskaaaaaisn</a></p>
</footer>
</html>
