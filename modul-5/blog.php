<?php
$articles = [
    [
        "title" => "Refleksi Hari Pertama Kuliah",
        "date" => "2025-05-01",
        "content" => "Hari ini adalah hari pertama aku kembali duduk di bangku kuliah. Rasanya campur aduk—antara semangat, gugup, dan penasaran. Suasana kampus yang sempat sepi kini kembali hidup dengan canda tawa dan langkah-langkah semangat dari para mahasiswa.
        Mata kuliah pertama dimulai dengan perkenalan dosen dan silabus. Meski hanya pengantar, aku merasa tertantang dengan materi yang akan dipelajari semester ini. Dosen juga memberikan motivasi yang menyentuh tentang pentingnya belajar, bukan hanya untuk nilai, tapi untuk bekal masa depan.
        Hal yang paling berkesan hari ini adalah pertemuan dengan teman-teman lama dan juga mengenal teman-teman baru. Kami saling bertukar cerita, membicarakan rencana, dan saling menyemangati untuk menjalani semester ini.
        Hari pertama ini jadi pengingat bahwa setiap langkah kecil menuju impian itu penting. Semoga semangat ini terus terjaga hingga akhir semester.",
        "image" => "asset/blog1.png",
        "source" => ""
    ],
    [
        "title" => "Belajar Konsisten dan Tekun",
        "date" => "2025-05-08",
        "content" => "Belajar dengan konsisten dan tekun adalah kunci utama untuk meraih kesuksesan akademik maupun dalam kehidupan sehari-hari. Konsistensi membantu kita membentuk kebiasaan positif yang pada akhirnya membawa perubahan besar, meski langkah-langkah awal terlihat kecil dan lambat.
        Tekun berarti tidak mudah menyerah ketika menghadapi kesulitan atau rasa bosan. Saat rasa lelah dan malas mulai mengintai, ingatlah tujuan dan alasan mengapa kita belajar. Dengan begitu, motivasi akan terus terjaga dan proses belajar menjadi lebih bermakna.
        Selalu sediakan waktu setiap hari untuk belajar, walau hanya sedikit. Lama-kelamaan, kebiasaan ini akan menguatkan pemahaman dan kemampuan kita. Jangan takut untuk mencoba dan berbuat kesalahan, karena di situlah proses belajar sesungguhnya terjadi.
        Semoga dengan konsistensi dan ketekunan, kita bisa mencapai prestasi terbaik dan meraih impian yang diidamkan. Tetap semangat dan jangan mudah menyerah!.",
        "image" => "asset/blog2.png",
        "source" => ""
    ],
    [
        "title" => "Mengatasi Rasa Malas",
        "date" => "2025-05-15",
        "content" => "Rasa malas sebenarnya adalah hal yang normal, tetapi sebaiknya tidak dibiarkan berlarut-larut karena bisa mengganggu aktivitas sehari-hari Anda. Oleh karena itu, mari simak beragam cara mengatasi rasa malas berikut.
        Dampak rasa malas yang berlarut-larut tidak boleh disepelekan, lho. Jika tidak segera diatasi, bisa membuat Anda menjadi tidak fokus, menurunkan kinerja, dan pada akhirnya memengaruhi kesehatan dan kehidupan Anda secara keseluruhan.",
        "image" => "asset/blog3.png",
        "source" => "https://www.alodokter.com/cara-mengatasi-rasa-malas-yang-mudah-dilakukan"
    ]
];

$quotes = [
    "Kesuksesan adalah hasil dari kerja keras dan ketekunan.",
    "Jangan berhenti ketika lelah, berhentilah ketika selesai.",
    "Setiap langkah kecil akan membawa kita menuju tujuan besar.",
    "Motivasi adalah kunci membuka pintu keberhasilan."
];

function getRandomQuote($quotes) {
    return $quotes[rand(0, count($quotes) - 1)];
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id < 0 || $id >= count($articles)) $id = 0;
$article = $articles[$id];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>PortofolioKu | Blog </title>
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
        <h1 class="text-4xl font-bold mb-4">BLOG PRIBADI</h1>
        <img src="asset/Profil3.jpg" alt="Profil" class="rounded-full w-40 h-40 mx-auto mb-5 border-4 border-yellow-400" />
        <h1 class="text-3xl font-bold mb-2">Halo, Saya Galih Samudra Mubin</h1>
        <p class="text-xl mb-4">Mahasiswa Sistem Informasi | Universitas Trunojoyo Madura</p>
        <a href="#blog" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600">Lihat Blog Reflektif</a>
    </div>
  </section>

  <!-- Blog Section -->
  <section id="blog" class="max-w-5xl mx-auto px-4 py-12 mt-10">
    <h2 class="text-3xl text-blue-800 font-bold mb-6 text-center">Blog Reflektif</h2>

    <!-- Daftar artikel -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
    <h3 class="text-xl text-blue-800 font-semibold mb-4 border-b pb-2">Daftar Artikel:</h3>
    <div class="space-y-2">
        <?php foreach ($articles as $index => $art): ?>
        <a href="?id=<?php echo $index; ?>" class="block text-gray-600 hover:underline hover:text-blue-800">
            <?php echo htmlspecialchars($art['title']); ?> — <small><?php echo $art['date']; ?></small>
        </a>
        <?php endforeach; ?>
    </div>
    </div>


    <!-- Artikel aktif -->
    <div class="bg-white rounded-lg shadow p-6">
      <h3 class="text-2xl font-bold text-blue-800 mb-2"><?php echo htmlspecialchars($article['title']); ?></h3>
      <p class="text-sm text-gray-600 mb-4">Tanggal: <?php echo $article['date']; ?></p>
      <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="Ilustrasi" class="w-full max-w-md aspect-[3/2] object-cover rounded mb-4 mx-auto">
      <p class="mb-4 text-justify"><?php echo htmlspecialchars($article['content']); ?></p>
      <blockquote class="italic border-l-4 border-yellow-500 pl-4 text-gray-700">
        "<?php echo getRandomQuote($quotes); ?>"
      </blockquote>
      <?php if (!empty($article['source'])): ?>
        <p class="mt-4">Sumber: 
          <a href="<?php echo htmlspecialchars($article['source']); ?>" target="_blank" class="text-blue-500 hover:underline">
            <?php echo $article['source']; ?>
          </a>
        </p>
      <?php endif; ?>
    </div>

    <!-- Navigasi artikel -->
    <div class="flex justify-between items-center mt-8 text-lg font-medium">
    <?php if ($id > 0): ?>
        <a href="?id=<?php echo $id - 1; ?>" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600 transition">
        <i class="fas fa-arrow-left mr-2"></i> Artikel Sebelumnya
        </a>
    <?php else: ?>
        <span></span>
    <?php endif; ?>

    <?php if ($id < count($articles) - 1): ?>
        <a href="?id=<?php echo $id + 1; ?>" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600 transition">
        Artikel Berikutnya <i class="fas fa-arrow-right ml-2"></i>
        </a>
    <?php endif; ?>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-blue-900 text-white text-center py-4">
    &copy; 2025 Galih Samudra Mubin. All rights reserved.
  </footer>
</body>
</html>
