<?php
$articles = [
    [
        'id' => 1,
        'title' => 'Apakah IT Governance Masih Relevan di Era Cloud Computing',
        'date' => '15 Mei 2025',
        'content' => 'Dengan maraknya penggunaan layanan cloud seperti AWS, Google Cloud, dan Microsoft Azure, banyak organisasi kini menyerahkan infrastruktur dan bahkan sebagian besar sistem informasinya ke penyedia layanan eksternal. Ini memunculkan pertanyaan penting: apakah IT Governance masih dibutuhkan di era cloud computing?',
        'image' => 'gambar1.jpg',
    ],
    [
        'id' => 2,
        'title' => 'Integrasi Metode Rekayasa Perangkat Lunak dalam Disiplin Teknik Tradisional',
        'date' => '22 Juni 2025',
        'content' => 'Artikel editorial ini membahas bagaimana metode rekayasa perangkat lunak (software engineering) semakin merambah dan memberi pengaruh signifikan dalam disiplin rekayasa lainnya seperti teknik mesin, otomotif, dan layanan medis. Ditulis oleh Jeff Gray dan Bernhard Rumpe, artikel ini diterbitkan dalam jurnal Software & Systems Modeling pada tahun 2018, tepat ketika disiplin software engineering memasuki usia 50 tahun sejak Konferensi NATO tahun 1968 yang dianggap sebagai tonggak awal bidang ini.',
        'image' => 'gambar2.jpg',
    ],
    [
        'id' => 3,
        'title' => 'Benarkah IT Governance Dapat Meningkatkan Kinerja Organisasi?',
        'date' => '10 januari 2025',
        'content' => 'Dalam lanskap bisnis modern yang sarat teknologi, organisasi dituntut untuk tidak hanya mengadopsi TI, tetapi juga memastikan bahwa investasi teknologi tersebut memberikan nilai nyata. Banyak perusahaan telah mengimplementasikan berbagai sistem informasi, tetapi tidak semuanya menghasilkan dampak positif terhadap kinerja. Pertanyaannya: benarkah IT Governance dapat meningkatkan kinerja organisasi?',
        'image' => 'gambar3.jpg',
    ]
];

$quotes = [
    "terus maju dengan langkah yang pasti",
    "rintangan bukanlah penghalang tapi pengalaman",
    "kamu harus mengakhiri apa yang kamu mulai"
];
$selected_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$article = null;

if ($selected_id > 0) {
    foreach ($articles as $item) {
        if ($item['id'] === $selected_id) {
            $article = $item;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body class="bg-gray-300">
    <div class=" px-4 py-8">
        <header class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-800">BLOG BERITA</h1>
        </header>

        <?php if ($article): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                <div class="p-6">
                    <a href="?" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        kembsli
                    </a>
                    
                    <h2 class="text-2xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($article['title']) ?></h2>
                    <p class="text-gray-500 mb-4"><?= htmlspecialchars($article['date']) ?></p>
                    
                    <img src="<?= htmlspecialchars($article['image']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="w-full h-64 object-cover rounded-lg mb-6">
                    
                    <p class="text-gray-700 mb-6 leading-relaxed"><?= nl2br(htmlspecialchars($article['content'])) ?></p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">kata-kata hari ini</h3>
                <blockquote class="italic text-gray-700 border-l-4 border-blue-400 pl-4 py-2">
                    "<?= htmlspecialchars($quotes[array_rand($quotes)]) ?>"
                </blockquote>
            </div>
            
        <?php else: ?>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($articles as $item): ?>
                    <a href="?id=<?= $item['id'] ?>" class="article-card bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($item['title']) ?></h2>
                            <p class="text-gray-500 text-sm mb-3"><?= htmlspecialchars($item['date']) ?></p>
                            <p class="text-gray-600 line-clamp-3"><?= nl2br(htmlspecialchars($item['content'])) ?></p>
                            <div class="mt-4 text-blue-600 hover:text-blue-800 flex items-center">
                                Baca selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            
            <div class="mt-8 bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">kata-kata hari ini</h3>
                <blockquote class="italic text-gray-700 border-l-4 border-blue-400 pl-4 py-2">
                    "<?= htmlspecialchars($quotes[array_rand($quotes)]) ?>"
                </blockquote>
            </div>
            <div class="mt-8 flex justify-between">
            <a href="halaman2.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl">Kembali ke Profil</a>
            <a href="blog.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl">Menuju Blog</a>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>