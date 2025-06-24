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

$stmt = $pdo->prepare("SELECT * FROM karyawan_absensi WHERE nip = ?");
$stmt->execute([$nip]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $departemen = $_POST['departemen'];
    $jabatan = $_POST['jabatan'];
    $kota_asal = $_POST['kota_asal'];
    $tanggal = $_POST['tanggal_absensi'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_pulang = $_POST['jam_pulang'];

    $stmt = $pdo->prepare("UPDATE karyawan_absensi SET 
        nama = ?, umur = ?, jenis_kelamin = ?, departemen = ?, jabatan = ?, kota_asal = ?, tanggal_absensi = ?, jam_masuk = ?, jam_pulang = ?
        WHERE nip = ?");
    $stmt->execute([$nama, $umur, $jenis_kelamin, $departemen, $jabatan, $kota_asal, $tanggal, $jam_masuk, $jam_pulang, $nip]);

    header("Location: karyawan.php");
    exit();
}
?>

<?php include '../includes/header.php'; ?>

<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Edit Data Karyawan</h2>

    <form method="POST" class="text-sm space-y-4">
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" placeholder="Nama" class="form-input" required>
        <input type="number" name="umur" value="<?= $data['umur'] ?>" placeholder="Umur" class="form-input">
        <select name="jenis_kelamin" class="form-input">
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-laki" <?= $data['jenis_kelamin'] === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
            <option value="Perempuan" <?= $data['jenis_kelamin'] === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
        </select>
        <input type="text" name="departemen" value="<?= htmlspecialchars($data['departemen']) ?>" placeholder="Departemen" class="form-input">
        <input type="text" name="jabatan" value="<?= htmlspecialchars($data['jabatan']) ?>" placeholder="Jabatan" class="form-input">
        <input type="text" name="kota_asal" value="<?= htmlspecialchars($data['kota_asal']) ?>" placeholder="Kota Asal" class="form-input">
        <input type="date" name="tanggal_absensi" value="<?= $data['tanggal_absensi'] ?>" class="form-input" required>
        <input type="time" name="jam_masuk" value="<?= $data['jam_masuk'] ?>" class="form-input" required>
        <input type="time" name="jam_pulang" value="<?= $data['jam_pulang'] ?>" class="form-input" required>

        <div class="font-semibold flex justify-between items-center mt-4">
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700 transition">Simpan Perubahan</button>
            <a href="karyawan.php" class="text-gray-600 hover:text-gray-400 transition">Kembali</a>
        </div>
    </form>
</div>

<style>
    .form-input {
        width: 100%;
        padding: 0.5rem;
        border-radius: 0.5rem;
        border: 1px solid #ccc;
        outline: none;
    }
    .form-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3);
    }
</style>

<?php include '../includes/footer.php'; ?>
