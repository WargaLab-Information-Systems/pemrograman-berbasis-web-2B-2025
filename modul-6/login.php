<?php
session_start();
include 'koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitasi input
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password_raw = $_POST['password'];
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Validasi sisi server minimal
    if (strlen($username) < 3) {
        $error = 'Username minimal 3 karakter.';
    } elseif (strlen($password_raw) < 6) {
        $error = 'Password minimal 6 karakter.';
    } elseif ($role !== 'user' && $role !== 'admin') {
        $error = 'Role tidak valid.';
    } else {
        // Cek user dan role di database
        $query = "SELECT * FROM users WHERE username = '$username' AND role = '$role' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);
            // Verifikasi password
            if (password_verify($password_raw, $user['password'])) {
                // Login berhasil, set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect ke dashboard sesuai role
                if ($user['role'] === 'admin') {
                    header('Location: dashboard_admin.php');
                } else {
                    header('Location: dashboard_karyawan.php');
                }
                exit;
            } else {
                $error = 'Password salah.';
            }
        } else {
            $error = 'Username atau role tidak ditemukan.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Karyawanku - Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-white">

  <div class="w-full max-w-5xl mx-auto border rounded-3xl overflow-hidden shadow-lg grid grid-cols-1 md:grid-cols-2">

    <!-- Bagian Kiri (Ilustrasi) -->
    <div class="bg-orange-500 flex items-center justify-center p-6">
      <img src="Asset/Gambar5.png" alt="Ilustrasi" class="w-96 max-w-full h-auto object-contain" />
    </div>

    <!-- Bagian Kanan (Form Login) -->
    <div class="bg-white p-10">

      <!-- Logo dan Tulisan -->
      <div class="mb-4 flex items-center gap-2">
        <img src="Asset/logo1.png" alt="Logo Aplikasi" class="h-8" />
        <span class="font-semibold text-lg text-gray-700">Karyawanku</span>
      </div>

      <!-- Motivasi -->
      <p class="text-sm text-gray-500 mb-6">
        <span class="text-lg font-semibold text-gray-800">Login</span><br />
        <span class="text-gray-400">Menunggu besok? Bisa jadi kamu takkan pernah mulai.</span>
      </p

      <!-- Pesan Error -->
      <?php if ($error): ?>
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <!-- Form Login -->
      <form action="" method="POST" class="space-y-4" novalidate>
        <div>
          <label for="username" class="block text-sm text-gray-600 mb-1">Username</label>
          <input
            type="text"
            id="username"
            name="username"
            required
            class="w-full px-4 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-400"
            placeholder="Masukkan Username"
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
            placeholder="Masukkan Password"
          />
        </div>

        <div>
          <label for="role" class="block text-sm text-gray-600 mb-1">Masuk Sebagai</label>
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
          Login
        </button>
      </form>

      <!-- Link ke Registrasi -->
      <p class="mt-6 text-center text-gray-600">
        Belum punya akun?
        <a href="registrasi.php" class="text-yellow-600 hover:underline font-medium">Daftar</a>
      </p>
    </div>
  </div>

</body>
</html>
