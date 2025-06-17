<?php
$host = 'localhost'; $db = 'manajemen_karyawan'; $user = 'root'; $pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $departemen = $_POST['departemen'];
    $jabatan = $_POST['jabatan'];
    $kota_asal = $_POST['kota_asal'];
    $tanggal_absensi = $_POST['tanggal_absensi'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_pulang = $_POST['jam_pulang'];

    $stmt = $conn->prepare("INSERT INTO karyawan_absensi (nip, nama, umur, jenis_kelamin, departemen, jabatan, kota_asal, tanggal_absensi, jam_masuk, jam_pulang) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssisssssss", $nip, $nama, $umur, $jenis_kelamin, $departemen, $jabatan, $kota_asal, $tanggal_absensi, $jam_masuk, $jam_pulang);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Data Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100 flex items-center justify-center min-h-screen">

  <form method="POST" class="bg-white p-8 rounded-lg shadow-md w-full max-w-xl">
    <h2 class="text-2xl font-bold text-blue-600 mb-6 text-center">Tambah Data Karyawan & Absensi</h2>

    <div class="grid grid-cols-1 gap-4">
      <input type="text" name="nip" placeholder="NIP" class="border px-4 py-2 rounded" required>
      <input type="text" name="nama" placeholder="Nama" class="border px-4 py-2 rounded" required>
      <input type="number" name="umur" placeholder="Umur" class="border px-4 py-2 rounded" required>
      
      <select name="jenis_kelamin" class="border px-4 py-2 rounded" required>
        <option value="">Pilih Jenis Kelamin</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>

      <input type="text" name="departemen" placeholder="Departemen" class="border px-4 py-2 rounded" required>
      <input type="text" name="jabatan" placeholder="Jabatan" class="border px-4 py-2 rounded" required>
      <input type="text" name="kota_asal" placeholder="Kota Asal" class="border px-4 py-2 rounded" required>
      
      <label class="text-sm">Tanggal Absensi:</label>
      <input type="date" name="tanggal_absensi" class="border px-4 py-2 rounded" required>
      <label class="text-sm">Jam Masuk:</label>
      <input type="time" name="jam_masuk" class="border px-4 py-2 rounded" required>
      <label class="text-sm">Jam Pulang:</label>
      <input type="time" name="jam_pulang" class="border px-4 py-2 rounded" required>

      <input type="submit" value="Simpan" class="bg-blue-600 hover:bg-blue-700 text-white py-2 rounded mt-4 cursor-pointer">
    </div>
  </form>

</body>
</html>
