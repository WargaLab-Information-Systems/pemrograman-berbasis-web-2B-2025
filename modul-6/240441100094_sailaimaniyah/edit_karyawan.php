<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: tampil_karyawan.php");
    exit;
}

$id = (int)$_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM karyawan_absensi WHERE id=$id");
if (mysqli_num_rows($result) == 0) {
    header("Location: tampil_karyawan.php");
    exit;
}
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $umur = (int)$_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $departemen = $_POST['departemen'];
    $jabatan =  $_POST['jabatan'];
    $kota_asal = $_POST['kota_asal'];
    $tanggal = $_POST['tanggal'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_pulang = $_POST['jam_pulang'];

    $sql = "UPDATE karyawan_absensi SET 
            nip='$nip', 
            nama='$nama',
            umur=$umur,
            jenis_kelamin='$jenis_kelamin',
            departemen='$departemen',
            jabatan='$jabatan',
            kota_asal='$kota_asal',
            tanggal_absensi='$tanggal',
            jam_masuk='$jam_masuk',
            jam_pulang='$jam_pulang'
            WHERE id=$id";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: tampil_karyawan.php");
        exit;
    } else {
        $error = "Error update data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Edit Data Karyawan & Absensi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

<div class="max-w-xl mx-auto bg-white rounded shadow p-8">
  <h2 class="text-2xl font-semibold mb-6">Edit Data Karyawan & Absensi</h2>

  <?php if (isset($error)) : ?>
    <p class="mb-4 text-red-600"><?= $error ?></p>
  <?php endif; ?>

  <form method="POST" class="space-y-4">
    <div>
      <label for="nip" class="block text-gray-700 font-medium mb-1">NIP</label>
      <input type="text" name="nip" id="nip" value="<?= $data['nip'] ?>" class="w-full border border-gray-300 rounded px-3 py-2" required />
    </div>

    <div>
      <label for="nama" class="block text-gray-700 font-medium mb-1">Nama</label>
      <input type="text" name="nama" id="nama" value="<?= $data['nama'] ?>" class="w-full border border-gray-300 rounded px-3 py-2" required />
    </div>

    <div>
      <label for="umur" class="block text-gray-700 font-medium mb-1">Umur</label>
      <input type="text" name="umur" id="umur" value="<?= $data['umur'] ?>" class="w-full border border-gray-300 rounded px-3 py-2" required />
    </div>

    <div>
      <label for="jenis_kelamin" class="block text-gray-700 font-medium mb-1">Jenis Kelamin</label>
      <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border border-gray-300 rounded px-3 py-2" required>
        <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
        <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
      </select>
    </div>

    <div>
      <label for="departemen" class="block text-gray-700 font-medium mb-1">Departemen</label>
      <input type="text" name="departemen" id="departemen" value="<?= $data['departemen'] ?>" class="w-full border border-gray-300 rounded px-3 py-2" required />
    </div>

    <div>
      <label for="jabatan" class="block text-gray-700 font-medium mb-1">Jabatan</label>
      <input type="text" name="jabatan" id="jabatan" value="<?= $data['jabatan'] ?>" class="w-full border border-gray-300 rounded px-3 py-2" required />
    </div>

    <div>
      <label for="kota_asal" class="block text-gray-700 font-medium mb-1">Kota Asal</label>
      <input type="text" name="kota_asal" id="kota_asal" value="<?= $data['kota_asal'] ?>" class="w-full border border-gray-300 rounded px-3 py-2" required />
    </div>

    <div>
      <label for="tanggal" class="block text-gray-700 font-medium mb-1">Tanggal Absensi</label>
      <input type="date" name="tanggal" id="tanggal" value="<?= $data['tanggal_absensi'] ?>" class="w-full border border-gray-300 rounded px-3 py-2" required />
    </div>

    <div>
      <label for="jam_masuk" class="block text-gray-700 font-medium mb-1">Jam Masuk</label>
      <input type="time" name="jam_masuk" id="jam_masuk" value="<?= $data['jam_masuk'] ?>" class="w-full border border-gray-300 rounded px-3 py-2" required />
    </div>

    <div>
      <label for="jam_pulang" class="block text-gray-700 font-medium mb-1">Jam Pulang</label>
      <input type="time" name="jam_pulang" id="jam_pulang" value="<?= $data['jam_pulang'] ?>" class="w-full border border-gray-300 rounded px-3 py-2" required />
    </div>

    <button type="submit" name="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Data</button>
  </form>

  <p class="mt-4 text-sm">
    <a href="tampil_karyawan.php" class="text-blue-600 underline">Kembali</a>
  </p>
</div>

</body>
</html>
