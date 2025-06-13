<?php
session_start();
include_once 'koneksi.php'; // Pastikan koneksi.php $conn sudah benar

// Cek apakah user sudah login dan berperan sebagai admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
$error = '';
$pesan_sukses = '';

// Ambil id absensi dari parameter GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: lihat_absensi.php?pesan=id_tidak_valid');
    exit;
}
$id_absensi = intval($_GET['id']);

// Proses update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status_input = $_POST['status'] ?? ''; // Ini akan berupa 'Hadir', 'Sakit', 'Izin', 'Alfa'

    // Validasi status (input dari form adalah uppercase)
    $allowed_status_display = ['Hadir', 'Sakit', 'Izin', 'Alfa'];
    if (!in_array($status_input, $allowed_status_display)) {
        $error = "Status tidak valid.";
    } else {
        // Konversi status ke lowercase untuk database
        $status_db = strtolower($status_input); 

        $stmt_update = $conn->prepare("UPDATE absensi SET status = ? WHERE id = ?");
        if ($stmt_update) {
            $stmt_update->bind_param("si", $status_db, $id_absensi);
            if ($stmt_update->execute()) {
                header('Location: lihat_absensi.php?pesan=update_sukses');
                exit;
            } else {
                $error = "Gagal memperbarui data absensi: " . $stmt_update->error;
            }
            $stmt_update->close();
        } else {
            $error = "Gagal menyiapkan statement update: " . $conn->error;
        }
    }
}

// Ambil data absensi saat ini menggunakan prepared statement
// Perbaikan: JOIN karyawan k ON a.karyawan_id = k.id
$stmt_select = $conn->prepare("
    SELECT a.id, a.tanggal, a.status, a.karyawan_id, k.nama, k.nip 
    FROM absensi a
    JOIN karyawan k ON a.karyawan_id = k.id
    WHERE a.id = ?
");

if ($stmt_select) {
    $stmt_select->bind_param("i", $id_absensi);
    $stmt_select->execute();
    $result = $stmt_select->get_result();

    if ($result->num_rows === 0) {
        header('Location: lihat_absensi.php?pesan=data_tidak_ditemukan');
        exit;
    }
    $data = $result->fetch_assoc();
    $stmt_select->close();
} else {
    // Error saat prepare statement
    // Anda bisa redirect atau menampilkan pesan error
    header('Location: lihat_absensi.php?pesan=error_prepare_select');
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Edit Absensi Karyawan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

  <header class="bg-orange-500 text-white p-4 shadow-md flex justify-between items-center">
    <div class="flex items-center space-x-3">
      <div class="bg-yellow-500 rounded-full p-2">
        <img src="Asset/logo1.png" alt="Logo Karyawanku" class="w-8 h-8" />
      </div>
      <span class="text-lg font-semibold">Karyawanku</span>
    </div>
    <div>
      <span class="mr-4">Halo, <strong><?= $username ?></strong> (Admin)</span>
      <a href="lihat_absensi.php" class="bg-yellow-400 px-4 py-1 rounded-full text-black font-semibold hover:bg-yellow-300 transition mr-2">Kembali</a>
      <a href="logout.php" class="bg-yellow-400 px-4 py-1 rounded-full text-black font-semibold hover:bg-yellow-300 transition">Logout</a>
    </div>
  </header>

  <main class="p-6 flex-1 max-w-lg mx-auto w-full">
    <div class="bg-white p-8 rounded-xl shadow-lg">
      <h2 class="text-2xl font-bold text-orange-600 mb-6 text-center">Edit Absensi Karyawan</h2>

      <?php if (!empty($error)) : ?>
        <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded-md text-sm">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>
       <?php if (isset($_GET['pesan']) && $_GET['pesan'] === 'input_invalid'): ?>
        <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded-md text-sm">
            Terjadi kesalahan input. Silakan coba lagi.
        </div>
      <?php endif; ?>


      <form method="post" action="edit_absensi.php?id=<?= $id_absensi // Pastikan ID dikirim lagi untuk proses POST ?>">
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold mb-1 text-sm">Nama Karyawan</label>
          <input type="text" value="<?= htmlspecialchars($data['nama']) ?>" disabled
                 class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100 cursor-not-allowed text-sm" />
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 font-semibold mb-1 text-sm">NIP</label>
          <input type="text" value="<?= htmlspecialchars($data['nip']) ?>" disabled
                 class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100 cursor-not-allowed text-sm" />
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 font-semibold mb-1 text-sm">Tanggal Absensi</label>
          <input type="text" value="<?= htmlspecialchars(date('d M Y', strtotime($data['tanggal']))) ?>" disabled
                 class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100 cursor-not-allowed text-sm" />
        </div>

        <div class="mb-6">
          <label for="status" class="block text-gray-700 font-semibold mb-1 text-sm">Status</label>
          <select id="status" name="status" required
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500 text-sm">
            <?php
            // Status untuk display dan value di form (Uppercase)
            $statuses_display = ['Hadir', 'Sakit', 'Izin', 'Alfa'];
            // Status dari DB adalah lowercase, ubah ke ucfirst untuk perbandingan
            $current_status_display = ucfirst(htmlspecialchars($data['status'])); 

            foreach ($statuses_display as $s_display) {
                $selected = ($current_status_display === $s_display) ? 'selected' : '';
                echo "<option value=\"$s_display\" $selected>$s_display</option>";
            }
            ?>
          </select>
        </div>

        <button type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2.5 rounded-md transition duration-150">
          Simpan Perubahan
        </button>
      </form>
    </div>
  </main>

  <footer class="text-center text-gray-500 text-sm p-4 mt-8">
    &copy; <?= date('Y') ?> Karyawanku. Admin Dashboard.
  </footer>

</body>
</html>