<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
require 'koneksi.php';

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

    $stmt = $koneksi->prepare("INSERT INTO karyawan_absensi (nip, nama, umur, jenis_kelamin, departemen, jabatan, kota_asal, tanggal_absensi, jam_masuk, jam_pulang)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisssssss", $NIP, $nama, $umur, $jk, $departemen, $jabatan, $kota_asal, $tanggal, $jam_masuk, $jam_pulang);

    if ($stmt->execute()) {
        echo "<script>alert('Data karyawan berhasil ditambahkan!'); window.location='data_karyawan.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto p-6 bg-white shadow rounded mt-10">
        <h2 class="text-xl font-bold mb-4">Tambah Data Karyawan</h2>
        <form method="POST" class="grid grid-cols-2 gap-4">
            <input type="text" name="nip" required placeholder="NIP" class="col-span-2 px-3 py-2 border rounded">
            <input type="text" name="nama" required placeholder="Nama" class="px-3 py-2 border rounded">
            <input type="number" name="umur" required placeholder="Umur" class="px-3 py-2 border rounded">
            <select name="jenis_kelamin" required class="px-3 py-2 border rounded">
                <option value="">-- Jenis Kelamin --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <input type="text" name="departemen" required placeholder="Departemen" class="px-3 py-2 border rounded">
            <input type="text" name="jabatan" required placeholder="Jabatan" class="px-3 py-2 border rounded">
            <input type="text" name="kota_asal" required placeholder="Kota Asal" class="px-3 py-2 border rounded">
            <input type="date" name="tanggal_absensi" required class="px-3 py-2 border rounded">
            <input type="time" name="jam_masuk" required class="px-3 py-2 border rounded">
            <input type="time" name="jam_pulang" required class="px-3 py-2 border rounded">
            <button type="submit" class="col-span-2 bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
        <div class="mt-4">
            <a href="dashboard.php" class="text-blue-600">← Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
