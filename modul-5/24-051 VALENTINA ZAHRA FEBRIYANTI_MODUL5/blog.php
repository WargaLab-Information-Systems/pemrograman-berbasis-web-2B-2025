<?php
// Data artikel
$blogs = [
  [
    "id" => 1,
    "judul" => "Belajar Python untuk Pemula",
    "tanggal" => "2024-09-15",
    "isi" => "Python adalah bahasa pemrograman yang sangat populer dan mudah dipelajari. Cocok untuk pemula yang ingin mulai coding dengan cepat.",
    "gambar" => "python.jpg",
    "referensi" => "https://www.python.org/about/gettingstarted/"
  ],
  [
    "id" => 2,
    "judul" => "Memahami Tailwind CSS dalam Desain Web",
    "tanggal" => "2024-10-10",
    "isi" => "Tailwind CSS adalah framework CSS utility-first yang mempercepat proses styling website dengan kelas-kelas siap pakai.",
    "gambar" => "tailwind.jpg",
    "referensi" => "https://tailwindcss.com/docs"
  ],
  [
    "id" => 3,
    "judul" => "Bootstrap: Framework CSS untuk Responsif",
    "tanggal" => "2024-11-05",
    "isi" => "Bootstrap memudahkan pembuatan website responsif dan modern dengan komponen siap pakai yang bisa disesuaikan.",
    "gambar" => "bootstrap.jpg",
    "referensi" => "https://getbootstrap.com/docs/5.0/getting-started/introduction/"
  ]
];

// Kutipan motivasi
$quotes = [
  "Tetap semangat, karena setiap hari adalah peluang baru.",
  "Kesuksesan dimulai dari keberanian untuk mencoba.",
  "Kegagalan adalah bagian dari proses menuju keberhasilan.",
  "Jangan pernah berhenti belajar dan bertumbuh.",
  "Percaya pada dirimu sendiri, itu langkah awal kesuksesan."
];

// Fungsi kutipan acak
function getRandomQuote($quotes) {
  return $quotes[rand(0, count($quotes) - 1)];
}


$id = $_GET['id'] ?? null;
$artikel = null;

if ($id !== null) {
  foreach ($blogs as $b) {
    if ($b["id"] == $id) {
      $artikel = $b;
      break;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Blog Reflektif</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FFC4C4] text-[#850E35] p-6 transition-all min-h-screen">

<h1 class="text-3xl font-bold text-center mb-10">Blog Reflektif Mahasiswa</h1>

<?php if ($id !== null): ?>
  <?php if ($artikel): ?>
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg mb-10">
      <h2 class="text-2xl font-bold mb-2"><?= htmlspecialchars($artikel['judul']) ?></h2>
      <p class="text-sm text-gray-600 mb-4"><?= date("d M Y", strtotime($artikel['tanggal'])) ?></p>
      <img src="<?= htmlspecialchars($artikel['gambar']) ?>" alt="Ilustrasi" class="w-full h-64 object-cover rounded mb-4">
      <p class="mb-4"><?= htmlspecialchars($artikel['isi']) ?></p>
      <blockquote class="italic text-[#850E35] mb-4">“<?= getRandomQuote($quotes) ?>”</blockquote>
      <?php if (!empty($artikel['referensi'])): ?>
        <p class="text-sm">Sumber: <a href="<?= htmlspecialchars($artikel['referensi']) ?>" class="text-[#a43757] underline" target="_blank">Lihat Referensi</a></p>
      <?php endif; ?>
    </div>
    <div class="text-center mb-10">
      <a href="blog.php" class="text-[#a43757] hover:underline">← Kembali ke daftar blog</a>
    </div>
  <?php else: ?>
    <p class="text-center text-red-600">Artikel tidak ditemukan.</p>
  <?php endif; ?>
<?php else: ?>
  <!-- Daftar Blog -->
  <div class="grid md:grid-cols-2 gap-6 max-w-5xl mx-auto">
    <?php foreach ($blogs as $blog): ?>
      <a href="?id=<?= $blog['id'] ?>" class="block bg-white p-5 rounded-lg shadow hover:shadow-lg transition">
        <img src="<?= $blog['gambar'] ?>" alt="Thumbnail" class="w-full h-40 object-cover rounded mb-4">
        <h3 class="text-xl font-bold mb-1"><?= htmlspecialchars($blog['judul']) ?></h3>
        <p class="text-sm text-gray-600 mb-2"><?= date("d M Y", strtotime($blog['tanggal'])) ?></p>
        <p class="text-base"><?= htmlspecialchars(substr($blog['isi'], 0, 100)) ?>...</p>
      </a>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<!-- Navigasi antar halaman -->
<div class="mt-12 flex justify-center gap-6">
  <a href="profil.php" class="px-6 py-3 bg-[#850E35] text-[#FFC4C4] rounded-full shadow hover:bg-[#a43757] transition">
    Kembali ke Profil
  </a>
  <a href="timeline.php" class="px-6 py-3 bg-[#850E35] text-[#FFC4C4] rounded-full shadow hover:bg-[#a43757] transition">
    Menuju Timeline
  </a>
</div>

</body>
</html>
