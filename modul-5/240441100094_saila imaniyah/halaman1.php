<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil Interaktif Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 25px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type=text], textarea, select {
            width: 100%;
            padding: 6px;
            margin-top: 4px;
            margin-bottom: 10px;
        }
        .button {
            margin-top: 15px;
            padding: 8px 16px;
        }
        .hasil {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 2px solid #000;
        }
        .link {
            margin-top: 30px;
        }
        
    </style>
</head>
<body>

<h2>Profil Interaktif Mahasiswa</h2>

<table>
    <tr>
        <td><b>Nama</b></td>
        <td>Saila Imaniyah</td>
    </tr>
    <tr>
        <td><strong>NIM</strong></td>
        <td>240441100094</td>
    </tr>
    <tr>
        <td><strong>Tempat, Tanggal Lahir</strong></td>
        <td>Jombang, 29 Agustus 2006</td>
    </tr>
    <tr>
        <td><strong>Email</strong></td>
        <td>sailaaimann@gmail.com</td>
    </tr>
    <tr>
        <td><strong>Nomor HP</strong></td>
        <td>081515599235</td>
    </tr>
</table>

<form method="POST">
    <label>Bahasa Pemrograman yang Dikuasai:</label>
    <input type="text" name="bahasa[]">
    <input type="text" name="bahasa[]">
    <input type="text" name="bahasa[]">

    <label>Pengalaman Proyek Pribadi:</label>
    <textarea name="pengalaman" rows="4"></textarea>

    <label>Software yang Sering Digunakan:</label>
    <input type="checkbox" name="software[]" value="VS Code"> VS Code<br>
    <input type="checkbox" name="software[]" value="XAMPP"> XAMPP<br>
    <input type="checkbox" name="software[]" value="Git"> Git<br>

    <label>Sistem Operasi yang Digunakan:</label>
    <input type="radio" name="os" value="Windows"> Windows<br>
    <input type="radio" name="os" value="Linux"> Linux<br>
    <input type="radio" name="os" value="Mac"> Mac<br>

    <label>Tingkat Penguasaan PHP:</label>
    <select name="tingkat">
        <option value="">Pilih tingkat</option>
        <option value="Pemula">Pemula</option>
        <option value="Menengah">Menengah</option>
        <option value="Mahir">Mahir</option>
    </select>

    <br>
    <input type="submit" name="simpan" value="Simpan" class="button">
</form>

<?php
if (isset($_POST['simpan'])) {
    $bahasa = array_filter($_POST['bahasa']);
    $pengalaman =$_POST['pengalaman'];
    $software = isset($_POST['software']) ? $_POST['software'] : array();
    $os = isset($_POST['os']) ? $_POST['os'] : '';
    $tingkat = isset($_POST['tingkat']) ? $_POST['tingkat'] : '';

    if (count($bahasa) > 0 && $pengalaman != '' && count($software) > 0 && $os != '' && $tingkat != '') {

        $bahasaList = implode(', ', $bahasa);
        $softwareList = implode(', ', $software);
        ?>

        <div class='hasil'>
            <h3>Hasil Input:</h3>
            <table>
                <tr><td><strong>Bahasa Pemrograman</strong></td><td><?= $bahasaList ?></td></tr>
                <tr><td><strong>Software</strong></td><td><?= $softwareList ?></td></tr>
                <tr><td><strong>Sistem Operasi</strong></td><td><?= $os ?></td></tr>
                <tr><td><strong>Tingkat PHP</strong></td><td><?= $tingkat ?></td></tr>
            </table>
            <p><strong>Pengalaman Proyek:</strong><br><?=$pengalaman ?></p>

            <?php if (count($bahasa) > 2): ?>
                <p><b>Anda cukup berpengalaman dalam pemrograman!</b></p>
            <?php endif; ?>
        </div>

        <?php
    } else {
        echo "<p style='color: red; font-weight: bold;'>Semua input wajib diisi!</p>";
    }
}
?>


<div class="link">
    <a href="halaman2.php">Timeline</a>
    <a href="halaman3.php">Blog</a>
</div>

</body>
</html>
