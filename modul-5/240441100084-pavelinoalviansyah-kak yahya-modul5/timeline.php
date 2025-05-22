<?php
// Fungsi untuk memformat tanggal
function formatTanggal($date) {
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    $tanggal = date('j', strtotime($date));
    $bulan = $bulan[(int)date('n', strtotime($date))];
    $tahun = date('Y', strtotime($date));
    return "$tanggal $bulan $tahun";
}

$pengalaman = [
    [
        'judul' => 'Memulai Perkuliahan',
        'tanggal' => '2020-09-01',
        'deskripsi' => 'Memulai perkuliahan di jurusan Teknik Informatika dengan semangat dan harapan tinggi.'
    ],
    [
        'judul' => 'Belajar Pemrograman Dasar',
        'tanggal' => '2020-10-15',
        'deskripsi' => 'Mempelajari dasar-dasar pemrograman menggunakan bahasa C dan Python.'
    ],
    [
        'judul' => 'Proyek Pertama',
        'tanggal' => '2021-03-20',
        'deskripsi' => 'Menyelesaikan proyek pertama membuat aplikasi kalkulator sederhana.'
    ],
    [
        'judul' => 'Magang Pertama',
        'tanggal' => '2022-07-01',
        'deskripsi' => 'Melakukan magang di perusahaan startup sebagai web developer junior.'
    ],
    [
        'judul' => 'Proyek Akhir Semester',
        'tanggal' => '2022-12-10',
        'deskripsi' => 'Menyelesaikan proyek akhir semester dengan membuat sistem informasi perpustakaan.'
    ]
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Pengalaman Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .timeline {
            position: relative;
            padding-left: 50px;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #dee2e6;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -40px;
            top: 5px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #0d6efd;
            border: 3px solid #fff;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-5">Timeline Pengalaman Kuliah</h1>
        
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="timeline">
                    <?php foreach ($pengalaman as $item): ?>
                        <div class="timeline-item">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5><?= $item['judul'] ?></h5>
                                    <small><?= formatTanggal($item['tanggal']) ?></small>
                                </div>
                                <div class="card-body">
                                    <p><?= $item['deskripsi'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="d-flex justify-content-between mt-5">
                    <a href="index.php" class="btn btn-outline-primary">Kembali ke Profil</a>
                    <a href="blog.php" class="btn btn-outline-success">Menuju Blog</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>