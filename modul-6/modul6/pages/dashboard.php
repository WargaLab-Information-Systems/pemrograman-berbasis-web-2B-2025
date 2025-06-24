<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: ../auth/login.php');
    exit();
}
?>

<?php include '../includes/header.php'; ?>

<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-xl font-bold mb-4">Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p class="text-sm text-gray-600 mb-6">Ini adalah halaman dashboard utama Manajemen Karyawan dan Absensi.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="karyawan.php" class="text-sm font-semibold block bg-purple-500 text-white px-4 py-3 rounded-lg text-center hover:bg-purple-600 transition">
            Kelola Data Karyawan & Absensi
        </a>

        <a href="../auth/logout.php" class="text-sm font-semibold block bg-red-500 text-white px-4 py-3 rounded-lg text-center hover:bg-red-600 transition">
            Logout
        </a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
