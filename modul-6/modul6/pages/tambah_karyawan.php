<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isLoggedIn()) {
    header('Location: ../auth/login.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nip' => trim($_POST['nip']),
        'nama' => trim($_POST['nama']),
        'umur' => isset($_POST['umur']) ? trim($_POST['umur']) : '',
        'jenis_kelamin' => $_POST['jenis_kelamin'] ?? '',
        'departemen' => trim($_POST['departemen']),
        'jabatan' => trim($_POST['jabatan']),
        'kota_asal' => trim($_POST['kota_asal']),
        'tanggal_absensi' => $_POST['tanggal_absensi'],
        'jam_masuk' => $_POST['jam_masuk'],
        'jam_pulang' => $_POST['jam_pulang']
    ];

    if ($data['nip'] === '' || $data['nama'] === '' || $data['tanggal_absensi'] === '' || $data['jam_masuk'] === '' || $data['jam_pulang'] === '') {
        $error = 'Kolom NIP, Nama, Tanggal, Jam Masuk, dan Jam Pulang wajib diisi.';
    } else {
        $result = addKaryawan($data);
        if ($result['success']) {

            header('Location: karyawan.php');
            exit();
        } else {

            $error = implode('<br>', $result['errors']);
        }
    }
}

?>

<?php include '../includes/header.php'; ?>

<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Tambah Data Karyawan & Absensi</h2>

    <?php if ($error): ?>
        <div class="bg-red-100 text-red-700 px-4 py-3 mb-4 rounded">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="text-sm space-y-4">
        <input type="text" name="nip" placeholder="NIP" class="form-input" required>
        <input type="text" name="nama" placeholder="Nama" class="form-input" required>
        <input type="number" name="umur" placeholder="Umur" class="form-input">
        
        <select name="jenis_kelamin" class="form-input">
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <input type="text" name="departemen" placeholder="Departemen" class="form-input">
        <input type="text" name="jabatan" placeholder="Jabatan" class="form-input">
        <input type="text" name="kota_asal" placeholder="Kota Asal" class="form-input">
        <input type="date" name="tanggal_absensi" class="form-input" required>
        <input type="time" name="jam_masuk" class="form-input" required>
        <input type="time" name="jam_pulang" class="form-input" required>

        <div class="font-semibold flex justify-between items-center mt-4">
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700 transition">
                Simpan
            </button>
            <a href="karyawan.php" class="text-gray-600 hover:underline">Kembali</a>
        </div>
    </form>
    <script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const nip = document.querySelector('input[name="nip"]').value.trim();
        if (!/^\d+$/.test(nip)) {
            alert('NIP harus berupa angka saja.');
            e.preventDefault();
            return false;
        }
    });
</script>

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
