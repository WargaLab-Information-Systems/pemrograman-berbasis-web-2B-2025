<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Timeline Kuliah</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800">

  <header class="bg-white fixed top-0 left-0 w-full z-50 shadow-sm">
    <div class="px-8 flex justify-center items-center justify-between py-4">
      <div>
        <h1 class="text-2xl text-blue-700 font-bold">ProfilMhs.</h1>
      </div>
      
      <nav class="hidden md:flex space-x-8 items-center">
        <a href="index.php" class="text-gray-600 hover:text-blue-600 transition-300">Profile</a>
        <a href="timeline.php" class="text-blue-600 font-semibold">Experience</a>
        <a href="blog.php" class="text-gray-600 hover:text-blue-600 transition-300">Blog</a>
      </nav>

      <button class="md:text-gray-600">
        <i class="fas fa-bars text-xl"></i>
      </button>
    </div>
  </header>

  <main class="max-w-5xl mx-auto py-10 px-4 mt-20">
    <section class="mb-10">
      <h2 class="text-2xl font-bold text-blue-700 mb-4">Awal Masuk Kuliah</h2>
      <p class="mb-3">Kesan pertama masuk kuliah sangat berbeda dengan masa sekolah. Lingkungan yang lebih mandiri dan tanggung jawab yang lebih besar membuat saya harus cepat beradaptasi. Minggu-minggu pertama diisi dengan orientasi kampus dan pengenalan sistem perkuliahan.</p>
      <p class="mb-3">Hal yang paling berkesan adalah bertemu dengan teman-teman dari berbagai latar belakang yang memiliki minat sama di bidang teknologi. Kami sering berdiskusi tentang proyek-proyek kecil di luar jam kuliah.</p>
      <p class="mb-3">Tantangan terbesar adalah mengatur waktu antara kuliah, tugas, olahraga, dan kegiatan UKM. Saya mencoba membuat jadwal mingguan dan selalu mencari waktu untuk istirahat biar nggak kelelahan.</p>
    </section>

    <section class="relative border-l-4 border-blue-400 pl-3 space-y-5 hover:bg-gray-50 transition">
      <?php
      function tampilkanTimeline($timeline) {
        foreach ($timeline as $item) {
          echo "
            <div class='relative'>
              <div class='absolute -left-[1.4rem] top-0 w-4 h-4 bg-blue-400 rounded-full border-4 border-white'></div>
              <div class='bg-white shadow-sm rounded-md p-5'>
                <p class='text-xs text-gray-500 mb-1'>{$item['tahun']}</p>
                <h3 class='text-xl font-bold text-blue-600 mb-2'>{$item['judul']}</h3>
                <p class='text-gray-700 text-sm'>{$item['deskripsi']}</p>
              </div>
            </div>
          ";
        }
      }

      $timeline = [
        [
          "tahun" => "Semester 1 - 2024",
          "judul" => "Adaptasi dan Awal Perkuliahan",
          "deskripsi" => "Belajar dasar-dasar pemrograman seperti logika dasar, dan pengenalan sistem komputer. Mulai kenal dengan lingkungan kampus dan bergabung ke UKM Triple-C."
        ],
        [
          "tahun" => "Semester 2 - 2025",
          "judul" => "Membuat Proyek Web Pertama",
          "deskripsi" => "Mengerjakan tugas praktikum kuliah berbasis web menggunakan PHP dan Tailwind CSS. Mulai belajar kerja tim lewat tugas kelompok, dan aktif ikut kegiatan kampus."
        ],
      ];

      tampilkanTimeline($timeline);
      ?>
    </section>
        <nav class="flex justify-between mt-10">
          <a href="tugas1.php" class="bg-blue-100 text-blue-600 text-sm font-semibold px-4 py-2 rounded-lg hover:bg-blue-200 transition">Menuju Timeline Profile</a>
          <a href="tugas3.php" class="bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-blue-700 transition">Menuju Timeline Blog</a>
        </nav>
  </main>

</body>
