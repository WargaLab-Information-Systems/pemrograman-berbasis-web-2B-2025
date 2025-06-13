<?php
session_start();
include("koneksi.php");
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip         = $_POST['nip'];
    $nama        = $_POST['nama'];
    $umur        = $_POST['umur'];
    $jk          = $_POST['jenis_kelamin'];
    $departemen  = $_POST['departemen'];
    $jabatan     = $_POST['jabatan'];
    $kota        = $_POST['kota_asal'];
    $tanggal     = $_POST['tanggal_absensi'];
    $masuk       = $_POST['jam_masuk'];
    $pulang      = $_POST['jam_pulang'];

    $sql = "INSERT INTO karyawan_absensi (nip, nama, umur, jenis_kelamin, departemen, jabatan, kota_asal, tanggal_absensi, jam_masuk, jam_pulang)
            VALUES ('$nip','$nama','$umur','$jk','$departemen','$jabatan','$kota','$tanggal','$masuk','$pulang')";

    if (mysqli_query($conn, $sql)) {
        $message = "✅ Data berhasil disimpan.";
    } else {
        $message = "❌ Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Data Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">Input Data Karyawan & Absensi</h2>

        <?php if ($message): ?>
            <div class="mb-4 p-4 rounded text-white <?= strpos($message, 'berhasil') !== false ? 'bg-green-500' : 'bg-red-500' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <form method="post" class="space-y-4">
            <input type="text" name="nip" placeholder="NIP" required class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="text" name="nama" placeholder="Nama" required class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="number" name="umur" placeholder="Umur" required class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">

            <select name="jenis_kelamin" required class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <input type="text" name="departemen" placeholder="Departemen" required class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="text" name="jabatan" placeholder="Jabatan" required class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="text" name="kota_asal" placeholder="Kota Asal" required class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="date" name="tanggal_absensi" required class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="time" name="jam_masuk" required class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="time" name="jam_pulang" required class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">

            <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded hover:bg-blue-700 transition duration-300">Simpan</button>
        </form>

        <a href="dashboard.php" class="block text-center mt-6 text-blue-600 hover:underline">Kembali ke Dashboard</a>
    </div>
</body>
</html>
