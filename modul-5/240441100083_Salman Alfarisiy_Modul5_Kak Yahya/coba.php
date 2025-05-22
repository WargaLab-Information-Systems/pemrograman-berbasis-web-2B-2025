<?php
    $nama = "salman alfarisiy";
    $hp = "0881026424304";
    $nim = 240441100083;
    $ttl = "lamongan 22 juli 2006";
    $email = "salman123@gmail.com";

    $bahasa = $project = $software = $os = $php_proficiency = '';
    $errors = [];
    $mahir_message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['bahasa'])) $errors[] = "Bahasa pemrograman harus diisi";
        if (empty($_POST['project'])) $errors[] = "Pengalaman proyek harus diisi";
        if (empty($_POST['software'])) $errors[] = "Pilih minimal satu software";
        if (empty($_POST['os'])) $errors[] = "Pilih sistem operasi";
        if (empty($_POST['php_proficiency'])) $errors[] = "Pilih tingkat penguasaan PHP";

        if (empty($errors)) {
            $bahasa = htmlspecialchars($_POST['bahasa'] ?? '');
            $project = nl2br(htmlspecialchars($_POST['project'] ?? ''));
            $software = isset($_POST['software']) ? implode(", ", $_POST['software']) : 'Tidak ada';
            $os = htmlspecialchars($_POST['os'] ?? 'Tidak dipilih');
            $php_proficiency = htmlspecialchars($_POST['php_proficiency'] ?? '');
            
            $software_count = isset($_POST['software']) ? count($_POST['software']) : 0;
            if ($software_count >= 2) {
                $mahir_message = "<p style='color: green;'>Anda cukup mahir!</p>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil interaktif</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-300 text-center items-center justify-between">
    <center>
    <h1 class= "font-bold text-[30px] text-center text-blue-500">PROFIL INTERAKTIF</h1>
    <div class= "border-2 border-dashed border-blue-500 rounded-lg p-4 text-center justify-center w-[700px]">
    <table class="text-center">
        <tr class= "bg-blue-500 text-white border-3 text-center">
            <th>Nama</th>
            <th>NIM</th>
            <th>Tempat Tanggal Lahir</th>
            <th>Email</th>
            <th>Nomor HP</th>
        </tr>
        <tr class= "bg-blue-500 text-white border-3">
            <td><?php echo $nama; ?></td>
            <td><?php echo $nim; ?></td>
            <td><?php echo $ttl; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $hp; ?></td>
        </tr>
    </table>
    </div>
    
   
    <?php
    if (!empty($errors)) {
        echo '<div style="color: red; margin: 10px 0;">';
        foreach ($errors as $error) {
            echo "<p>- $error</p>";
        }
        echo '</div>';
    }
    ?>

    <form method="post" action="">
        <label for="bahasa">Bahasa pemrograman yang dikuasai:</label><br>
        <input class="bg-white border-black rounded-lg" type="text" id="bahasa" name="bahasa" value="<?php echo $bahasa; ?>"><br>
        <br>
        
        <label for="project">Penjelasan singkat tentang pengalaman membuat proyek pribadi</label><br>
        <textarea class="bg-white border-black rounded-lg" id="project" name="project" rows="4" cols="50" 
        placeholder="Contoh: saya pernah membuat projrct yang berkiyan dengan database"><?php echo $project; ?></textarea><br>

        <p>Software yang sering digunakan:</p>
        <input type="checkbox" id="vscode" name="software[]" value="vscode" <?php echo (isset($_POST['software']) && in_array('vscode', $_POST['software'])) ? 'checked' : ''; ?>>
        <label for="vscode">vscode</label><br>
        <input type="checkbox" id="netbeans" name="software[]" value="netbeans" <?php echo (isset($_POST['software']) && in_array('netbeans', $_POST['software'])) ? 'checked' : ''; ?>>
        <label for="netbeans">netbeans</label><br>
        <input type="checkbox" id="notepad" name="software[]" value="notepad++" <?php echo (isset($_POST['software']) && in_array('notepad++', $_POST['software'])) ? 'checked' : ''; ?>>
        <label for="notepad">notepad++</label><br>
        
        <p>Pilih sistem operasi yang kamu gunakan:</p>
        <input type="radio" id="windows" name="os" value="windows" <?php echo (isset($_POST['os']) && $_POST['os'] == 'windows') ? 'checked' : ''; ?>>
        <label for="windows">windows</label><br>
        <input type="radio" id="linux" name="os" value="linux" <?php echo (isset($_POST['os']) && $_POST['os'] == 'linux') ? 'checked' : ''; ?>>
        <label for="linux">linux</label><br>
        <input type="radio" id="macos" name="os" value="macOS" <?php echo (isset($_POST['os']) && $_POST['os'] == 'macOS') ? 'checked' : ''; ?>>
        <label for="macos">macOS</label><br>

        <label for="php-proficiency">Tingkat penguasaan PHP:</label>
        <select id="php-proficiency" name="php_proficiency">
            <option value="pemula" <?php echo (isset($_POST['php_proficiency']) && $_POST['php_proficiency'] == 'pemula') ? 'selected' : ''; ?>>pemula</option>
            <option value="menengah" <?php echo (isset($_POST['php_proficiency']) && $_POST['php_proficiency'] == 'menengah') ? 'selected' : ''; ?>>menengah</option>
            <option value="suhu" <?php echo (isset($_POST['php_proficiency']) && $_POST['php_proficiency'] == 'suhu') ? 'selected' : ''; ?>>suhu</option>
        </select><br>

        <input class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl" type="submit" value="Submit">
    </form>
    <div class="mt-8 flex justify-between">
            <a href="halaman2.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl">halaman ke 2</a>
            <a href="blog.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl">blog</a>
        </div>


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)) {
        if (!empty($mahir_message)) {
            echo $mahir_message;
        }
        
        echo "<h3>Hasil Form dalam Tabel:</h3>";
        echo "<table border='1' cellpadding='5' cellspacing='0' style='margin-bottom: 20px;'>
                <tr>
                    <th>daftar</th>
                    <th>isi</th>
                </tr>
                <tr>
                    <td>bahasa Pemrograman</td>
                    <td>$bahasa</td>
                </tr>
                <tr>
                    <td>Pengalaman Proyek</td>
                    <td>$project</td>
                </tr>
                <tr>
                    <td>Software</td>
                    <td>$software</td>
                </tr>
                <tr>
                    <td>Sistem Operasi</td>
                    <td>$os</td>
                </tr>
                <tr>
                    <td>Penguasaan PHP</td>
                    <td>$php_proficiency</td>
                </tr>
              </table>";
        echo "<h3>Hasil dalam Paragraf:</h3>";
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;'>
                <p><strong>Bahasa Pemrograman:</strong> $bahasa</p>
                <p><strong>Pengalaman Proyek:</strong><br> $project</p>
                <p><strong>Software yang digunakan:</strong> $software</p>
                <p><strong>Sistem Operasi:</strong> $os</p>
                <p><strong>Tingkat Penguasaan PHP:</strong> $php_proficiency</p>
              </div>";
    }
    ?>
    </center>
</body>
</html>