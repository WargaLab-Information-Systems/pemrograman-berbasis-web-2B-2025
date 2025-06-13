<?php
session_start();
include_once 'koneksi.php';

// Cek apakah user login dan berperan sebagai admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: dashboard_admin.php');
    exit;
}

// Hapus data karyawan berdasarkan id
$query = mysqli_query($conn, "DELETE FROM karyawan WHERE id = $id");

if ($query) {
    // Jika perlu, bisa juga set session pesan sukses untuk tampil di dashboard_admin.php
    $_SESSION['pesan'] = "Data karyawan berhasil dihapus.";
} else {
    $_SESSION['pesan'] = "Gagal menghapus data karyawan.";
}

header('Location: dashboard_admin.php');
exit;
