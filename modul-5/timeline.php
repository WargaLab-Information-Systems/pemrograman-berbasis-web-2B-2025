<?php
$pengalaman = [
  [
    'tahun' => '2024',
    'judul' => 'Masa Mahasiswa Baru',
    'deskripsi' => 'Mengikuti PKKMB, mengenal kampus dan bertemu teman-teman baru.',
    'gambar' => 'asset/gambar1.jpg'
  ],
  [
    'tahun' => '2024',
    'judul' => 'Masa Semester 1',
    'deskripsi' => 'Mulai aktif diperkuliahan dan belajar berbagai bahasa pemrograman.',
    'gambar' => 'asset/gambar2.jpg'
  ],
  [
    'tahun' => '2025',
    'judul' => 'Masa Semester 2',
    'deskripsi' => 'Selain Berkuliah, Mulai Mencoba Mengikuti Organisasi yaitu Himpunan di prodi Sistem Informasi.',
    'gambar' => 'asset/gambar3.jpg'
  ]
];
function tampilkan_timeline($item, $posisi, $is_last = false) {
  $alignWrapper = $posisi === 'left' ? 'justify-start md:pr-12 text-right' : 'justify-end md:pl-12 text-left';
  $contentPosition = $posisi === 'left' ? 'items-end md:items-end' : 'items-start md:items-start';

  echo "
  <div class='relative w-full flex {$alignWrapper} mb-16'>
    " . (!$is_last ? "<div class='absolute left-1/2 transform -translate-x-1/2 top-6 h-[420px] border-l-4 border-blue-500 z-0'></div>" : "") . "

    <!-- Titik -->
    <div class='absolute left-1/2 transform -translate-x-1/2 top-6 w-6 h-6 bg-white border-4 border-blue-600 rounded-full z-10 shadow'></div>

    <div class='w-full md:w-1/2 flex flex-col {$contentPosition}'>
      <div class='bg-white p-6 rounded-xl shadow-lg border-l-4 border-blue-600 max-w-md hover:shadow-2xl transition duration-300 ease-in-out'>
        <h3 class='text-blue-800 font-semibold text-xl mb-2'>{$item['tahun']} - {$item['judul']}</h3>
        <div class='w-full h-48 mb-4 rounded-lg overflow-hidden border'>
          <img src='{$item['gambar']}' alt='foto pengalaman' class='w-full h-full object-cover' />
        </div>
        <p class='text-gray-700 text-sm leading-relaxed'>{$item['deskripsi']}</p>
      </div>
    </div>
  </div>
  ";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>PortofolioKu | Timeline</title>
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
<body class="bg-gray-100 text-gray-800 font-sans">

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
      <h1 class="text-4xl font-bold mb-4">TIMELINE KULIAH</h1>
      <img src="asset/Profil3.jpg" alt="Profil" class="rounded-full w-40 h-40 mx-auto mb-5 border-4 border-yellow-400" />
      <h1 class="text-4xl font-bold mb-2">Halo, Saya Galih Samudra Mubin</h1>
      <p class="text-xl mb-4">Mahasiswa Sistem Informasi | Universitas Trunojoyo Madura</p>
      <a href="#timeline" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600">Lihat Perjalanan</a>
    </div>
  </section>

  <!-- Timeline Section -->
  <section id="timeline" class="relative max-w-4xl mx-auto px-4 py-20 z-10">
  <h2 class="text-3xl font-bold text-center mb-12 text-blue-800">Perjalananku menjadi Mahasiswa SI</h2>
  <?php 
  $count = count($pengalaman);
  foreach ($pengalaman as $index => $item) {
  $posisi = ($index % 2 === 0) ? 'left' : 'right';
  $is_last = $index === count($pengalaman) - 1;
  tampilkan_timeline($item, $posisi, $is_last);
  }
  ?>
  </section>


  <!-- Footer -->
  <footer class="bg-blue-900 text-white text-center py-4 mt-10">
    &copy; 2025 Galih Samudra Mubin. All rights reserved.
  </footer>

</body>
</html>
