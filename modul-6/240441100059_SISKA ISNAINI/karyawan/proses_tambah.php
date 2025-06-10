<?php 
session_start();
include '../koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: ./daftar.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nip = $_POST['nip'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $umur = isset($_POST['umur']) ? (int)$_POST['umur'] : 0;
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
    $jabatan = $_POST['jabatan'] ?? '';
    $departemen = $_POST['departemen'] ?? '';
    $kota_asal = $_POST['kota_asal'] ?? '';

    if ($nip && $nama) {
        if ($umur < 0) {
            $pesan = "Umur harus berupa angka positif.";
        } else {
            $sql = "INSERT INTO karyawan_absensi 
            (nip, nama, umur, jenis_kelamin, jabatan, departemen, kota_asal) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);
            if (!$stmt) {
                die("Prepare failed: " . mysqli_error($conn));
            }

            mysqli_stmt_bind_param($stmt, "ssissss", 
                $nip, $nama, $umur, $jenis_kelamin, $jabatan, $departemen, $kota_asal);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: tambah_karyawan.php?pesan=Data berhasil ditambahkan");
                exit;
            } else {
                $pesan = "Error saat menyimpan: " . mysqli_stmt_error($stmt);
            }
        }
    } else {
        $pesan = "NIP dan Nama wajib diisi.";
    }

    header("Location: tambah_karyawan.php?pesan=" . urlencode($pesan));
    exit;
} else {
    header("Location: tambah_karyawan.php");
    exit;
}
