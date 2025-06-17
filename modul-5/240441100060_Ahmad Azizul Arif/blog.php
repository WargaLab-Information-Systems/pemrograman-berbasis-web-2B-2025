<!-- blog.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Blog Reflektif</title>
</head>
<body>
    <h1>Blog Reflektif</h1>

    <?php
    $artikel = [
        "artikel1" => ["judul" => "Belajar Koding Pertama Kali", "tanggal" => "2025-03-01", "isi" => "Saya memulai perjalanan pemrograman dari Python..."],
        "artikel2" => ["judul" => "Debugging yang Menantang", "tanggal" => "2025-03-15", "isi" => "Debugging mengajarkan saya ketekunan dan logika..."],
        "artikel3" => ["judul" => "Membangun Web Portofolio", "tanggal" => "2025-04-01", "isi" => "Proyek pribadi ini membantu saya memahami frontend..."]
    ];

    $kutipan = [
        "Semangat adalah bahan bakar sukses.",
        "Gagal sekali bukan akhir dunia.",
        "Belajar dari kesalahan adalah kunci.",
        "Koding butuh kesabaran dan ketekunan."
    ];

    function tampilArtikel($key, $data, $kutipan) {
        $rand = rand(0, count($kutipan) - 1);
        echo "<h2>{$data['judul']}</h2>";
        echo "<small>{$data['tanggal']}</small><br><br>";
        echo "<p>{$data['isi']}</p>";
        echo "<img src='img/ilustrasi.jpg' width='300'><br><br>";
        echo "<blockquote><em>{$kutipan[$rand]}</em></blockquote>";
        echo "<p><a href='blog.php'>Kembali ke daftar</a></p>";
    }

    if (isset($_GET['artikel']) && array_key_exists($_GET['artikel'], $artikel)) {
        tampilArtikel($_GET['artikel'], $artikel[$_GET['artikel']], $kutipan);
    } else {
        echo "<ul>";
        foreach ($artikel as $key => $data) {
            echo "<li><a href='blog.php?artikel=$key'>{$data['judul']}</a></li>";
        }
        echo "</ul>";
    }
    ?>

    <br>
    <a href="timeline.php">Kembali ke Timeline</a>
</body>
</html>
