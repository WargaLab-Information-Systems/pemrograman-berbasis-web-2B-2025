



<?php
    $nama = "SISKA ISNAINI";
    $nim = "240441100059";
    $tempat_lahir = "JEDDAH ARAB SAUDI";
    $tanggal_lahir = "06-02-2006";
    $email = "siskaisnaini24@gmail.com";
    $no_hp = "0822-1234-5678";
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="src/output.css" rel="stylesheet">
  <title>Profile Mahasiswa </title>
</head>

<body>
  <nav>
    <div class="hamburger" onclick="toggleMenu()">
      <div></div>
      <div></div>
      <div></div>
    </div>

    <div class="menu-kanan">
        <a href="#profil">  PROFILE</a>
        <a href="#form">FORM</a>
    </div>

    <div class="menu hidden" id="nav-menu">
      <a href="halamandua.php">PENGALAMAN</a>
      <a href="halamantiga.php">BLOG</a>
    </div>
  </nav>

<div class="garis"></div>

    <section id="profil" class="profil-container">
        <div class="profil-content">
                <img src="img/sy.png" alt="Foto Profil" class="foto-profil">
            <div class="profil-info">
                <p>NAMA: <?= $nama ?></p>
                <p>NIM: <?= $nim ?></p>
                <p>TTL: <?= $tempat_lahir ?> <?= $tanggal_lahir ?></p>
                <p>EMAIL: <?=$email?></p>
                <p>NO HANDPHONE: <?=$no_hp?></p>
            </div>
        </div>
    </section>


<div class="garis"></div>

   <section id="form" class="profil-container">
        <h2 class="profil-title"></h2>
        <div class="profil-info">
    <form action="index.php" method="POST">

        <div class="left">
            <label for="bahasa">Bahasa pemrograman yang dikuasai</label>
            <input type="text" id="bahasa" name="bahasa[]" placeholder="Misal: JavaScript" />
            <input type="text" name="bahasa[]" placeholder="Tambah lagi jika ada" />
            <input type="text" name="bahasa[]" placeholder="Tambah lagi jika ada" />

            <label for="pengalaman">Pengalaman membuat proyek pribadi</label>
            <textarea id="pengalaman" name="pengalaman" placeholder="Jelaskan pengalamanmu"></textarea>
        </div>

        <div class="right">
            <p>Software yang sering digunakan</p>
            <div class="checkbox-group">
                <label><input type="checkbox" name="software[]" value="VS Code" /> VSCode</label>
                <label><input type="checkbox" name="software[]" value="XAMPP" /> XAMPP</label>
                <label><input type="checkbox" name="software[]" value="Git" /> Git</label>
            </div>

            <p>Sistem operasi yang digunakan</p>
            <div class="radio-group">
                <label><input type="radio" name="os" value="Windows" /> Windows</label>
                <label><input type="radio" name="os" value="Linux" /> Linux</label>
                <label><input type="radio" name="os" value="Mac" /> Mac</label>
            </div>

            <label for="tingkat_php">Tingkat penguasaan PHP</label>
            <select id="tingkat_php" name="tingkat_php">
                <option value="">Pilih tingkat</option>
                <option value="Pemula">Pemula</option>
                <option value="Menengah">Menengah</option>
                <option value="Mahir">Mahir</option>
            </select>

            <button type="submit" name="submit">Submit</button>
        </div>
    </form>
</section>

<div class="garis"></div>

<script>
  function toggleMenu() {
    const menu = document.getElementById("nav-menu");
    menu.classList.toggle("show");
  }
</script>


</body>

<?php 
if (isset($_POST['submit'])) {
    $bahasa = isset($_POST['bahasa']) ? array_filter($_POST['bahasa']) : [];
    $pengalaman = $_POST['pengalaman'];
    $software = isset($_POST['software']) ? $_POST['software'] : [];
    $os = isset($_POST['os']) ? $_POST['os'] : '';
    $tingkat_php = $_POST['tingkat_php'];

    if (empty($nama) || empty($bahasa) || empty($pengalaman) || empty($software) || empty($os) || empty($tingkat_php)) {
        echo "<p style='background-color: #16162f; color: white; padding: 10px;text-align: center;'>diisi dulu ngab.</p>";
    } else {
    echo "<div style='background-color: #16162f; color: white; padding: 15px; text-align: center;'>";
    echo "<h2 style='color: white;'>Hasil Input:</h2>";
    echo "<table border='1' cellpadding='5' cellspacing='0' style='border-color: white; color: white; margin: 0 auto; border-collapse: collapse;'>";
    echo "<tr><td style='text-align: left; padding: 8px;'>Nama</td><td style='text-align: left; padding: 8px;'>$nama</td></tr>";
    echo "<tr><td style='text-align: left; padding: 8px;'>Bahasa Pemrograman</td><td style='text-align: left; padding: 8px;'>" . implode(", ", $bahasa) . "</td></tr>";
    echo "<tr><td style='text-align: left; padding: 8px;'>Pengalaman</td><td style='text-align: left; padding: 8px;'>$pengalaman</td></tr>";
    echo "<tr><td style='text-align: left; padding: 8px;'>Software</td><td style='text-align: left; padding: 8px;'>" . implode(", ", $software) . "</td></tr>";
    echo "<tr><td style='text-align: left; padding: 8px;'>Sistem Operasi</td><td style='text-align: left; padding: 8px;'>$os</td></tr>";
    echo "<tr><td style='text-align: left; padding: 8px;'>Tingkat PHP</td><td style='text-align: left; padding: 8px;'>$tingkat_php</td></tr>";
    echo "</table>";
    
    
    if (count($bahasa) > 2) {
        echo "<p style='background-color: #16162f; color: white; padding: 10px; margin-top: 15px; text-align: center;'><em>Anda cukup berpengalaman dalam pemrograman!</em></p>";
    }
    
    echo "</div>";
    }
}
?>


<footer style="background-color: #16162f; color: white; padding: 20px 0; text-align: center;">
  <p>&copy; 2025 siskaisn Website. All rights reserved.</p>
  <p>Contact: <a href="https://www.instagram.com/sissssskaaaaaisn?igsh=MTMxaG8zODQ2ZncybA==" style="color: white; text-decoration: underline;">@sissssskaaaaaisn</a></p>
</footer>

</html>