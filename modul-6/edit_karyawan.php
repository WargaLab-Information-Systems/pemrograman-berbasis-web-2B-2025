<?php
session_start();
include_once 'koneksi.php'; 

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); 
    exit;
}

$pesan_sukses = '';
$pesan_error = '';
$id_karyawan = $_GET['id'] ?? null;
$data = null;

if (!$id_karyawan || !is_numeric($id_karyawan)) {
    header('Location: dashboard_admin.php'); 
    exit;
}
$id_karyawan = intval($id_karyawan);

$stmt_select = $conn->prepare("SELECT * FROM karyawan WHERE id = ?");
if ($stmt_select) {
    $stmt_select->bind_param("i", $id_karyawan);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    if ($result->num_rows === 0) {
        $pesan_error = "Data karyawan tidak ditemukan.";
    } else {
        $data = $result->fetch_assoc();
    }
    $stmt_select->close();
} else {
    $pesan_error = "Gagal menyiapkan query untuk mengambil data: " . $conn->error;
}


// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $data) { // Pastikan $data ada sebelum proses update
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $nip = $_POST['nip'] ?? '';
    $jabatan = $_POST['jabatan'] ?? '';
    $tempat_lahir = $_POST['tempat_lahir'] ?? ''; 
    $tanggal_lahir = $_POST['tanggal_lahir'] ?? '';
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? ''; 
    $pendidikan = $_POST['pendidikan'] ?? '';
    $no_hp = $_POST['no_hp'] ?? '';

    // Validasi dasar (bisa ditambahkan validasi yang lebih kompleks)
    if (empty($nama) || empty($email) || empty($jenis_kelamin)) {
        $pesan_error = "Nama, Email, dan Jenis Kelamin wajib diisi.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesan_error = "Format email tidak valid.";
    } else {
        $stmt_update = $conn->prepare("UPDATE karyawan SET
            nama = ?,
            email = ?,
            alamat = ?,
            nip = ?,
            jabatan = ?,
            tempat_lahir = ?,
            tanggal_lahir = ?,
            jenis_kelamin = ?,
            pendidikan = ?,
            no_hp = ?
            WHERE id = ?");

        if ($stmt_update) {
            $stmt_update->bind_param(
                "ssssssssssi", 
                $nama,
                $email,
                $alamat,
                $nip,
                $jabatan,
                $tempat_lahir,
                $tanggal_lahir,
                $jenis_kelamin,
                $pendidikan,
                $no_hp,
                $id_karyawan
            );

            if ($stmt_update->execute()) {
                $pesan_sukses = "Data karyawan berhasil diperbarui.";
                // Refresh data setelah update
                $stmt_refresh = $conn->prepare("SELECT * FROM karyawan WHERE id = ?");
                if ($stmt_refresh) {
                    $stmt_refresh->bind_param("i", $id_karyawan);
                    $stmt_refresh->execute();
                    $result_refresh = $stmt_refresh->get_result();
                    $data = $result_refresh->fetch_assoc(); // Update $data dengan nilai baru
                    $stmt_refresh->close();
                }
            } else {
                // Cek jika error karena email duplikat
                if ($conn->errno == 1062) { // Error code untuk duplicate entry
                    $pesan_error = "Gagal memperbarui data: Email sudah digunakan oleh karyawan lain.";
                } else {
                    $pesan_error = "Gagal memperbarui data karyawan: " . $stmt_update->error;
                }
            }
            $stmt_update->close();
        } else {
            $pesan_error = "Gagal menyiapkan statement update: " . $conn->error;
        }
    }
}

$username_admin = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Edit Data Karyawan - Karyawanku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .alert-success {
            background-color: #d1fae5; 
            border-color: #6ee7b7; 
            color: #065f46; 
        }
        .alert-error {
            background-color: #fee2e2; 
            border-color: #fca5a5; 
            color: #991b1b; 
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

<header class="bg-orange-500 text-white p-4 shadow-md flex justify-between items-center sticky top-0 z-50">
    <h1 class="text-xl font-bold">Edit Data Karyawan - Karyawanku</h1>
    <div>
        <span class="mr-4">Halo, <strong><?= $username_admin ?></strong> (Admin)</span>
        <a href="dashboard_admin.php" class="bg-yellow-400 px-3 py-1 rounded-md text-black font-semibold hover:bg-yellow-300 text-sm mr-2">Dashboard</a>
        <a href="../logout.php" class="bg-red-500 px-3 py-1 rounded-md text-white font-semibold hover:bg-red-600 text-sm">Logout</a>
    </div>
</header>

<main class="p-6 flex-1 max-w-4xl mx-auto w-full">
    <h2 class="text-3xl font-bold text-orange-600 mb-6 text-center">Edit Data Karyawan</h2>

    <?php if ($pesan_sukses): ?>
        <div class="mb-4 p-4 border rounded-md alert-success text-sm">
            <?= htmlspecialchars($pesan_sukses) ?>
        </div>
    <?php endif; ?>
    <?php if ($pesan_error): ?>
        <div class="mb-4 p-4 border rounded-md alert-error text-sm">
            <?= htmlspecialchars($pesan_error) ?>
        </div>
    <?php endif; ?>

    <?php if ($data): ?>
    <form method="POST" action="edit_karyawan.php?id=<?= $id_karyawan ?>" class="bg-white p-8 rounded-xl shadow-lg grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
            <input type="text" id="nama" name="nama" required class="w-full mt-1 p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 text-sm"
                value="<?= htmlspecialchars($data['nama'] ?? '') ?>" />
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
            <input type="email" id="email" name="email" required class="w-full mt-1 p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 text-sm"
                value="<?= htmlspecialchars($data['email'] ?? '') ?>" />
        </div>
        <div class="md:col-span-2">
            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
            <textarea id="alamat" name="alamat" class="w-full mt-1 p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 text-sm" rows="3"><?= htmlspecialchars($data['alamat'] ?? '') ?></textarea>
        </div>
         <div>
            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" class="w-full mt-1 p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 text-sm"
                value="<?= htmlspecialchars($data['tempat_lahir'] ?? '') ?>" />
        </div>
        <div>
            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="w-full mt-1 p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 text-sm"
                value="<?= htmlspecialchars($data['tanggal_lahir'] ?? '') ?>" />
        </div>
        <div>
            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
            <select id="jenis_kelamin" name="jenis_kelamin" required class="w-full mt-1 p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 text-sm">
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki" <?= (isset($data['jenis_kelamin']) && $data['jenis_kelamin'] === 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= (isset($data['jenis_kelamin']) && $data['jenis_kelamin'] === 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>
        <div>
            <label for="pendidikan" class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir</label>
            <input type="text" id="pendidikan" name="pendidikan" class="w-full mt-1 p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 text-sm"
                value="<?= htmlspecialchars($data['pendidikan'] ?? '') ?>" />
        </div>
        <div>
            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">No HP</label>
            <input type="text" id="no_hp" name="no_hp" class="w-full mt-1 p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 text-sm"
                value="<?= htmlspecialchars($data['no_hp'] ?? '') ?>" />
        </div>
        <div>
            <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
            <input type="text" id="nip" name="nip" class="w-full mt-1 p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 text-sm"
                value="<?= htmlspecialchars($data['nip'] ?? '') ?>" />
        </div>
        <div class="md:col-span-2">
            <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
            <textarea id="jabatan" name="jabatan" class="w-full mt-1 p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 text-sm" rows="3"><?= htmlspecialchars($data['jabatan'] ?? '') ?></textarea>
        </div>
        <div class="md:col-span-2 pt-4 flex items-center space-x-4">
            <button type="submit" class="bg-orange-500 text-white px-6 py-2.5 rounded-lg hover:bg-orange-600 font-semibold transition duration-150">Simpan Perubahan</button>
            <a href="dashboard_admin.php" class="text-gray-600 hover:text-gray-800 hover:underline font-medium">Batal & Kembali</a>
        </div>
    </form>
    <?php elseif (!$pesan_error): // Hanya tampilkan jika $data null dan tidak ada pesan error spesifik dari SELECT ?>
        <div class="text-center">
            <p class="text-red-500 text-lg">Gagal memuat data karyawan atau ID tidak valid.</p>
            <a href="dashboard_admin.php" class="mt-4 inline-block text-blue-600 hover:underline">Kembali ke Dashboard</a>
        </div>
    <?php endif; ?>
</main>

<footer class="text-center text-gray-500 text-sm p-4 mt-auto">
    &copy; <?= date('Y') ?> Karyawanku. Admin Dashboard.
</footer>

</body>
</html>