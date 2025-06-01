<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>
<body>
    <div >
        <a href="halaman2.php">Timeline</a>
        <a href="halaman1.php">Profil</a>
    </div>
    <?php
$artikelList = [
    [
        'id' => 1,
        'judul' => 'Tips Mahasiswa Belajar Efektif',
        'tanggal' => '2024-11-10',
    ],
    [
        'id' => 2,
        'judul' => 'Cara Belajar Efektif dan Efisien Dari Sisi Pandang Psikologi',
        'tanggal' => '2025-01-15',
    ],
    [
        'id' => 3,
        'judul' => 'Manfaat dan Kerugian AI bagi Pelajar dalam Dunia Pendidikan',
        'tanggal' => '2024-07-16',
    ],
];
?>

    <h1><center>Daftar Artikel</center></h1>
    <ul>
        <?php foreach ($artikelList as $artikel): ?>
            <li>
                <a href="artikel.php?id=<?= $artikel['id'] ?>">
                    <?= $artikel['judul'] ?> (<?= $artikel['tanggal'] ?>)
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    
</body>
</html>