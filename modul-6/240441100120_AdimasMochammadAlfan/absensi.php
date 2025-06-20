<?php
require_once 'config.php';

// Fungsi CRUD Absensi
if (isset($_POST['tambah_absensi'])) {
    $karyawan_id = (int)$_POST['karyawan_id'];
    $tanggal_absensi = mysqli_real_escape_string($conn, $_POST['tanggal_absensi']);
    $jam_masuk = mysqli_real_escape_string($conn, $_POST['jam_masuk']);
    $jam_pulang = mysqli_real_escape_string($conn, $_POST['jam_pulang']);
    
    mysqli_query($conn, "INSERT INTO absensi (karyawan_id, tanggal_absensi, jam_masuk, jam_pulang) 
                        VALUES ($karyawan_id, '$tanggal_absensi', '$jam_masuk', '$jam_pulang')");
    $_SESSION['pesan'] = "Data absensi berhasil ditambahkan!";
    header("Location: index.php?page=absensi");
    exit();
}

// Ambil data absensi
$absensi = mysqli_query($conn, "SELECT a.*, k.nama FROM absensi a JOIN karyawan k ON a.karyawan_id = k.id");
$daftar_absensi = mysqli_fetch_all($absensi, MYSQLI_ASSOC);
?>