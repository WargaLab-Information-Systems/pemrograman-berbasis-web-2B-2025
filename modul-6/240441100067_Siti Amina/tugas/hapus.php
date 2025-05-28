<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
require 'koneksi.php';

$id = $_GET['id'];

$koneksi->query("DELETE FROM karyawan_absensi WHERE id=$id");

echo "<script>alert('Data berhasil dihapus.'); window.location='data_karyawan.php';</script>";
