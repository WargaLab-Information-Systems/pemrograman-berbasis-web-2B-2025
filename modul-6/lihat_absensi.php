<?php
session_start();
include_once 'koneksi.php'; // Pastikan koneksi.php $conn sudah benar

// Cek autentikasi admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username']);

// Ambil data absensi dengan join ke tabel karyawan untuk nama dan nip
// Perbaikan: JOIN karyawan k ON a.karyawan_id = k.id
$sql = "
    SELECT a.id, a.tanggal, a.status, k.nama, k.nip 
    FROM absensi a
    JOIN karyawan k ON a.karyawan_id = k.id 
    ORDER BY a.tanggal DESC, k.nama ASC
";
$query = mysqli_query($conn, $sql);

// Periksa jika query gagal
if (!$query) {
    // Untuk debugging, Anda bisa menampilkan error SQL
    // die("Error pada query: " . mysqli_error($conn)); 
    // Sebaiknya log error ini atau tampilkan pesan yang lebih ramah pengguna
    $errorMessage = "Terjadi kesalahan saat mengambil data absensi.";
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Data Absensi Karyawan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen flex flex-col">

  <header class="bg-orange-500 text-white p-4 shadow-md flex justify-between items-center">
    <div class="flex items-center space-x-3">
      <div class="bg-yellow-500 rounded-full p-2">
        <img src="Asset/logo1.png" alt="Logo Karyawanku" class="w-8 h-8" /> 
      </div>
      <span class="text-lg font-semibold">Karyawanku</span>
    </div>
    <div>
      <span class="mr-4">Halo, <strong><?= $username ?></strong> (Admin)</span>
      <a href="dashboard_admin.php" class="bg-yellow-400 px-4 py-1 rounded-full text-black font-semibold hover:bg-yellow-300 transition mr-2">Dashboard</a>
      <a href="logout.php" class="bg-yellow-400 px-4 py-1 rounded-full text-black font-semibold hover:bg-yellow-300 transition">Logout</a>
    </div>
  </header>

  <main class="p-6 flex-1 max-w-7xl mx-auto w-full">
    <h2 class="text-2xl font-bold text-orange-600 mb-6">Data Absensi Karyawan</h2>

    <?php if (isset($errorMessage)): ?>
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <?= htmlspecialchars($errorMessage) ?>
        </div>
    <?php endif; ?>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md p-4">
      <table class="min-w-full border border-gray-300 text-sm text-left">
        <thead class="bg-orange-100 text-gray-700 uppercase text-xs tracking-wider">
          <tr>
            <th class="py-3 px-4 border-b border-gray-300">No</th>
            <th class="py-3 px-4 border-b border-gray-300">Nama</th>
            <th class="py-3 px-4 border-b border-gray-300">NIP</th>
            <th class="py-3 px-4 border-b border-gray-300">Tanggal</th>
            <th class="py-3 px-4 border-b border-gray-300">Status</th>
            <th class="py-3 px-4 border-b border-gray-300 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="text-gray-700">
          <?php
          if ($query && mysqli_num_rows($query) > 0) {
            $no = 1;
            while ($row = mysqli_fetch_assoc($query)) :
              // Status dari database akan lowercase ('hadir', 'sakit', 'izin', 'alfa')
              $statusDb = htmlspecialchars($row['status']); 
              
              // Tentukan warna badge status berdasarkan nilai dari database
              $badgeColor = match($statusDb) {
                  'hadir' => 'bg-green-100 text-green-700',
                  'sakit' => 'bg-yellow-100 text-yellow-700',
                  'izin'  => 'bg-orange-100 text-orange-700',
                  'alfa'  => 'bg-red-100 text-red-700',
                  default => 'bg-gray-100 text-gray-700',
              };
          ?>
            <tr class="hover:bg-yellow-50 transition-colors duration-150">
              <td class="py-2 px-4 border-b border-gray-200"><?= $no++ ?></td>
              <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($row['nama']) ?></td>
              <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($row['nip']) ?></td>
              <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars(date('d M Y', strtotime($row['tanggal']))) // Format tanggal ?></td>
              <td class="py-2 px-4 border-b border-gray-200">
                <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $badgeColor ?>">
                  <?= ucfirst($statusDb) // Tampilkan dengan huruf kapital di awal ?>
                </span>
              </td>
              <td class="py-2 px-4 border-b border-gray-200 text-center">
                <a href="edit_absensi.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:text-blue-800 hover:underline mr-3 font-medium">Edit</a>
                </td>
            </tr>
          <?php
            endwhile;
          } else if (isset($errorMessage)) {
            // Pesan error sudah ditampilkan di atas tabel
             echo '<tr><td colspan="6" class="text-center py-4 text-gray-500">Tidak dapat memuat data.</td></tr>';
          }
           else {
            echo '<tr><td colspan="6" class="text-center py-4 text-gray-500">Data absensi tidak ditemukan.</td></tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </main>

  <footer class="text-center text-gray-500 text-sm p-4 mt-auto">
    &copy; <?= date('Y') ?> Karyawanku. Admin Dashboard.
  </footer>

</body>
</html>