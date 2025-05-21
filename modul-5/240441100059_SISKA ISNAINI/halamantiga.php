<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="src/output.css" rel="stylesheet">
  <title>Blog</title>
</head>

<body>
  <nav>
    <div class="hamburger" onclick="toggleMenu()">
      <div></div>
      <div></div>
      <div></div>
    </div>

    <div class="menu-kanan">
      <a href="#blg">BLOG</a>
    </div>

    <div class="menu hidden" id="nav-menu">
      <a href="index.php">PROFILE</a>
      <a href="halamantiga.php">PENGALAMAN</a>
    </div>
  </nav>

  <div class="garis"></div>

  <section id="blg" class="blog-container">
    <?php
    $articles = array(
      1 => [
        "judul" => "Apa Itu PHP?",
        "tanggal" => "05-01-2024",
        "refleksi" => "PHP adalah singkatan dari Hypertext Preprocessor, yakni sebuah bahasa scripting yang dibuat oleh Rasmus Lerdorf pada tahun 1994 untuk membuat halaman, website, aplikasi web, dan Graphical User Interface (GUI). Bahasa ini bersifat open-source sehingga siapa pun dapat menggunakannya secara gratis.",
        "gambar" => "img/logo.png",
        "kutipan" => [
          "Pemrograman adalah seni untuk memecahkan masalah dengan kode.",
        ],
        "sumber" => "https://www.dewaweb.com/blog/apa-itu-php/",
      ],
      2 => [
        "judul" => "Bagaimana Cara Menggunakan PHP?",
        "tanggal" => "2025-05-18",
        "refleksi" => "Pada tutorial ini, kita akan belajar dasar-dasar pemrograman PHP sehingga kamu akan paham gimana cara coding di PHP.",
        "gambar" => "img/coding.png",
        "kutipan" => [
          "Praktik langsung adalah cara terbaik belajar programming.",
          "Setiap kode kecil membawa kamu lebih dekat jadi programmer.",
        ],
        "sumber" => "https://www.petanikode.com/tutorial/php/",
      ],
      3 => [
        "judul" => "Kegunaan PHP dalam Pengembangan Web",
        "tanggal" => "01-05-2022",
        "refleksi" => "Menggunakan PHP dengan CGI memungkinkan Anda memperbarui aplikasi dengan cepat tanpa menghapus seluruh server HTTP. Manfaat besar lainnya menggunakan Tapi PHP masih bahasa scripting. Dan seperti dalam konteks CGI, PHP memiliki eksekusi baru setiap permintaan, ini tampak jelas bahwa sifat paling terukur PHP juga merupakan salah satu hambatan kinerja yang paling relevan.",
        "gambar" => "img/gamabar3.png",
        "kutipan" => [
          "Web dinamis adalah masa depan internet.",
          "Database dan PHP adalah pasangan yang tak terpisahkan.",
        ],
        "sumber" => "https://idcloudhost.com/blog/php-adalah/",
      ],
    );

    if (isset($_GET['id']) && isset($articles[$_GET['id']])) {
      $id = $_GET['id'];
      $article = $articles[$id];
    ?>
    <div style="color:white; display: flex; flex-direction: column; gap: 15px; font-size: 20px; padding: 20px;">
    <h2 class="text-white"><?= $article['judul'] ?></h2>

    <img src="<?= $article['gambar'] ?>" alt="Ilustrasi PHP" style="width: 300px; height: auto; margin-top: 10px; border-radius: 10px;">
    <small><em><?= $article['tanggal'] ?></em></small>
    <p><?= $article['refleksi'] ?></p>
  
    <?php foreach ($article['kutipan'] as $kutipan): ?>
      <blockquote style="margin-top: 15px; font-style: italic; background: #2a2a2a; padding: 10px; border-left: 4px solid #ccc;">
        <?= $kutipan ?>
      </blockquote>
    <?php endforeach; ?>
    <p>Sumber: 
      <a href="<?= $article['sumber'] ?>" style="color: lightblue;" target="_blank"><?= $article['sumber'] ?></a>
    </p>
    <a href="halamantiga.php" style="margin-top: 10px; color: white;">← Kembali ke daftar artikel</a>
</div>
    <?php
} else {
?>
      <div style="display: flex; flex-direction: column; gap: 25px; max-width: 900px; margin: 0 auto; padding: 70px 30px; font-size: 30px;">
        <h2 style="color: white;">Daftar Artikel</h2>
        <?php foreach ($articles as $id => $article): ?>
          <a href="?id=<?= $id ?>" 
             style="
              display: block; 
              padding: 12px 20px; 
              background-color: #16162f;
              color: white; 
              text-decoration: none; 
              border-radius: 8px; 
              transition: background-color 0.3s;"
             onmouseover="this.style.backgroundColor='#666';" 
             onmouseout="this.style.backgroundColor='#16162f';">
            <?= htmlspecialchars($article['judul']) ?>
          </a>
        <?php endforeach; ?>
      </div>
    <?php } ?>
  </section>

  <script>
    function toggleMenu() {
      const menu = document.getElementById("nav-menu");
      menu.classList.toggle("show");
    }
  </script>

  <footer style="background-color: #16162f; color: white; padding: 20px 0; text-align: center;">
  <p>&copy; 2025 siskaisn Website. All rights reserved.</p>
  <p>Contact: <a href="https://www.instagram.com/sissssskaaaaaisn?igsh=MTMxaG8zODQ2ZncybA==" style="color: white; text-decoration: underline;">@sissssskaaaaaisn</a></p>
</footer>

</body>
</html>
