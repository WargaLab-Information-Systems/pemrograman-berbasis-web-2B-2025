<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Karyawanku</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class'
    };
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="antialiased text-gray-800 dark:text-gray-100 dark:bg-gray-900 transition-colors duration-300">
  <!-- Header -->
  <header class="flex flex-wrap items-center justify-between px-6 md:px-12 py-4 shadow bg-white dark:bg-gray-800 sticky top-0 z-50 transition-colors duration-300 border-b border-orange-200 dark:border-orange-500">
  <div class="flex items-center space-x-2">
    <img src="Asset/logo1.png" alt="karyawanku Logo" class="w-8 h-8">
    <span class="text-lg font-semibold text-gray-900 dark:text-white">Karyawanku</span>
  </div>
  <nav class="flex space-x-4 md:space-x-6 mt-2 md:mt-0">
    <a href="#beranda" class="text-sm text-gray-700 dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400">Beranda</a>
    <a href="#keuntungan" class="text-sm text-gray-700 dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400">Fitur</a>
    <a href="#harga" class="text-sm text-gray-700 dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400">Pricing</a>
  </nav>
  <div class="flex space-x-3 mt-2 md:mt-0">
    <button id="toggle-theme" class="text-sm px-4 py-2 border rounded text-orange-700 dark:text-white border-orange-600 hover:bg-orange-50 dark:hover:bg-orange-800 transition-colors">🌙</button>
    <a href="login.php" class="text-sm px-4 py-2 text-orange-600 border border-orange-600 rounded hover:bg-orange-50 dark:hover:bg-orange-800">Sign In</a>
    <a href="registrasi.php" class="text-sm px-4 py-2 text-white bg-orange-600 rounded hover:bg-orange-700">Sign Up</a>
  </div>
  </header>

  <!-- Hero Section -->
  <section id="beranda" class="px-6 md:px-6 lg:px-12 py-16 bg-white dark:bg-gray-900 transition-colors">
  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-8">
    
    <!-- Teks Hero -->
    <div>
      <h1 class="text-3xl md:text-5xl font-bold leading-tight text-gray-900 dark:text-white">
        Optimalkan Manajemen <span class="text-orange-600">Karyawan</span> Anda dengan Karyawanku
      </h1>
      <p class="text-base text-gray-600 dark:text-gray-300 mt-4">
        Bangun sistem kerja yang efisien dan profesional bersama <strong>Karyawanku.</strong><br>
        Kelola data karyawan, absensi, dan aktivitas harian dengan cepat dan mudah melalui dashboard modern berbasis web.
      </p>
      <button class="mt-6 px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white rounded-lg text-sm shadow-md transition duration-300">
        Get Started
      </button>
    </div>

    <!-- Gambar Hero -->
    <div class="flex justify-center md:justify-end">
      <img src="Asset/Gambar1.png" alt="Ilustrasi Sistem Manajemen Karyawan" class="w-full max-w-md md:max-w-sm">
    </div>
  </div>
  </section>
  
  <!-- Section Keuntungan -->
  <section id="keuntungan" class="px-6 md:px-12 py-16 bg-gray-50 dark:bg-gray-800 transition-colors">
    <div class="text-center">
      <h2 class="text-2x1 text-orange-600 font-semibold">Kenapa Pilih Kami?</h2>
      <h3 class="text-2xl font-semibold mt-2 text-gray-800 dark:text-white">Karena memiliki Fitur Utama!</h3>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 mt-12">
      <!-- Item -->
      <div class="flex flex-col items-center text-center">
        <div class="bg-yellow-500 rounded-full p-4 mb-4">
          <img src="Asset/icon1.png" alt="Ikon Manajemen" class="w-7 h-7">
        </div>
        <h4 class="font-bold mb-1">Manajemen Data Karyawan</h4>
        <p class="text-sm text-gray-600 dark:text-gray-300">Menyimpan data penting seperti nama, jabatan, tanggal masuk, dan kontak.</p>
      </div>
      <div class="flex flex-col items-center text-center">
        <div class="bg-orange-500 rounded-full p-4 mb-4">
          <img src="Asset/icon2.png" alt="Ikon otomatis" class="w-7 h-7">
        </div>
        <h4 class="font-bold mb-1">Login & Registrasi Otomatis</h4>
        <p class="text-sm text-gray-600 dark:text-gray-300">Sistem otentikasi dengan akses berbeda untuk admin dan user.</p>
      </div>
      <div class="flex flex-col items-center text-center">
        <div class="bg-yellow-500 rounded-full p-4 mb-4">
          <img src="Asset/icon3.png" alt="Ikon Dinamis" class="w-7 h-7">
        </div>
        <h4 class="font-bold mb-1">Dashboard Dinamis</h4>
        <p class="text-sm text-gray-600 dark:text-gray-300">Tampilan informasi yang disesuaikan dengan peran pengguna.</p>
      </div>
      <div class="flex flex-col items-center text-center">
        <div class="bg-orange-500 rounded-full p-4 mb-4">
          <img src="Asset/icon4.png" alt="Ikon tema" class="w-7 h-7">
        </div>
        <h4 class="font-bold mb-1">Tema Gelap dan Terang</h4>
        <p class="text-sm text-gray-600 dark:text-gray-300">Pengguna bisa memilih mode tampilan sesuai kenyamanan.</p>
      </div>
    </div>
  </section>

  <!-- Section Informasi -->
  <section class="px-6 md:px-12 py-16 space-y-16 bg-white dark:bg-gray-900 transition-colors">
    <!-- Konten Informasi 1 -->
    <div class="grid md:grid-cols-2 items-center gap-8">
      <img src="Asset/Gambar2.png" alt="Ilustrasi Manajemen" class="w-full max-w-xs mx-auto mb-6 md:mb-0">
      <div class="text-center md:text-left">
        <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Akses Mudah untuk Admin & Karyawan</h3>
        <p class="text-gray-600 dark:text-gray-300 text-sm">Admin dapat melihat seluruh data karyawan, melakukan pengelolaan data (tambah, edit, hapus), dan memantau aktivitas sistem. Sementara itu, karyawan (user) hanya dapat melihat dan mengedit profil pribadinya.</p>
      </div>
    </div>
    <!-- Konten Informasi 2 -->
    <div class="grid md:grid-cols-2 items-center gap-8">
      <div class="text-center md:text-left">
        <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Memudahkan dalam melakukan Perencanaan</h3>
        <p class="text-gray-600 dark:text-gray-300 text-sm">Dapat digunakan sebagai media dalam mengelola data dan mampu dalam pengusunan perencanaan ke depan yang didasarkan dengan analisa evaliuasi yang ada.</p>
      </div>
      <img src="Asset/Gambar3.png" alt="Ilustrasi Belajar dari Ahli" class="w-full max-w-xs mx-auto mb-6 md:mb-0">
    </div>
    <!-- Konten Informasi 3 -->
    <div class="grid md:grid-cols-2 items-center gap-8">
      <img src="Asset/Gambar4.png" alt="Ilustrasi Proyek Nyata" class="w-full max-w-xs mx-auto mb-6 md:mb-0">
      <div class="text-center md:text-left">
        <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Analisis Data yang kuat</h3>
        <p class="text-gray-600 dark:text-gray-300 text-sm">Dengan pencatatan dan pengelolaan data yang baik, mampu memudahkan perusahaan dalam menganalisa hasil data dan kinerja karyawan.</p>
      </div>
    </div>
  </section>

  <!-- Section Penawaran -->
  <section id="harga" class="bg-gradient-to-r from-orange-500 via-orange-400 to-orange-300 text-white px-6 md:px-12 py-16 transition-colors">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
      <!-- Tampilan Kiri -->
      <div>
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Mulailah Transformasi Anda dengan Karyawanku</h2>
        <p class="text-base mb-6 text-gray-200">Kami memiliki beberapa rencana yang mungkin cocok untuk Anda. Silakan unduh syllabus lengkap kami di bawah ini.</p>
        <button class="bg-white text-orange-700 px-5 py-2 text-sm rounded font-semibold hover:bg-gray-100 transition">
          Lihat Syllabus
        </button>
      </div>
      <!-- Kartu Harga -->
      <div class="bg-white rounded-2xl shadow-xl text-gray-800 p-8 max-w-sm mx-auto">
        <div class="text-sm text-orange-600 font-bold mb-2 text-center">BARU MULAI</div>
        <div class="text-3xl font-bold mb-6 text-center">Rp.1.000.000</div>
        <ul class="space-y-4 mb-6">
          <!-- Item 1 -->
          <li class="flex items-center space-x-3 pb-3 border-b border-gray-200">
            <div class="bg-orange-400 rounded-full p-2">
              <img src="Asset/centang.png" alt="Centang" class="w-4 h-4">
            </div>
            <span class="text-sm">Masa aktif 1 tahun</span>
          </li>
          <!-- Item 2 -->
          <li class="flex items-center space-x-3 pb-3 border-b border-gray-200">
            <div class="bg-orange-400 rounded-full p-2">
              <img src="Asset/centang.png" alt="Centang" class="w-4 h-4">
            </div>
            <span class="text-sm">Pengguna pertama gratis 3 bulan</span>
          </li>
          <!-- Item 3 -->
          <li class="flex items-center space-x-3 pb-3 border-b border-gray-200">
            <div class="bg-orange-400 rounded-full p-2">
              <img src="Asset/centang.png" alt="Centang" class="w-4 h-4">
            </div>
            <span class="text-sm">Video tutorial penggunaan</span>
          </li>
          <!-- Item 4 -->
          <li class="flex items-center space-x-3">
            <div class="bg-orange-400 rounded-full p-2">
              <img src="Asset/centang.png" alt="Centang" class="w-4 h-4">
            </div>
            <span class="text-sm">Gratis database</span>
          </li>
        </ul>
        <button class="bg-orange-100 text-orange-700 px-4 py-2 text-sm font-medium rounded w-full hover:bg-orange-200 transition">
          Mulailah Dengan Rencana Ini
        </button>
      </div>
    </div>
  </section>

  <!-- Footer --> 
  <footer class="bg-white dark:bg-gray-900 px-6 md:px-12 py-12 border-t border-gray-200 dark:border-gray-700 text-sm text-gray-600 dark:text-gray-300 transition-colors">
    <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8">
      <div>
        <div class="flex items-center space-x-2">
          <img src="Asset/Logo1.png" alt="Karyawanku Logo" class="w-5 h-5">
          <span class="text-lg font-semibold text-gray-900 dark:text-white">Karyawanku</span>
        </div>
        <p class="mt-2">Bangun sistem kerja yang efisien dan profesional bersama Karyawanku.</p>
      </div>
      <div>
        <h4 class="font-bold text-gray-800 dark:text-white mb-2">Bisnis Karyawanku</h4>
        <ul class="space-y-1">
          <li><a href="#" class="hover:underline">Teknologi di Karyawanku</a></li>
          <li><a href="#" class="hover:underline">Unduh Aplikasinya</a></li>
          <li><a href="#" class="hover:underline">Tentang Kami</a></li>
          <li><a href="#" class="hover:underline">Hubungi Kami</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold text-gray-800 dark:text-white mb-2">Portofolio</h4>
        <ul class="space-y-1">
          <li><a href="#" class="hover:underline">Blog</a></li>
          <li><a href="#" class="hover:underline">Bantuan dan Dukungan</a></li>
          <li><a href="#" class="hover:underline">Pengguna</a></li>
          <li><a href="#" class="hover:underline">Investasi</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold text-gray-800 dark:text-white mb-2">Syarat dan Ketentuan</h4>
        <ul class="space-y-1">
          <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
          <li><a href="#" class="hover:underline">Pengaturan Cookie</a></li>
          <li><a href="#" class="hover:underline">Aksesibilitas</a></li>
          <li><a href="#" class="hover:underline">Peta Situs</a></li>
        </ul>
      </div>
    </div>

    <!-- Bagian Copyright -->
    <div class="mt-10 pt-5 text-center text-xs text-gray-400">
      © 2025 Karyawanku. All rights reserved. Designed by Galih Samudra Mubin.
    </div>
  </footer>
  <script src="js/tema.js"></script>
</body>
</html>
