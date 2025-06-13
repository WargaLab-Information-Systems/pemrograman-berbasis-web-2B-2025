<?php
session_start();
include_once 'koneksi.php'; // Pastikan koneksi.php $conn sudah benar

// Cek autentikasi dan peran user
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$username = $_SESSION['username'];
$pesan = '';
$tanggal = date('Y-m-d');
$karyawanId = null;

// Ambil karyawan_id berdasarkan user_id yang login
$stmtKaryawan = $conn->prepare("SELECT id FROM karyawan WHERE user_id = ?");
if ($stmtKaryawan) {
    $stmtKaryawan->bind_param("i", $userId);
    $stmtKaryawan->execute();
    $resultKaryawan = $stmtKaryawan->get_result();
    if ($resultKaryawan->num_rows > 0) {
        $karyawan = $resultKaryawan->fetch_assoc();
        $karyawanId = $karyawan['id'];
    } else {
        // Handle jika user yang login tidak memiliki data di tabel karyawan
        // Ini sebaiknya tidak terjadi jika alur pendaftaran sudah benar
        $pesan = "Data karyawan tidak ditemukan untuk user ini.";
        // Mungkin redirect atau tampilkan error fatal
    }
    $stmtKaryawan->close();
} else {
    // Error saat prepare statement untuk mengambil karyawan_id
    $pesan = "Terjadi kesalahan dalam mengambil data karyawan: " . $conn->error;
}


// Proses absensi hanya jika karyawanId berhasil didapatkan
if ($karyawanId !== null && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kehadiran'])) {
    $kehadiranInput = $_POST['kehadiran']; // Misal: 'Hadir', 'Sakit', 'Izin'
    $statusAbsensi = strtolower($kehadiranInput); // Ubah ke lowercase: 'hadir', 'sakit', 'izin'

    // Validasi status kehadiran yang diizinkan (sesuai ENUM database, tanpa 'alfa' untuk input user)
    $allowed_status = ['hadir', 'sakit', 'izin'];
    if (!in_array($statusAbsensi, $allowed_status)) {
        $pesan = "Status absensi tidak valid.";
    } else {
        // Cek apakah user sudah absen hari ini
        $cek = $conn->prepare("SELECT id FROM absensi WHERE karyawan_id = ? AND tanggal = ?");
        if ($cek) {
            $cek->bind_param("is", $karyawanId, $tanggal);
            $cek->execute();
            $cekResult = $cek->get_result();

            if ($cekResult->num_rows === 0) {
                $insert = $conn->prepare("INSERT INTO absensi (karyawan_id, tanggal, status) VALUES (?, ?, ?)");
                if ($insert) {
                    $insert->bind_param("iss", $karyawanId, $tanggal, $statusAbsensi);
                    $insert->execute();

                    if ($insert->affected_rows > 0) {
                        $pesan = "Absensi berhasil dicatat.";
                    } else {
                        $pesan = "Gagal mencatat absensi: " . $insert->error;
                    }
                    $insert->close();
                } else {
                    $pesan = "Gagal menyiapkan statement insert: " . $conn->error;
                }
            } else {
                $pesan = "Anda sudah absen hari ini.";
            }
            $cek->close();
        } else {
             $pesan = "Gagal menyiapkan statement cek absensi: " . $conn->error;
        }
    }
}

// Ambil data absensi user (terbaru ke terlama)
$absensiResult = null; // Inisialisasi untuk menampung hasil query
if ($karyawanId !== null) {
    $query = $conn->prepare("SELECT tanggal, status FROM absensi WHERE karyawan_id = ? ORDER BY tanggal DESC");
    if ($query) {
        $query->bind_param("i", $karyawanId);
        $query->execute();
        $absensiResult = $query->get_result();
        // $query->close(); // Jangan ditutup di sini jika $absensiResult akan digunakan di loop bawah
    } else {
        $pesan = (empty($pesan) ? "" : $pesan . "<br>") . "Gagal menyiapkan statement ambil riwayat: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Absensi Karyawan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen flex flex-col">

  <header class="bg-orange-500 text-white p-4 shadow-md flex justify-between items-center">
    <h1 class="text-xl font-bold">Karyawanku</h1>
    <div>
      <span class="mr-4">Halo, <strong><?= htmlspecialchars($username) ?></strong></span>
      <a href="logout.php" class="bg-yellow-400 px-4 py-1 rounded-full text-black font-semibold hover:bg-yellow-300 transition">Logout</a>
    </div>
  </header>

  <main class="p-6 flex-1 max-w-5xl mx-auto w-full">

    <section class="mb-10 bg-orange-50 p-6 rounded-2xl shadow-lg">
      <h2 class="text-2xl font-bold text-orange-600 mb-4">Absensi Hari Ini</h2>

      <?php if ($pesan): ?>
        <div class="mb-4 p-4 <?= (strpos(strtolower($pesan), 'berhasil') !== false) ? 'bg-green-100 border-green-400 text-green-800' : 'bg-yellow-100 border-yellow-400 text-yellow-800' ?> rounded">
          <?= htmlspecialchars($pesan) ?>
        </div>
      <?php endif; ?>

      <?php if ($karyawanId !== null): // Tampilkan form hanya jika karyawanId valid ?>
      <form method="POST" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <button type="submit" name="kehadiran" value="Hadir"
          class="flex items-center justify-center bg-green-500 text-white px-6 py-3 rounded-xl font-semibold shadow hover:bg-green-600 transition">
          ✅ Hadir
        </button>
        <button type="submit" name="kehadiran" value="Sakit"
          class="flex items-center justify-center bg-yellow-400 text-white px-6 py-3 rounded-xl font-semibold shadow hover:bg-yellow-500 transition">
          🤒 Sakit
        </button>
        <button type="submit" name="kehadiran" value="Izin"
          class="flex items-center justify-center bg-orange-400 text-white px-6 py-3 rounded-xl font-semibold shadow hover:bg-orange-500 transition">
          📝 Izin
        </button>
      </form>
      <?php else: ?>
        <p class="text-red-500">Tidak dapat melakukan absensi karena data karyawan tidak ditemukan atau ada kesalahan sistem.</p>
      <?php endif; ?>
    </section>

    <section class="bg-white p-6 rounded-2xl shadow-lg">
      <h2 class="text-2xl font-bold text-orange-600 mb-4">Riwayat Absensi</h2>
      <div class="overflow-x-auto rounded-xl border border-orange-200">
        <table class="min-w-full text-sm text-left">
          <thead class="bg-orange-100 text-orange-700 uppercase text-xs tracking-wider">
            <tr>
              <th class="p-3 border-b border-orange-200">Tanggal</th>
              <th class="p-3 border-b border-orange-200">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-orange-100">
            <?php if ($absensiResult && $absensiResult->num_rows > 0): ?>
              <?php while ($row = $absensiResult->fetch_assoc()): ?>
                <tr class="hover:bg-orange-50 transition">
                  <td class="p-3"><?= htmlspecialchars(date('d M Y', strtotime($row['tanggal']))) // Format tanggal lebih baik ?></td>
                  <td class="p-3">
                    <?php
                      $statusDb = htmlspecialchars($row['status']); // status dari DB: 'hadir', 'sakit', 'izin'
                      $badgeColor = match($statusDb) {
                          'hadir' => 'bg-green-100 text-green-700',
                          'sakit' => 'bg-yellow-100 text-yellow-700',
                          'izin'  => 'bg-orange-100 text-orange-700',
                          'alfa'  => 'bg-red-100 text-red-700', // Tambahkan jika ingin menampilkan alfa
                          default => 'bg-gray-100 text-gray-700',
                      };
                    ?>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $badgeColor ?>">
                      <?= ucfirst($statusDb) // Tampilkan dengan huruf kapital di awal ?>
                    </span>
                  </td>
                </tr>
              <?php endwhile; ?>
              <?php if (isset($query)) $query->close(); // Tutup statement setelah loop selesai ?>
            <?php else: ?>
              <tr>
                <td colspan="2" class="p-3 text-center text-gray-500">
                    <?php if ($karyawanId === null && empty($pesan)) echo "Data karyawan tidak ditemukan untuk menampilkan riwayat."; else echo "Belum ada data absensi.";?>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <footer class="text-center text-gray-500 text-sm p-4 mt-auto">
    &copy; <?= date('Y') ?> Karyawanku. Semua Hak Dilindungi.
  </footer>

</body>
</html>