<?php
// Fungsi untuk memvalidasi dan memproses input
function prosesInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Fungsi untuk menampilkan pesan error
function tampilkanError($pesan) {
    return '<div class="alert alert-danger">'.$pesan.'</div>';
}

$errors = [];
$success = false;
$nama = $nim = $tempat_lahir = $tanggal_lahir = $email = $no_hp = '';
$bahasa = $proyek = $os = $php_level = '';
$bahasa_array = [];
$software_array = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input wajib
    if (empty($_POST["nama"])) {
        $errors[] = "Nama wajib diisi";
    } else {
        $nama = prosesInput($_POST["nama"]);
    }
    
    if (empty($_POST["nim"])) {
        $errors[] = "NIM wajib diisi";
    } else {
        $nim = prosesInput($_POST["nim"]);
    }
    
    if (empty($_POST["tempat_lahir"])) {
        $errors[] = "Tempat lahir wajib diisi";
    } else {
        $tempat_lahir = prosesInput($_POST["tempat_lahir"]);
    }
    
    if (empty($_POST["tanggal_lahir"])) {
        $errors[] = "Tanggal lahir wajib diisi";
    } else {
        $tanggal_lahir = prosesInput($_POST["tanggal_lahir"]);
    }
    
    if (empty($_POST["email"])) {
        $errors[] = "Email wajib diisi";
    } else {
        $email = prosesInput($_POST["email"]);
    }
    
    if (empty($_POST["no_hp"])) {
        $errors[] = "Nomor HP wajib diisi";
    } else {
        $no_hp = prosesInput($_POST["no_hp"]);
    }
    
    // Proses bahasa pemrograman
    if (!empty($_POST["bahasa"])) {
        $bahasa = $_POST["bahasa"];
        $bahasa_array = explode(",", $bahasa);
    } else {
        $errors[] = "Bahasa pemrograman wajib diisi";
    }
    
    $proyek = prosesInput($_POST["proyek"]);
    
    if (empty($_POST["software"])) {
        $errors[] = "Pilih minimal satu software";
    } else {
        $software_array = $_POST["software"];
    }
    
    if (empty($_POST["os"])) {
        $errors[] = "Pilih sistem operasi";
    } else {
        $os = prosesInput($_POST["os"]);
    }
    
    if (empty($_POST["php_level"])) {
        $errors[] = "Pilih tingkat penguasaan PHP";
    } else {
        $php_level = prosesInput($_POST["php_level"]);
    }
    
    if (empty($errors)) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Interaktif Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .timeline {
            position: relative;
            padding-left: 50px;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #dee2e6;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -40px;
            top: 5px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #0d6efd;
            border: 3px solid #fff;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Profil Interaktif Mahasiswa</h1>
        
        <div class="row">
            <div class="col-md-6 mx-auto">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h3>Data Diri</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama</th>
                                    <td><?= $nama ?></td>
                                </tr>
                                <tr>
                                    <th>NIM</th>
                                    <td><?= $nim ?></td>
                                </tr>
                                <tr>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <td><?= $tempat_lahir ?>, <?= $tanggal_lahir ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= $email ?></td>
                                </tr>
                                <tr>
                                    <th>Nomor HP</th>
                                    <td><?= $no_hp ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h3>Data Tambahan</h3>
                        </div>
                        <div class="card-body">
                            <h5>Bahasa Pemrograman yang Dikuasai:</h5>
                            <ul>
                                <?php foreach ($bahasa_array as $b): ?>
                                    <li><?= trim($b) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            
                            <?php if (count($bahasa_array) > 2): ?>
                                <div class="alert alert-info">
                                    Anda cukup berpengalaman dalam pemrograman!
                                </div>
                            <?php endif; ?>
                            
                            <h5 class="mt-3">Pengalaman Proyek:</h5>
                            <p><?= $proyek ?></p>
                            
                            <h5>Software yang Digunakan:</h5>
                            <ul>
                                <?php foreach ($software_array as $s): ?>
                                    <li><?= $s ?></li>
                                <?php endforeach; ?>
                            </ul>
                            
                            <h5>Sistem Operasi:</h5>
                            <p><?= $os ?></p>
                            
                            <h5>Tingkat Penguasaan PHP:</h5>
                            <p><?= $php_level ?></p>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-4">
                        <a href="timeline.php" class="btn btn-outline-primary">Lihat Timeline Pengalaman</a>
                        <a href="blog.php" class="btn btn-outline-success">Lihat Blog Reflektif</a>
                    </div>
                <?php else: ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h3>Data Diri</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama ?>">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim" value="<?= $nim ?>">
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $tempat_lahir ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $tanggal_lahir ?>">
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">Nomor HP</label>
                                    <input type="tel" class="form-control" id="no_hp" name="no_hp" value="<?= $no_hp ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white">
                                <h3>Data Tambahan</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="bahasa" class="form-label">Bahasa Pemrograman yang Dikuasai (pisahkan dengan koma)</label>
                                    <input type="text" class="form-control" id="bahasa" name="bahasa" value="<?= $bahasa ?>" placeholder="Contoh: PHP, JavaScript, Python">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="proyek" class="form-label">Pengalaman Membuat Proyek Pribadi</label>
                                    <textarea class="form-control" id="proyek" name="proyek" rows="3"><?= $proyek ?></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Software yang Sering Digunakan</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="software[]" id="vscode" value="VS Code">
                                        <label class="form-check-label" for="vscode">VS Code</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="software[]" id="xampp" value="XAMPP">
                                        <label class="form-check-label" for="xampp">XAMPP</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="software[]" id="git" value="Git">
                                        <label class="form-check-label" for="git">Git</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="software[]" id="figma" value="Figma">
                                        <label class="form-check-label" for="figma">Figma</label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Sistem Operasi yang Digunakan</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="os" id="windows" value="Windows" <?= ($os == 'Windows') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="windows">Windows</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="os" id="linux" value="Linux" <?= ($os == 'Linux') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="linux">Linux</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="os" id="mac" value="Mac OS" <?= ($os == 'Mac OS') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="mac">Mac OS</label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="php_level" class="form-label">Tingkat Penguasaan PHP</label>
                                    <select class="form-select" id="php_level" name="php_level">
                                        <option value="">Pilih tingkat penguasaan</option>
                                        <option value="Pemula" <?= ($php_level == 'Pemula') ? 'selected' : '' ?>>Pemula</option>
                                        <option value="Menengah" <?= ($php_level == 'Menengah') ? 'selected' : '' ?>>Menengah</option>
                                        <option value="Mahir" <?= ($php_level == 'Mahir') ? 'selected' : '' ?>>Mahir</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>