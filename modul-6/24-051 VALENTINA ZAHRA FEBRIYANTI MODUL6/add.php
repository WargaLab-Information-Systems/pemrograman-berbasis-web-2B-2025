<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php1");
    exit;
}

include "koneksi.php";

if (isset($_POST['submit'])) {
    $nip = htmlspecialchars($_POST['nip']);
    $nama = htmlspecialchars($_POST['nama']);
    $umur = (int)$_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $departemen = htmlspecialchars($_POST['departemen']);
    $jabatan = htmlspecialchars($_POST['jabatan']);
    $kota_asal = htmlspecialchars($_POST['kota_asal']);
    $tanggal_absensi = $_POST['tanggal_absensi'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_pulang = $_POST['jam_pulang'];

    // Validasi sederhana bisa ditambah

    $stmt = $conn->prepare("INSERT INTO karyawan_absensi (nip, nama, umur, jenis_kelamin, departemen, jabatan, kota_asal, tanggal_absensi, jam_masuk, jam_pulang) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissssssss", $nip, $nama, $umur, $jenis_kelamin, $departemen, $jabatan, $kota_asal, $tanggal_absensi, $jam_masuk, $jam_pulang);
    $stmt->execute();
    $stmt->close();

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Tambah Data Karyawan & Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <form method="POST" class="bg-white p-6 rounded shadow-md max-w-xl w-full space-y-4">
        <h2 class="text-2xl font-semibold text-indigo-600 mb-4">Tambah Data Karyawan & Absensi</h2>
        <input type="text" name="nip" placeholder="NIP" required class="w-full p-2 border rounded" />
        <input type="text" name="nama" placeholder="Nama" required class="w-full p-2 border rounded" />
        <input type="number" name="umur" placeholder="Umur" min="1" required class="w-full p-2 border rounded" />
        
        <div>
            <label class="mr-4">Jenis Kelamin:</label>
            <label><input type="radio" name="jenis_kelamin" value="Laki-laki" required> Laki-laki</label>
            <label class="ml-4"><input type="radio" name="jenis_kelamin" value="Perempuan" required> Perempuan
