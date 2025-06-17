<?php
$host = 'localhost'; 
$db = 'manajemen_karyawan'; 
$user = 'root'; 
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Ambil NIP dari URL
$nip = $_GET['nip'] ?? '';
$result = $conn->query("SELECT * FROM karyawan_absensi WHERE nip = '$nip'");
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip_baru = $_POST['nip'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $departemen = $_POST['departemen'];
    $jabatan = $_POST['jabatan'];
    $kota_asal = $_POST['kota_asal'];
    $tanggal = $_POST['tanggal_absensi'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_pulang = $_POST['jam_pulang'];

    $stmt = $conn->prepare("UPDATE karyawan_absensi SET nip=?, nama=?, umur=?, jenis_kelamin=?, departemen=?, jabatan=?, kota_asal=?, tanggal_absensi=?, jam_masuk=?, jam_pulang=? WHERE nip=?");
    $stmt->bind_param("sssssssssss", $nip_baru, $nama, $umur, $jenis_kelamin, $departemen, $jabatan, $kota_asal, $tanggal, $jam_masuk, $jam_pulang, $nip);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4">Edit Data Karyawan</h2>
        <form method="post" class="space-y-4">
            <div>
                <label class="block font-semibold">NIP</label>
                <input type="text" name="nip" value="<?= htmlspecialchars($data['nip']) ?>" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block font-semibold">Nama</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block font-semibold">Umur</label>
                <input type="number" name="umur" value="<?= $data['umur'] ?>" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block font-semibold">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full p-2 border rounded">
                    <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold">Departemen</label>
                <input type="text" name="departemen" value="<?= htmlspecialchars($data['departemen']) ?>" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block font-semibold">Jabatan</label>
                <input type="text" name="jabatan" value="<?= htmlspecialchars($data['jabatan']) ?>" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block font-semibold">Kota Asal</label>
                <input type="text" name="kota_asal" value="<?= htmlspecialchars($data['kota_asal']) ?>" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block font-semibold">Tanggal Absensi</label>
                <input type="date" name="tanggal_absensi" value="<?= $data['tanggal_absensi'] ?>" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block font-semibold">Jam Masuk</label>
                <input type="time" name="jam_masuk" value="<?= $data['jam_masuk'] ?>" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block font-semibold">Jam Pulang</label>
                <input type="time" name="jam_pulang" value="<?= $data['jam_pulang'] ?>" class="w-full p-2 border rounded" required>
            </div>
            <div class="flex justify-between mt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="index.php" class="text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
