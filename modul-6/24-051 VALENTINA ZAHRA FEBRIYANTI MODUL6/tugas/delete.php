<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include "koneksi1.php";

// Ambil id dari URL
$id = $_GET['id'] ?? '';

if ($id) {
    $query = "DELETE FROM karyawan_absensi WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Gagal menghapus data: " . mysqli_error($conn));
    }
}

header("Location: dashboard.php");
exit;
