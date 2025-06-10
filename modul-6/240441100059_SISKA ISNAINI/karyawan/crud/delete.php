<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];

    $sql = "DELETE FROM karyawan_absensi WHERE nip = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "s", $nip);

    if (mysqli_stmt_execute($stmt)) {

        header("Location: edit.php?pesan=hapus_berhasil");
        exit;
    } else {
        echo "Error hapus data: " . mysqli_error($conn);
    }
} else {
    echo "Data nip tidak ditemukan.";
}
?>
