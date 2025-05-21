<?php
$pengalaman = [
    [
        'tahun' => '2024',
        'judul' => 'Masuk Kuliah',
        'deskripsi' => 'Memulai perjalanan kuliah dengan semangat tinggi dan rasa penasaran.'
    ],
    [
        'tahun' => '2025',
        'judul' => 'Bergabung UKM',
        'deskripsi' => 'Mulai aktif di Unit Kegiatan Mahasiswa dan mengenal banyak teman baru.'
    ],
    [
        'tahun' => '2026',
        'judul' => 'Magang Pertama',
        'deskripsi' => 'Mendapat pengalaman kerja nyata di perusahaan teknologi lokal.'
    ],
    [
        'tahun' => '2027',
        'judul' => 'Skripsi dan Seminar',
        'deskripsi' => 'Mulai menyusun skripsi dan mengikuti berbagai seminar penelitian.'
    ],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Timeline Pengalaman Kuliah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8 text-center">Timeline Pengalaman Kuliah</h1>

        <div class="relative border-l-4 border-blue-500 pl-6 space-y-8">
            <?php foreach ($pengalaman as $item): ?>
                <div class="group">
                    <div class="absolute -left-2.5 mt-1 w-5 h-5 bg-blue-500 rounded-full border-4 border-white"></div>
                    <div>
                        <h2 class="text-xl font-semibold"><?= $item['tahun'] ?> - <?= $item['judul'] ?></h2>
                        <p class="text-gray-600"><?= $item['deskripsi'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-10 flex justify-between">
            <a href="index.php" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition">
                ← Kembali ke Profil
            </a>
            <a href="halaman3.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Blog →
            </a>
        </div>
    </div>
</body>
</html>
