<?php
session_start();
include_once 'koneksi.php';

// Hanya untuk user (karyawan)
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
$pesan = '';

// Ambil ID user dari tabel users
$query_user = $conn->prepare("SELECT id FROM users WHERE username = ?");
$query_user->bind_param("s", $username);
$query_user->execute();
$result = $query_user->get_result();
$user = $result->fetch_assoc();
$user_id = $user['id'] ?? null;

// Jika data dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user_id) {
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $tempat_lahir = $_POST['tempat_lahir'] ?? ''; 
    $tanggal_lahir = $_POST['tanggal_lahir'] ?? '';
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? ''; 
    $pendidikan = $_POST['pendidikan'] ?? '';
    $nip = $_POST['nip'] ?? '';
    $jabatan = $_POST['jabatan'] ?? '';
    $no_hp = $_POST['no_hp'] ?? '';

    // Cek apakah user sudah pernah isi biodata
    $cek = $conn->prepare("SELECT * FROM karyawan WHERE user_id = ?");
    $cek->bind_param("i", $user_id);
    $cek->execute();
    $cek_result = $cek->get_result();

    if ($cek_result->num_rows > 0) {
        $pesan = "Biodata Anda sudah pernah diisi.";
    } else {
        // Insert ke tabel karyawan
        $stmt = $conn->prepare("INSERT INTO karyawan (user_id, nip, nama, jabatan, alamat, no_hp, tanggal_lahir, tempat_lahir, jenis_kelamin, pendidikan, email) VALUES (?, ?, ?, ?, ?, ?, ?, ? ,?, ?, ?)");
        $stmt->bind_param("issssssssss", $user_id, $nip, $nama, $jabatan, $alamat, $no_hp, $tanggal_lahir, $tempat_lahir, $jenis_kelamin, $pendidikan, $email);

        if ($stmt->execute()) {
            $pesan = "Biodata berhasil disimpan.";
        } else {
            $pesan = "Terjadi kesalahan saat menyimpan biodata.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Biodata</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen flex flex-col">

  <header class="bg-orange-500 text-white p-4 shadow-md flex justify-between items-center">
    <h1 class="text-xl font-bold">Karyawanku - Biodata</h1>
    <div>
      <span class="mr-4">Halo, <strong><?= htmlspecialchars($username) ?></strong></span>
      <a href="logout.php" class="bg-yellow-400 px-4 py-1 rounded-full text-black font-semibold hover:bg-yellow-300">Logout</a>
    </div>
  </header>

  <main class="p-6 flex-1 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-orange-600 mb-6">Isi Biodata Pribadi</h2>

    <?php if ($pesan): ?>
      <div class="mb-4 p-4 bg-yellow-100 border border-yellow-400 text-yellow-800 rounded">
        <?= htmlspecialchars($pesan) ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-6 rounded-xl shadow-md">
      <div>
        <label class="block text-sm font-semibold">NIP</label>
        <input type="text" name="nip" required class="w-full mt-1 p-2 border rounded-md">
      </div>
      <div>
        <label class="block text-sm font-semibold">Nama Lengkap</label>
        <input type="text" name="nama" required class="w-full mt-1 p-2 border rounded-md">
      </div>
      <div>
        <label class="block text-sm font-semibold">Jabatan</label>
        <input type="text" name="jabatan" required class="w-full mt-1 p-2 border rounded-md">
      </div>
      <div>
        <label class="block text-sm font-semibold">No HP</label>
        <input type="text" name="no_hp" required class="w-full mt-1 p-2 border rounded-md">
      </div>
      <div class="md:col-span-2">
        <label class="block text-sm font-semibold">Alamat</label>
        <textarea name="alamat" required class="w-full mt-1 p-2 border rounded-md"></textarea>
      </div>
      <div>
        <label class="block text-sm font-semibold">Pendidikan Terakhir</label>
        <input type="text" name="pendidikan" required class="w-full mt-1 p-2 border rounded-md">
      </div>
      <div>
        <label class="block text-sm font-semibold">EMail</label>
        <input type="text" name="email" required class="w-full mt-1 p-2 border rounded-md">
      </div>
      <div>
        <label class="block text-sm font-semibold">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" required class="w-full mt-1 p-2 border rounded-md">
      </div>
      <div>
        <label class="block text-sm font-semibold">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" required class="w-full mt-1 p-2 border rounded-md">
      </div>
      <div class="md:col-span-2">
        <label for="jenis_kelamin" class="block text-sm font-semibold">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" required class="w-full mt-1 p-2 border rounded-md focus:ring-orange-500 focus:border-orange-500">
          <option value="">Pilih Jenis Kelamin</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>
      <div class="md:col-span-2 pt-2">
        <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 font-semibold">Simpan</button>
        <a href="dashboard_karyawan.php" class="ml-4 text-sm text-gray-500 hover:underline">Kembali ke Dashboard</a>
      </div>
    </form>
  </main>

  <footer class="text-center text-gray-500 text-sm p-4 mt-auto">
    &copy; <?= date('Y') ?> Karyawanku. Karyawan Panel.
  </footer>

</body>
</html>
