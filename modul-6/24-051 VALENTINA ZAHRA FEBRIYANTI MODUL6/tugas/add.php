<?php
session_start();
include "koneksi1.php";

// Cek session login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $nip = htmlspecialchars($_POST['nip']);
    $nama = htmlspecialchars($_POST['nama']);
    $umur = (int)$_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $departemen = htmlspecialchars($_POST['departemen']);
    $jabatan = htmlspecialchars($_POST['jabatan']);
    $kota_asal = htmlspecialchars($_POST['kota_asal']);
    $tanggal_absensi = $_POST['tanggal_absensi'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_pulang = $_POST['jam_pulang'];

    // Insert data ke tabel karyawan_absensi
    $sql = "INSERT INTO karyawan_absensi (nip, nama, umur, jenis_kelamin, departemen, jabatan, kota_asal, tanggal_absensi, jam_masuk, jam_pulang) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssssss", $nip, $nama, $umur, $jenis_kelamin, $departemen, $jabatan, $kota_asal, $tanggal_absensi, $jam_masuk, $jam_pulang);
#eksekusi
    if ($stmt->execute()) {
        $success = "Data karyawan & absensi berhasil ditambahkan.";
    } else {
        $error = "Gagal menambahkan data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Tambah Data Karyawan & Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-pink-700">Tambah Data Karyawan & Absensi</h1>
        <a href="dashboard.php" class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600">← Kembali ke Dashboard</a>
    </div>

    <?php if (isset($success)): ?>
        <div class="bg-pink-200 text-pink-800 p-3 mb-4 rounded"><?= $success ?></div>
    <?php elseif (isset($error)): ?>
        <div class="bg-pink-200 text-pink-800 p-3 mb-4 rounded"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-6 rounded shadow-md max-w-lg">
        <label class="block mb-2 text-pink-700 font-semibold">NIP:</label>
        <input type="text" name="nip" required class="w-full p-2 border border-pink-300 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-pink-400" />

        <label class="block mb-2 text-pink-700 font-semibold">Nama:</label>
        <input type="text" name="nama" required class="w-full p-2 border border-pink-300 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-pink-400" />

        <label class="block mb-2 text-pink-700 font-semibold">Umur:</label>
        <input type="number" name="umur" required class="w-full p-2 border border-pink-300 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-pink-400" />

        <label class="block mb-2 text-pink-700 font-semibold">Jenis Kelamin:</label>
        <select name="jenis_kelamin" required class="w-full p-2 border border-pink-300 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-pink-400">
            <option value="">-- Pilih --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <label class="block mb-2 text-pink-700 font-semibold">Departemen:</label>
        <input type="text" name="departemen" required class="w-full p-2 border border-pink-300 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-pink-400" />

        <label class="block mb-2 text-pink-700 font-semibold">Jabatan:</label>
        <input type="text" name="jabatan" required class="w-full p-2 border border-pink-300 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-pink-400" />

        <label class="block mb-2 text-pink-700 font-semibold">Kota Asal:</label>
        <input type="text" name="kota_asal" required class="w-full p-2 border border-pink-300 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-pink-400" />

        <label class="block mb-2 text-pink-700 font-semibold">Tanggal Absensi:</label>
        <input type="date" name="tanggal_absensi" required class="w-full p-2 border border-pink-300 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-pink-400" />

        <label class="block mb-2 text-pink-700 font-semibold">Jam Masuk:</label>
        <input type="time" name="jam_masuk" required class="w-full p-2 border border-pink-300 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-pink-400" />

        <label class="block mb-2 text-pink-700 font-semibold">Jam Pulang:</label>
        <input type="time" name="jam_pulang" required class="w-full p-2 border border-pink-300 rounded mb-6 focus:outline-none focus:ring-2 focus:ring-pink-400" />

        <button type="submit" name="submit" class="w-full bg-pink-600 text-white p-3 rounded hover:bg-pink-700 transition">Kirim</button>
    </form>

    <div class="mt-6">
        <a href="dashboard.php" class="text-pink-600 hover:underline">← Kembali ke Dashboard</a>
    </div>
</body>
</html>
