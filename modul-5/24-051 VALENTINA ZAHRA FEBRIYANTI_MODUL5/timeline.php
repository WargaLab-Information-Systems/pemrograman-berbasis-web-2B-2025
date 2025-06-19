<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Timeline Pengalaman Kuliah</title>

  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FFC4C4] text-[#850E35] transition-colors duration-300 min-h-screen p-6">

  <h1 class="text-4xl font-bold text-center mb-16">Timeline Pengalaman Kuliah</h1>

  <?php
  // Array asosiatif
  $timeline = [
    [
      "year" => "2021 Semester 1",
      "desc" => "Aktif mengikuti perkuliahan dan mulai bergabung dengan organisasi Daerah.",
      "image" => "anime1.jpg"
    ],
    [
      "year" => "2025 Semester 2",
      "desc" => "Mulai mengerjakan tugas kelompok dan proyek kecil di mata kuliah.",
      "image" => "anime2.jpg"
    ],
    
  ];

  function formatTimeline($year, $desc) {
    return "Pada <strong>$year</strong>, $desc";
  }
  ?>

  <div class="relative max-w-3xl mx-auto before:absolute before:top-0 before:bottom-0 before:left-1/2 before:w-1 before:bg-[#850E35]">
    <?php foreach ($timeline as $index => $item): ?>
      <div class="mb-12 flex justify-between items-center w-full <?= $index % 2 === 0 ? 'flex-row' : 'flex-row-reverse' ?>">
        <div class="w-5/12"></div>
        <div class="w-5/12 bg-white p-6 rounded-lg shadow-lg flex items-center gap-4">
          <img src="<?= htmlspecialchars($item['image']) ?>" alt="Foto <?= htmlspecialchars($item['year']) ?>" class="w-20 h-20 object-cover rounded shadow" />
          <div>
            <h3 class="text-xl font-bold mb-1"><?= htmlspecialchars($item['year']) ?></h3>
            <p class="text-base"><?= formatTimeline(htmlspecialchars($item['year']), htmlspecialchars($item['desc'])) ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Tombol Navigasi -->
  <div class="mt-16 flex justify-center gap-6">
    <a href="profil.php" class="px-6 py-3 bg-[#850E35] text-[#FFC4C4] rounded-full shadow hover:bg-[#a43757] transition">
      Kembali ke Profil
    </a>
    <a href="blog.php" class="px-6 py-3 bg-[#850E35] text-[#FFC4C4] rounded-full shadow hover:bg-[#a43757] transition">
      Menuju Blog
    </a>
  </div>

</body>
</html>
