<?php
session_start();
include 'koneksi.php'; 

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

$sql = "SELECT * FROM karyawan_absensi";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="src/index.css" rel="stylesheet" />
  <title>Welcome</title>
</head>
<body class="flex flex-col min-h-screen">

  <?php include "layout/ds.php" ?>

  <div>
    <h1>DATA ABSENSI KARYAWAN</h1>

    <div class="overflow-x-auto">
      <table>
        <thead>
          <tr>
            <th>Foto</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            $foto_path = "img/" . $row['nip'] . ".jpg";
            if (!file_exists($foto_path)) {
              $foto_path = "img/default.jpg";
            }

            echo "<tr>
                    <td><img src='{$foto_path}' alt='Foto' style='width:100px;height:110px;border-radius:15%;' /></td>
                    <td>{$row['nip']}</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['tanggal_absensi']}</td> 
                    <td>{$row['jam_masuk']}</td>
                    <td>{$row['jam_pulang']}</td>
                  </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    hamburger.addEventListener('click', () => {
      hamburger.classList.toggle('active');
      sidebar.classList.toggle('active');
      content.classList.toggle('shift');
    });
  </script>

</body>
<footer style="color: #1c0a0a; padding: 20px 0; text-align: center;">
  <p>&copy; 2025 siskaisn Website. All rights reserved.</p>
  <p>Contact: <a href="https://www.instagram.com/sissssskaaaaaisn?igsh=MTMxaG8zODQ2ZncybA==" style="color: #1c0a0a; text-decoration: underline;">@sissssskaaaaaisn</a></p>
</footer>

</html>
