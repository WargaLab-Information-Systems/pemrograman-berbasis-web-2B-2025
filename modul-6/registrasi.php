<?php
session_start();
include 'koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password_raw = $_POST['password'];
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Validasi server-side
    if (strlen($username) < 3) {
    $error = 'Username minimal 3 karakter.';
    } elseif (strlen($password_raw) < 6) {
        $error = 'Password minimal 6 karakter.';
    } elseif (!preg_match('/[A-Z]/', $password_raw)) { 
        $error = 'Password harus mengandung setidaknya satu huruf besar.';
    } elseif (!preg_match('/[0-9]/', $password_raw)) { 
        $error = 'Password harus mengandung setidaknya satu angka.';
    } elseif (!preg_match('/[^A-Za-z0-9]/', $password_raw)) { 
        $error = 'Password harus mengandung setidaknya satu tanda unik (contoh: !@#$%^&*).';
    } elseif ($role !== 'user' && $role !== 'admin') {
        $error = 'Role tidak valid.';
    } else {
        // Cek apakah username sudah ada
        $cekUser = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        if (mysqli_num_rows($cekUser) > 0) {
            $error = 'Username sudah terdaftar.';
        } else {
            $password = password_hash($password_raw, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Registrasi berhasil!'); window.location.href='login.php';</script>";
                exit;
            } else {
                $error = 'Registrasi gagal: ' . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Karyawanku - Registrasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-white">

  <div class="w-full max-w-5xl mx-auto border rounded-3xl overflow-hidden shadow-lg grid grid-cols-1 md:grid-cols-2">

    <!-- Bagian Kiri -->
    <div class="bg-orange-500 flex items-center justify-center p-6">
      <img src="Asset/Gambar5.png" alt="Ilustrasi" class="w-96 max-w-full h-auto object-contain" />
    </div>

    <!-- Bagian Kanan -->
    <div class="bg-white p-10">

      <!-- Logo dan Judul -->
      <div class="mb-4 flex items-center gap-2">
        <img src="Asset/logo1.png" alt="Logo Aplikasi" class="h-8" />
        <span class="font-semibold text-lg text-gray-700">Karyawanku</span>
      </div>

      <!-- Motivasi -->
      <p class="text-sm text-gray-500 mb-6">
        <span class="text-lg font-semibold text-gray-800">Registrasi</span><br />
        <span class="text-gray-400">Menunggu besok? Bisa jadi kamu takkan pernah mulai.</span>
      </p>

      <!-- Pesan Error -->
      <?php if ($error): ?>
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <!-- Form Registrasi -->
      <form action="" method="POST" class="space-y-4" novalidate>
        <div>
          <label for="username" class="block text-sm text-gray-600 mb-1">Username</label>
          <input
            type="text"
            id="username"
            name="username"
            required
            class="w-full px-4 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-400"
            placeholder="Buat Username"
            value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
          />
        </div>

        <div>
          <label for="password" class="block text-sm text-gray-600 mb-1">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            required
            class="w-full px-4 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-400"
            placeholder="Buat Password"
          />
        </div>

        <div>
          <label for="role" class="block text-sm text-gray-600 mb-1">Daftar Sebagai</label>
          <select
            id="role"
            name="role"
            required
            class="w-full px-4 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-400"
          >
            <option value="">-- Pilih Role --</option>
            <option value="user" <?= (isset($_POST['role']) && $_POST['role'] === 'user') ? 'selected' : '' ?>>Karyawan</option>
            <option value="admin" <?= (isset($_POST['role']) && $_POST['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
          </select>
        </div>

        <button
          type="submit"
          class="w-full bg-orange-500 text-white py-2 rounded-full hover:bg-yellow-500 transition"
        >
          Daftar
        </button>
      </form>

      <!-- Link ke Login -->
      <p class="mt-6 text-center text-gray-600">
        Sudah punya akun?
        <a href="login.php" class="text-orange-600 hover:underline font-medium">Login</a>
      </p>

    </div>
  </div>

</body>
</html>
