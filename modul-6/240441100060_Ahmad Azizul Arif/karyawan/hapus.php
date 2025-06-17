<?php
session_start();

$host = 'localhost'; 
$db = 'manajemen_karyawan'; 
$user = 'root'; 
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$nip = $_GET['nip'] ?? '';

if ($nip) {
    $stmt = $conn->prepare("DELETE FROM karyawan_absensi WHERE nip = ?");
    $stmt->bind_param("s", $nip);

    if ($stmt->execute()) {
        $_SESSION['pesan'] = "Data dengan NIP $nip berhasil dihapus.";
    } else {
        $_SESSION['pesan'] = "Gagal menghapus data.";
    }

    $stmt->close();
} else {
    $_SESSION['pesan'] = "NIP tidak valid.";
}

$conn->close();

header("Location: index.php");
exit;
