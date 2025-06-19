<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Form Mahasiswa</h2>
        <form method="POST" action="">
            <input type="text" name="nama" placeholder="Nama Mahasiswa" required>
            <input type="text" name="asal" placeholder="Asal Daerah" required>
            <button type="submit" name="simpan">Simpan Data</button>
        </form>
    </div>

    <?php
    if (isset($_POST['simpan'])) {
        $nama = $_POST['nama'];
        $asal = $_POST['asal'];
        $query = "INSERT INTO mhs (nama, asal) VALUES ('$nama', '$asal')";
        mysqli_query($conn, $query);
        header("Location: index.php");
    }

    $result = mysqli_query($conn, "SELECT * FROM mhs");
    ?>

    <div class="container">
        <h2>Data Mahasiswa</h2>
        <div class="table-container">
            <table>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Asal</th>
                    <th>Aksi</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $row['nim'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['asal'] ?></td>
                    <td class="actions">
                        <a href="edit.php?nim=<?= $row['nim'] ?>" class="btn-edit">Edit</a>
                        <a href="delete.php?nim=<?= $row['nim'] ?>"
                            onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn-delete">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>

</html>