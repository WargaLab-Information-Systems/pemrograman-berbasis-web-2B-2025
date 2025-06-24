<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: ../auth/login.php');
    exit();
}

if (!isset($_GET['nip'])) {
    header('Location: karyawan.php');
    exit();
}

$nip = $_GET['nip'];

global $pdo;

$stmt = $pdo->prepare("DELETE FROM karyawan_absensi WHERE nip = ?");
$success = $stmt->execute([$nip]);

if ($success) {
    header('Location: karyawan.php');
    exit();
} else {
    echo "Gagal menghapus data dengan NIP = $nip";
}
