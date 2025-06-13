<!-- <?php
    // echo "Bismillah Sukses Dunia Akhirat!!!";
    // echo "HIDUP JOKOWI !!!";
    // $nama = "Galih";
    // $nim = 240441100105;
    // $tinggi = 170;

    // echo "<br><br>";
    // echo "nama saya $nama, Nim saya $nim, Tinggi saya $tinggi";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Selamat Datang  //<?php echo $nama ?> 
</h1>
</body>
</html> -->

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Timeline Pengalaman Kuliah</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0; padding: 0;
      background-color: #f4f4f4;
    }
    .container {
      width: 80%;
      margin: auto;
      padding: 30px 0;
    }
    h2 {
      text-align: center;
      color: #333;
    }
    .timeline {
      position: relative;
      margin-top: 40px;
      padding-left: 20px;
      border-left: 4px solid #007BFF;
    }
    .timeline-item {
      margin-bottom: 30px;
      position: relative;
      padding-left: 20px;
    }
    .timeline-item::before {
      content: '';
      position: absolute;
      left: -11px;
      top: 0;
      width: 20px;
      height: 20px;
      background-color: #007BFF;
      border-radius: 50%;
    }
    .timeline-item h4 {
      margin: 0;
      color: #007BFF;
    }
    .timeline-item p {
      margin: 5px 0 0;
      color: #333;
    }
    .buttons {
      text-align: center;
      margin-top: 40px;
    }
    .buttons a {
      text-decoration: none;
      background-color: #007BFF;
      color: white;
      padding: 10px 20px;
      margin: 0 10px;
      border-radius: 5px;
      transition: background 0.3s;
    }
    .buttons a:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Timeline Pengalaman Kuliah</h2>
    <div class="timeline">
      <?php
        $pengalamanKuliah = [
          ["tahun" => "2023", "kegiatan" => "Memulai kuliah di Universitas Trunojoyo Madura"],
          ["tahun" => "2024", "kegiatan" => "Mengikuti organisasi BEM dan aktif dalam kegiatan kampus"],
          ["tahun" => "2025", "kegiatan" => "Magang di perusahaan teknologi lokal"],
          ["tahun" => "2026", "kegiatan" => "Mengerjakan skripsi dan penelitian bersama dosen"],
        ];

        foreach ($pengalamanKuliah as $item) {
          echo "<div class='timeline-item'>";
          echo "<h4>{$item['tahun']}</h4>";
          echo "<p>{$item['kegiatan']}</p>";
          echo "</div>";
        }
      ?>
    </div>

    <div class="buttons">
      <a href="profil.php">Kembali ke Profil</a>
      <a href="blog.php">Menuju Blog</a>
    </div>
  </div>
</body>
</html>
