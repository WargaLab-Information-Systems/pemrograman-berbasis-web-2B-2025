<!-- profil.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Profil Interaktif Mahasiswa</title>
</head>
<body>
    <h1>Profil Interaktif Mahasiswa</h1>

    <table border="1">
        <tr><th>Nama</th><td>Ahmad Azizul Arif</td></tr>
        <tr><th>NIM</th><td>12345678</td></tr>
        <tr><th>Tempat, Tanggal Lahir</th><td>Bandung, 1 Januari 2000</td></tr>
        <tr><th>Email</th><td>ahmad@email.com</td></tr>
        <tr><th>Nomor HP</th><td>081234567890</td></tr>
    </table>

    <hr>
    <form method="post">
        <label>Bahasa Pemrograman:</label><br>
        <select name="bahasa[]" multiple size="4">
            <option value="Python">Python</option>
            <option value="Java">Java</option>
            <option value="PHP">PHP</option>
            <option value="C++">C++</option>
        </select><br><br>

        <label>Pengalaman Proyek:</label><br>
        <textarea name="pengalaman" rows="4" cols="50"></textarea><br><br>

        <label>Software yang Sering Digunakan:</label><br>
        <input type="checkbox" name="software[]" value="VS Code">VS Code
        <input type="checkbox" name="software[]" value="XAMPP">XAMPP
        <input type="checkbox" name="software[]" value="Git">Git
        <br><br>

        <label>Sistem Operasi:</label><br>
        <input type="radio" name="os" value="Windows">Windows
        <input type="radio" name="os" value="Linux">Linux
        <input type="radio" name="os" value="Mac">Mac
        <br><br>

        <label>Tingkat PHP:</label><br>
        <select name="tingkat">
            <option value="Pemula">Pemula</option>
            <option value="Menengah">Menengah</option>
            <option value="Mahir">Mahir</option>
        </select><br><br>

        <input type="submit" name="submit" value="Kirim">
    </form>

    <?php
    function validasi_input() {
        return isset($_POST['submit']) &&
               !empty($_POST['bahasa']) &&
               !empty($_POST['pengalaman']) &&
               !empty($_POST['software']) &&
               !empty($_POST['os']) &&
               !empty($_POST['tingkat']);
    }

    if (validasi_input()) {
        $bahasa = $_POST['bahasa'];
        $pengalaman = $_POST['pengalaman'];
        $software = $_POST['software'];
        $os = $_POST['os'];
        $tingkat = $_POST['tingkat'];

        echo "<hr><h3>Hasil Input:</h3>";
        echo "<table border='1'>";
        echo "<tr><td>Bahasa</td><td>" . implode(', ', $bahasa) . "</td></tr>";
        echo "<tr><td>Pengalaman</td><td>$pengalaman</td></tr>";
        echo "<tr><td>Software</td><td>" . implode(', ', $software) . "</td></tr>";
        echo "<tr><td>OS</td><td>$os</td></tr>";
        echo "<tr><td>Tingkat</td><td>$tingkat</td></tr>";
        echo "</table>";
        echo "<p><strong>Pengalaman Anda:</strong> $pengalaman</p>";
        if (count($bahasa) > 2) {
            echo "<p><strong>Anda cukup berpengalaman dalam pemrograman!</strong></p>";
        }
    } elseif (isset($_POST['submit'])) {
        echo "<p><strong>Semua input wajib diisi!</strong></p>";
    }
    ?>
    <br>
    <a href="timeline.php">Menuju Timeline</a>
</body>
</html>
