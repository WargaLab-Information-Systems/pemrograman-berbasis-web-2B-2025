<?php
$artikel = [
    1 => ['judul' => 'Refleksi Harian', 'tanggal' => '2025-05-20'],
    2 => ['judul' => 'Belajar dari Kegagalan', 'tanggal' => '2025-05-18'],
    3 => ['judul' => 'Menjadi Lebih Baik', 'tanggal' => '2025-05-15'],
];

function headerNavigasi() {
    echo '<nav class="mb-4"><a href="index.php" class="text-blue-600 hover:underline">🏠 Beranda</a></nav>';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Blog Reflektif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">📝 Daftar Artikel Reflektif</h1>
        <?php headerNavigasi(); ?>
        <ul class="space-y-4">
            <?php foreach ($artikel as $id => $data): ?>
                <li class="bg-white shadow-sm rounded-lg p-4 hover:shadow-md transition">
                    <a href="artikel.php?id=<?= $id ?>" class="text-xl font-medium text-blue-700 hover:underline">
                        <?= $data['judul'] ?>
                    </a>
                    <div class="text-sm text-gray-500"><?= $data['tanggal'] ?></div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
