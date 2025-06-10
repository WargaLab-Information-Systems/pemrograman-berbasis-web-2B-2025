<?php
include "../koneksi.php";


if (isset($_POST['simpan'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jabatan = $_POST['jabatan'];
    $departemen = $_POST['departemen'];
    $asal_kota = $_POST['asal_kota'];

    $query = "INSERT INTO karyawan_absensi (nip, nama, umur, jenis_kelamin, jabatan, departemen, asal_kota)
              VALUES ('$nip', '$nama', '$umur', '$jenis_kelamin', '$jabatan', '$departemen', '$asal_kota')";
    mysqli_query($conn, $query);
    header("Location: daftar.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM karyawan_absensi");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Karyawan</title>
<link rel="stylesheet" href="../src/edit.css" />
</head>

<body>
<a href="../pengaturan.php" class="btn-back">Kembali</a>

    <div class="container">

        <table>
            <tr>
                <th>NIP</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Departemen</th>
                <th>Asal Kota</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['nip']) ?></td>
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
                  echo "<span style='color: #aaa;'>Tidak ada</span>";
              }
            ?>
                    </td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['umur']) ?></td>
                    <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                    <td><?= htmlspecialchars($row['jabatan']) ?></td>
                    <td><?= htmlspecialchars($row['departemen']) ?></td>
                    <td><?= htmlspecialchars($row['kota_asal']) ?></td>
                    <td class="actions">
                    <form action="ubah.php" method="GET" style="display:inline;">
                        <input type="hidden" name="nip" value="<?= htmlspecialchars($row['nip']) ?>">
                        <button type="submit" class="btn-edit">Edit</button>
                    </form>
                    
                    <form action="delete.php" method="GET" style="display:inline;" onsubmit="return confirm('Yakin mau dihapus data ini?')">
                        <input type="hidden" name="nip" value="<?= htmlspecialchars($row['nip']) ?>">
                        <button type="submit" class="btn-delete">Hapus</button>
                    </form>
                    </td>

                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
<footer style="color: #1c0a0a; padding: 20px 0; text-align: center;">
  <p>&copy; 2025 siskaisn Website. All rights reserved.</p>
  <p>Contact: <a href="https://www.instagram.com/sissssskaaaaaisn?igsh=MTMxaG8zODQ2ZncybA==" style="color: #1c0a0a; text-decoration: underline;">@sissssskaaaaaisn</a></p>
</footer>

</html>
