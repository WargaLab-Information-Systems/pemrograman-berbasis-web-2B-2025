<?php
$artikel = [
    1 => [
        'judul' => 'Refleksi Harian',
        'tanggal' => '2025-05-20',
        'isi' => 'Mulai hari ini saya melakukan sebuah hal yang sangat berharga, memulai hidup sehat yang konsisten. Hal sulit dan berat bagi sebagian orang tapi tidak bagi orang yang ingin hidupnya lebih baik. Maka dari itu kita perlu menjadi bagian dari sebagian orang tersebut',
        'gambar' => 'refleksi.webp',
        'sumber' => 'refleksi.webp'
    ],
    2 => [
        'judul' => 'Belajar dari Kegagalan',
        'tanggal' => '2025-05-18',
        'isi' => 'Kegagalan mengajarkan saya bahwa setiap proses punya makna, seperti kata pepatah bahwa kegagalan adalah awal dari kesuksesan. Gagal adalah sebuah proses untuk mencapai kesuksesan',
        'gambar' => 'gagal.jpg',
        'sumber' => 'kegagalan'
    ],
    3 => [
        'judul' => 'Menjadi Lebih Baik',
        'tanggal' => '2025-05-15',
        'isi' => 'Perbaikan diri dimulai dari keberanian untuk berubah menjadi lebih baik dari hari kemarin. Kalau tidak hari ini kapan lagi kan?Kemarin adalah kemarin dan sekarang adalah sekarang, maka lakukan yang terbaik untuk sekarang dan hari selanjutnya.',
        'gambar' => 'lebih.png',
        'sumber' => 'lebih.png'
    ]
];

$kutipan = [
    "Jangan menunggu waktu yang tepat, karena waktu tidak akan pernah tepat.",
    "Setiap langkah kecil hari ini adalah kemajuan besar di masa depan.",
    "Gagal itu biasa, bangkit itu luar biasa.",
    "Refleksi adalah jembatan menuju perbaikan diri."
];

function headerNavigasi() {
    echo '<nav class="mb-4"><a href="halaman3.php" class="text-blue-600 hover:underline">← Kembali ke Beranda</a></nav>';
}

$id = $_GET['id'] ?? null;
$konten = $artikel[$id] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $konten ? $konten['judul'] : 'Artikel Tidak Ditemukan' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <div class="max-w-3xl mx-auto p-6">
        <?php headerNavigasi(); ?>
        <?php if ($konten): ?>
            <h2 class="text-3xl font-bold mb-2"><?= $konten['judul'] ?></h2>
            <p class="text-sm text-gray-500 mb-4">Diposting pada <?= $konten['tanggal'] ?></p>
            <p class="mb-6"><?= $konten['isi'] ?></p>
            <img src="<?= $konten['gambar'] ?>" alt="Ilustrasi" class="rounded-lg shadow-md mb-6 max-w-full">
            <blockquote class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 italic rounded mb-6">
                <?= $kutipan[rand(0, count($kutipan)-1)] ?>
            </blockquote>
            <?php if ($konten['sumber']): ?>
                <p class="text-sm">Sumber: <a href="<?= $konten['sumber'] ?>" class="text-blue-600 hover:underline" target="_blank"><?= $konten['sumber'] ?></a></p>
            <?php endif; ?>
        <?php else: ?>
            <p class="text-red-500 font-semibold">Artikel tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</body>
</html>
