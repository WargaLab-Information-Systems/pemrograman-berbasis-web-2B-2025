<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
require 'koneksi.php';

$id = $_GET['id'];
$result = $koneksi->query("SELECT * FROM karyawan_absensi WHERE id=$id");
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $NIP = $_POST['nip'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jk = $_POST['jenis_kelamin'];
    $departemen = $_POST['departemen'];
    $jabatan = $_POST['jabatan'];
    $kota_asal = $_POST['kota_asal'];
    $tanggal = $_POST['tanggal_absensi'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_pulang = $_POST['jam_pulang'];

    $stmt = $koneksi->prepare("UPDATE karyawan_absensi SET nip=?, nama=?, umur=?, jenis_kelamin=?, departemen=?, jabatan=?, kota_asal=?, tanggal_absensi=?, jam_masuk=?, jam_pulang=? WHERE id=?");
    $stmt->bind_param("ssisssssssi", $NIP, $nama, $umur, $jk, $departemen, $jabatan, $kota_asal, $tanggal, $jam_masuk, $jam_pulang, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='data_karyawan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded mt-10">
    <h2 class="text-xl font-bold mb-4">Edit Data Karyawan</h2>
    <form method="POST" class="grid grid-cols-2 gap-4">
        <input type="text" name="nip" value="<?= $data['NIP'] ?>" required class="col-span-2 px-3 py-2 border rounded">
        <input type="text" name="nama" value="<?= $data['nama'] ?>" required class="px-3 py-2 border rounded">
        <input type="number" name="umur" value="<?= $data['umur'] ?>" required class="px-3 py-2 border rounded">
        <select name="jenis_kelamin" required class="px-3 py-2 border rounded">
            <option value="">-- Jenis Kelamin --</option>
            <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
            <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
        </select>
        <input type="text" name="departemen" value="<?= $data['departemen'] ?>" required class="px-3 py-2 border rounded">
        <input type="text" name="jabatan" value="<?= $data['jabatan'] ?>" required class="px-3 py-2 border rounded">
        <input type="text" name="kota_asal" value="<?= $data['kota_asal'] ?>" required class="px-3 py-2 border rounded">
        <input type="date" name="tanggal_absensi" value="<?= $data['tanggal_absensi'] ?>" required class="px-3 py-2 border rounded">
        <input type="time" name="jam_masuk" value="<?= $data['jam_masuk'] ?>" required class="px-3 py-2 border rounded">
        <input type="time" name="jam_pulang" value="<?= $data['jam_pulang'] ?>" required class="px-3 py-2 border rounded">
        <button type="submit" class="col-span-2 bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
    <div class="mt-4">
        <a href="data_karyawan.php" class="text-blue-600">← Kembali ke Data</a>
    </div>
</div>
</body>
</html>
