<?php
session_start();

// Inisialisasi variabel Data Diri
$nama = $_SESSION['nama'] ?? '';
$nim = $_SESSION['nim'] ?? '';
$ttl = $_SESSION['ttl'] ?? '';
$email = $_SESSION['email'] ?? '';
$hp = $_SESSION['hp'] ?? '';

// Inisialisasi variabel Keahlian
$bahasa = [];
$pengalaman = '';
$software = [];
$os = '';
$tingkat = '';
$pesan_error = '';
$hasil_input = '';

// Fungsi cetak array
function cetak_array($array) {
  return implode(', ', array_filter($array));
}

// Proses Form Data Diri
if (isset($_POST['submit'])) {
  // Ambil Data Diri
  $nama = trim($_POST['nama']);
  $nim = trim($_POST['nim']);
  $ttl = trim($_POST['ttl']);
  $email = trim($_POST['email']);
  $hp = trim($_POST['hp']);

  // Ambil Keahlian
  $bahasa_input = trim($_POST['bahasa'] ?? '');
  $bahasa = array_filter(array_map('trim', explode(',', $bahasa_input)));

  $pengalaman = trim($_POST['pengalaman'] ?? '');
  $software = $_POST['software'] ?? [];
  $os = $_POST['os'] ?? '';
  $tingkat = $_POST['tingkat'] ?? '';

  // Validasi
  if ($nama === '' || $nim === '' || $ttl === '' || $email === '' || $hp === '' ||
      empty($bahasa) || $pengalaman === '' || empty($software) || $os === '' || $tingkat === '') {
    $pesan_error = "Semua field wajib diisi!";
  } else {
    // Simpan ke session
    $_SESSION['hasil'] = [
      'nama' => $nama,
      'nim' => $nim,
      'ttl' => $ttl,
      'email' => $email,
      'hp' => $hp,
      'bahasa' => $bahasa,
      'pengalaman' => $pengalaman,
      'software' => $software,
      'os' => $os,
      'tingkat' => $tingkat
    ];
    // Redirect agar tidak re-submit saat refresh
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  }
}

// Ambil data jika sudah ada
if (isset($_SESSION['hasil'])) {
  $hasil = $_SESSION['hasil'];
  extract($hasil); // membuat $nama, $nim, dll dari array hasil

  $hasil_input = "
  <div class='bg-green-50 border border-green-300 text-green-800 mt-6 max-w-4xl mx-auto rounded p-6'>
    <h2 class='font-bold text-lg mb-4'>Hasil Input:</h2>

    <div class='overflow-x-auto mb-6'>
      <h3 class='font-bold text-lg mb-4 text-center'>Data Diri</h3>
      <table class='w-full table-auto border border-collapse border-green-400'>
        <tr><th class='border px-4 py-2'>Nama</th><td class='border px-4 py-2'>" . htmlspecialchars($nama) . "</td></tr>
        <tr><th class='border px-4 py-2'>NIM</th><td class='border px-4 py-2'>" . htmlspecialchars($nim) . "</td></tr>
        <tr><th class='border px-4 py-2'>Tempat, Tanggal Lahir</th><td class='border px-4 py-2'>" . htmlspecialchars($ttl) . "</td></tr>
        <tr><th class='border px-4 py-2'>Email</th><td class='border px-4 py-2'>" . htmlspecialchars($email) . "</td></tr>
        <tr><th class='border px-4 py-2'>Nomor HP</th><td class='border px-4 py-2'>" . htmlspecialchars($hp) . "</td></tr>
      </table>
    </div>

    <div class='overflow-x-auto'>
      <h3 class='font-bold text-lg mb-4 text-center'>Daftar Keahlian</h3>
      <table class='w-full table-auto border border-collapse border-green-400'>
        <tr><th class='border px-4 py-2'>Bahasa Pemrograman</th><td class='border px-4 py-2'>" . cetak_array($bahasa) . "</td></tr>
        <tr><th class='border px-4 py-2'>Software</th><td class='border px-4 py-2'>" . cetak_array($software) . "</td></tr>
        <tr><th class='border px-4 py-2'>Sistem Operasi</th><td class='border px-4 py-2'>{$os}</td></tr>
        <tr><th class='border px-4 py-2'>Tingkat PHP</th><td class='border px-4 py-2'>{$tingkat}</td></tr>
        <tr><th class='border px-4 py-2'>Pengalaman</th><td class='border px-4 py-2'>" . nl2br(htmlspecialchars($pengalaman)) . "</td></tr>
      </table>
    </div>";

  if (count($bahasa) >= 2) {
    $hasil_input .= "<p class='mt-3 text-red-600 font-semibold text-center'>Anda cukup berpengalaman dalam pemrograman!</p>";
  }

  $hasil_input .= "</div>";

  // Reset variabel agar form kosong
  $nama = $nim = $ttl = $email = $hp = $pengalaman = '';
  $bahasa = $software = [];
  $os = $tingkat = '';

  unset($_SESSION['hasil']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>PortofolioKu | Profil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <style>
    #hero {
      background-image: url('https://i.pinimg.com/736x/5c/c6/2f/5cc62fdae848f7fde375a320265a1c9b.jpg');
      background-size: cover;
      background-position: center;
      animation: changeBackground 20s infinite;
    }
    @keyframes changeBackground {
      0% { background-image: url('https://i.pinimg.com/736x/5c/c6/2f/5cc62fdae848f7fde375a320265a1c9b.jpg'); }
      25% { background-image: url('https://i.pinimg.com/736x/57/0d/55/570d552155b572850ef71547f86dc0b7.jpg'); }
      50% { background-image: url('https://i.pinimg.com/736x/6c/c2/cb/6cc2cb78b54b11c0419731bb2a89b0d1.jpg'); }
      75% { background-image: url('https://i.pinimg.com/736x/c4/42/8e/c4428e9bb7735ff2aee8aef142e70eff.jpg'); }
      100% { background-image: url('https://i.pinimg.com/736x/c8/24/53/c82453b87e5e8e69afd4c1a0c2b3e5f9.jpg'); }
    }
  </style>
</head>
<body class="font-sans bg-gray-100 text-gray-800">

  <!-- Navbar -->
  <nav class="fixed top-0 left-0 right-0 bg-blue-900 text-white shadow z-50">
    <div class="max-w-6xl mx-auto flex justify-between items-center px-5 py-4">
      <h1 class="text-2xl font-bold">PortofolioKu</h1>
      <ul class="hidden md:flex space-x-8 text-base font-medium">
        <li><a href="profil.php" class="hover:text-yellow-300 flex items-center gap-1"><i class="fas fa-user"></i> Profil</a></li>
        <li><a href="timeline.php" class="hover:text-yellow-300 flex items-center gap-1"><i class="fas fa-briefcase"></i> Pengalaman</a></li>
        <li><a href="blog.php" class="hover:text-yellow-300 flex items-center gap-1"><i class="fas fa-tools"></i> Blog</a></li>
      </ul>
    </div>
  </nav>


  <!-- Hero -->
  <section id="hero" class="h-screen flex items-center justify-center text-white pt-20">
    <div class="bg-black bg-opacity-50 p-8 rounded-lg text-center max-w-4xl w-full">
      <h1 class="text-4xl font-bold mb-4">PROFIL</h1>
      <img src="asset/Profil3.jpg" alt="Profil" class="rounded-full w-40 h-40 mx-auto mb-5 border-4 border-yellow-400" />
      <h1 class="text-4xl font-bold mb-2">Halo, Saya Galih Samudra Mubin</h1>
      <p class="text-xl mb-4">Mahasiswa Sistem Informasi | Universitas Trunojoyo Madura</p>
      <a href="#biodata" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600">Lihat Profil</a>
    </div>
  </section>

  <!-- Data Diri -->
  <section id="biodata" class="py-10 px-4">
  <form method="POST" class="bg-white shadow-md rounded-lg p-6 max-w-4xl mx-auto space-y-6">
    <h2 class="text-2xl font-bold text-blue-900 mb-2 text-center">Form Data Diri & Keahlian</h2>

    <?php if ($pesan_error): ?>
      <p class='text-red-600 font-bold text-center'><?= $pesan_error ?></p>
    <?php endif; ?>

    <!-- Data Diri -->
    <div>
      <label class="block font-semibold mb-1">Nama:</label>
      <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" class="w-full border p-2 rounded" />
    </div>
    <div>
      <label class="block font-semibold mb-1">NIM:</label>
      <input type="text" name="nim" value="<?= htmlspecialchars($nim) ?>" class="w-full border p-2 rounded" />
    </div>
    <div>
      <label class="block font-semibold mb-1">Tempat, Tanggal Lahir:</label>
      <input type="text" name="ttl" value="<?= htmlspecialchars($ttl) ?>" class="w-full border p-2 rounded" />
    </div>
    <div>
      <label class="block font-semibold mb-1">Email:</label>
      <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" class="w-full border p-2 rounded" />
    </div>
    <div>
      <label class="block font-semibold mb-1">Nomor HP:</label>
      <input type="text" name="hp" value="<?= htmlspecialchars($hp) ?>" class="w-full border p-2 rounded" />
    </div>

    <!-- Keahlian -->
    <div>
      <label class="block font-semibold mb-2">Bahasa Pemrograman yang Dikuasai (pisahkan dengan koma):</label>
      <input type="text" name="bahasa" value="<?= htmlspecialchars(implode(', ', $bahasa)) ?>" class="w-full border p-2 rounded" />
    </div>

    <div>
      <label class="block font-semibold mb-2">Pengalaman Proyek:</label>
      <textarea name="pengalaman" class="w-full border p-2 rounded" rows="4"><?= htmlspecialchars($pengalaman) ?></textarea>
    </div>

    <div>
      <label class="block font-semibold mb-2">Software yang Sering Digunakan:</label>
      <div class="flex flex-wrap gap-6">
        <?php
        $list_software = ['VS Code', 'XAMPP', 'Git'];
        foreach ($list_software as $s) {
          $checked = in_array($s, $software) ? 'checked' : '';
          echo "<label class='flex items-center gap-2'><input type='checkbox' name='software[]' value='$s' $checked> $s</label>";
        }
        ?>
      </div>
    </div>

    <div>
      <label class="block font-semibold mb-2">Sistem Operasi:</label>
      <div class="flex gap-6">
        <?php
        $ops = ['Windows', 'Linux', 'Mac'];
        foreach ($ops as $val) {
          $checked = $os === $val ? 'checked' : '';
          echo "<label class='flex items-center gap-2'><input type='radio' name='os' value='$val' $checked> $val</label>";
        }
        ?>
      </div>
    </div>

    <div>
      <label class="block font-semibold mb-2">Tingkat Penguasaan PHP:</label>
      <select name="tingkat" class="border p-2 w-full rounded">
        <option value="">Pilih</option>
        <?php
        foreach (['Pemula', 'Menengah', 'Mahir'] as $level) {
          $selected = $tingkat === $level ? 'selected' : '';
          echo "<option value='$level' $selected>$level</option>";
        }
        ?>
      </select>
    </div>

    <button type="submit" name="submit" class="bg-blue-600 text-white py-2 px-6 rounded hover:bg-blue-700">Kirim</button>
  </form>

  <?= $hasil_input ?>
  </section>

  <!-- Footer -->
  <footer class="bg-blue-900 text-white text-center py-4">
    &copy; 2025 Galih Samudra Mubin. All rights reserved.
  </footer>

</body>
</html>