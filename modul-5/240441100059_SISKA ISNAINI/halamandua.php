<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="src/output.css" rel="stylesheet">
  <title>pengalaman</title>
</head>

<body>
  <nav>
    <div class="hamburger" onclick="toggleMenu()">
      <div></div>
      <div></div>
      <div></div>
    </div>

    <div class="menu-kanan">
        <a href="#pglmn">PENGALAMAN</a>
    </div>

    <div class="menu hidden" id="nav-menu">
      <a href="index.php">PROFILE</a>
      <a href="halamantiga.php">BLOG</a>
    </div>
  </nav>

<div class="garis"></div>

   <section id="pglmn" class="pengalaman-container">
<?php
    $pengalaman = [
      [
        "tahun" => "2024",
        "judul" => "Keterima Kuliah Jalur SNBP",
        "deskripsi" => "Bahagia sih sebenernya keterima, cuman agak ruwet juga beljar di lingkunganbaru apalagi masuk ke jurusan yang dibidang teknologi."
      ],
      [
        "tahun" => "2025",
        "judul" => "setengah perjalanan (?)",
        "deskripsi" => "Udah mulai tergonjang ganjing sama matakuliahnya, muak sama tugasya. walaupun begitu teteap aku kerjakan i lov u jurusankanku."
      ],
      [
        "tahun" => "sekarang",
        "judul" => "idk",
        "deskripsi" => "yeah i'm did it, did i did tolongin did."
      ]
    ];

    echo '<div style="color:white; display: flex; flex-direction: column; gap: 10px; font-size: 25px; padding: 10px;">';
    foreach ($pengalaman as $item) {
      echo "<div>
        <strong>{$item['tahun']}</strong><br>
        <em>{$item['judul']}</em><br>
        <span>{$item['deskripsi']}</span>
      </div><hr>";
    }
    echo '</div>';
?>

    </section>

<script>
  function toggleMenu() {
    const menu = document.getElementById("nav-menu");
    menu.classList.toggle("show");
  }
</script>
</body>


<footer style="background-color: #16162f; color: white; padding: 20px 0; text-align: center;">
  <p>&copy; 2025 siskaisn Website. All rights reserved.</p>
  <p>Contact: <a href="https://www.instagram.com/sissssskaaaaaisn?igsh=MTMxaG8zODQ2ZncybA==" style="color: white; text-decoration: underline;">@sissssskaaaaaisn</a></p>
</footer>

</html>

