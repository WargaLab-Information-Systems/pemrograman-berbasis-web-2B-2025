<?php
// Fungsi untuk mendapatkan kutipan motivasi acak
function getKutipanMotivasi() {
    $kutipan = [
        "Keberhasilan adalah kemampuan untuk melewati dan mengatasi dari satu kegagalan ke kegagalan berikutnya tanpa kehilangan semangat. - Winston Churchill asek",
        "Jangan pernah menyerah karena biasanya itu adalah kunci terakhir di pintu kesuksesan. - Zig Ziglar aesk lek",
        "Kesempatan tidak datang, Anda yang menciptakannya. - Chris Grosser asek bet lek",
        "Satu-satunya batasan untuk meraih mimpi adalah keraguan kita akan hari ini. - Franklin Roosevelt cakep pak",
        "Jika Anda tidak mengejar apa yang Anda inginkan, maka Anda tidak akan mendapatkannya. - Nora Roberts siap dan"
    ];
    return $kutipan[array_rand($kutipan)];
}

$artikel = [
    '1' => [
        'judul' => 'Pengalaman Belajar Pemrograman Web',
        'tanggal' => '2023-01-15',
        'refleksi' => 'Belajar pemrograman web membuka wawasan saya tentang bagaimana internet bekerja. Awalnya sulit memahami konsep client-server, tetapi dengan praktik terus menerus akhirnya bisa mengerti. Yang paling menantang adalah memahami asynchronous programming dengan JavaScript.',
        'gambar' => '1.png',
        'referensi' => 'https://developer.mozilla.org/en-US/'
    ],
    '2' => [
        'judul' => 'Tantangan Membuat Aplikasi Pertama',
        'tanggal' => '2023-03-22',
        'refleksi' => 'Membuat aplikasi pertama adalah pengalaman yang sangat berharga. Banyak bug yang muncul dan seringkali membuat frustasi, tetapi setiap masalah yang berhasil diselesaikan memberikan kepuasan tersendiri. Saya belajar bahwa debugging adalah skill yang sama pentingnya dengan menulis kode.',
        'gambar' => '2.png',
        'referensi' => 'https://stackoverflow.com/'
    ],
    '3' => [
        'judul' => 'Kolaborasi dalam Proyek Tim',
        'tanggal' => '2023-06-10',
        'refleksi' => 'Bekerja dalam tim mengajarkan saya tentang pentingnya komunikasi dan manajemen waktu. Menggunakan Git untuk kolaborasi awalnya membingungkan, tetapi sekarang saya menyadari betapa powerful-nya tools tersebut. Lesson learned: selalu buat branch terpisah untuk fitur baru!',
        'gambar' => '3.png',
        'referensi' => 'https://git-scm.com/'
    ]
];

$id = isset($_GET['id']) ? $_GET['id'] : null;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Reflektif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-5">Blog Reflektif</h1>
        
        <div class="row">
            <div class="col-md-8 mx-auto">
                <?php if ($id && isset($artikel[$id])): ?>
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h2><?= $artikel[$id]['judul'] ?></h2>
                            <small><?= date('d F Y', strtotime($artikel[$id]['tanggal'])) ?></small>
                        </div>
                        <div class="card-body">
                            <img src="images/<?= $artikel[$id]['gambar'] ?>" class="img-fluid rounded mb-3" alt="Ilustrasi">
                            <p><?= $artikel[$id]['refleksi'] ?></p>
                            
                            <div class="card bg-light mb-3">
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                        <p><?= getKutipanMotivasi() ?></p>
                                    </blockquote>
                                </div>
                            </div>
                            
                            <?php if (!empty($artikel[$id]['referensi'])): ?>
                                <div class="mt-3">
                                    <h5>Referensi:</h5>
                                    <a href="<?= $artikel[$id]['referensi'] ?>" target="_blank"><?= $artikel[$id]['referensi'] ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <a href="blog.php" class="btn btn-outline-secondary mb-4">Kembali ke Daftar Artikel</a>
                <?php else: ?>
                    <div class="list-group mb-4">
                        <?php foreach ($artikel as $key => $item): ?>
                            <a href="blog.php?id=<?= $key ?>" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?= $item['judul'] ?></h5>
                                    <small><?= date('d M Y', strtotime($item['tanggal'])) ?></small>
                                </div>
                                <p class="mb-1"><?= substr($item['refleksi'], 0, 100) ?>...</p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-outline-primary">Kembali ke Profil</a>
                    <a href="timeline.php" class="btn btn-outline-success">Lihat Timeline</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>