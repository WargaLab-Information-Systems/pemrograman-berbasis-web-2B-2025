<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM karyawan_absensi");

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Data Karyawan</title>
  <link rel="stylesheet" href="../src/form.css">
  <style>
  table {
  width: 100%;
  border-collapse: collapse;
  box-shadow: 0 2px 8px rgba(85, 13, 8, 0.3);
  border-radius: 8px;
  overflow: hidden;
}

thead {
  background-color: #550d08;
  color: #f8ecac;
}

thead th {
  padding: 12px 15px;
  text-transform: uppercase;
  font-weight: 600;
}

tbody tr:nth-child(even) {
  background-color: #fff3c6;
}


tbody td {
  padding: 12px 15px;
  text-align: center;
  color: #1c0a0a;
}


    img {
      width: 80px;
      height: 100px;
      object-fit: cover;
      border-radius: 8px;
      border: 2px solid #550d08;
    }

    h1 {
      text-align: center;
      margin-top: 30px;
      color: #550d08;
    }


.btn-back {
  display: inline-block;
  padding: 10px 18px;
  background-color: #550d08;
  color: #f8ecac;
  text-decoration: none;
  border-radius: 6px;
  font-weight: 700;
  box-shadow: 0 3px 6px rgba(85, 13, 8, 0.4);
  transition: background-color 0.3s ease;
  margin-bottom: 20px;
  cursor: pointer;
}

.btn-back:hover {
  background-color: #7b110c;
}
button {
  width: auto !important;
  padding: 8px 12px !important;
  display: inline-block !important;
}

  </style>
</head>
<body>

<a href="../pengaturan.php" class="btn-back">Kembali</a>

  <h1>Daftar Data Karyawan</h1>

  <table>
    <thead>
      <tr>
        <th>Foto</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>Umur</th>
        <th>Jenis Kelamin</th>
        <th>Jabatan</th>
        <th>Departemen</th>
        <th>Asal Kota</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
          <td>
            <?php
              $nip = $row['nip'];
              $fotoPathJpg = "../img/$nip.jpg";
              $fotoPathPng = "../img/$nip.png";
              if (file_exists($fotoPathJpg)) {
                  echo "<img src='$fotoPathJpg' alt='Foto $nip'>";
              } elseif (file_exists($fotoPathPng)) {
                  echo "<img src='$fotoPathPng' alt='Foto $nip'>";
              } else {
                  echo "<span style='color: #aaa;'>takde foto</span>";
              }
            ?>
          </td>
          <td><?= htmlspecialchars($row['nip']) ?></td>
          <td><?= htmlspecialchars($row['nama']) ?></td>
          <td><?= htmlspecialchars($row['umur']) ?></td>
          <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
          <td><?= htmlspecialchars($row['jabatan']) ?></td>
          <td><?= htmlspecialchars($row['departemen']) ?></td>
          <td><?= htmlspecialchars($row['kota_asal']) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

</body>
<footer style="color: #1c0a0a; padding: 20px 0; text-align: center;">
  <p>&copy; 2025 siskaisn Website. All rights reserved.</p>
  <p>Contact: <a href="https://www.instagram.com/sissssskaaaaaisn?igsh=MTMxaG8zODQ2ZncybA==" style="color: #1c0a0a; text-decoration: underline;">@sissssskaaaaaisn</a></p>
</footer>

</html>
