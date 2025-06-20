<?php
require_once 'config.php';

// Fungsi CRUD Karyawan
if (isset($_POST['tambah_karyawan'])) {
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $umur = (int)$_POST['umur'];
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $departemen = mysqli_real_escape_string($conn, $_POST['departemen']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $kota_asal = mysqli_real_escape_string($conn, $_POST['kota_asal']);
    
    mysqli_query($conn, "INSERT INTO karyawan (nip, nama, umur, jenis_kelamin, departemen, jabatan, kota_asal) 
                        VALUES ('$nip', '$nama', $umur, '$jenis_kelamin', '$departemen', '$jabatan', '$kota_asal')");
    $_SESSION['pesan'] = "Data karyawan berhasil ditambahkan!";
    header("Location: index.php?page=karyawan");
    exit();
}

// Fungsi Update Karyawan
if (isset($_POST['update_karyawan'])) {
    $id = (int)$_POST['id'];
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $umur = (int)$_POST['umur'];
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $departemen = mysqli_real_escape_string($conn, $_POST['departemen']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $kota_asal = mysqli_real_escape_string($conn, $_POST['kota_asal']);
    
    mysqli_query($conn, "UPDATE karyawan SET 
        nip = '$nip', 
        nama = '$nama', 
        umur = $umur, 
        jenis_kelamin = '$jenis_kelamin', 
        departemen = '$departemen', 
        jabatan = '$jabatan', 
        kota_asal = '$kota_asal' 
        WHERE id = $id");
    
    $_SESSION['pesan'] = "Data karyawan berhasil diupdate!";
    header("Location: index.php?page=karyawan");
    exit();
}

// Fungsi Delete Karyawan
if (isset($_GET['delete_karyawan'])) {
    $id = (int)$_GET['delete_karyawan'];
    mysqli_query($conn, "DELETE FROM karyawan WHERE id = $id");
    $_SESSION['pesan'] = "Data karyawan berhasil dihapus!";
    header("Location: index.php?page=karyawan");
    exit();
}

// Ambil data karyawan
$karyawan = mysqli_query($conn, "SELECT id, nip, nama, umur, jenis_kelamin, departemen, jabatan, kota_asal FROM karyawan");
$daftar_karyawan = mysqli_fetch_all($karyawan, MYSQLI_ASSOC);
?>