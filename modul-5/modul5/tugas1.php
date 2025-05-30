<?php

function validasiInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    
    $bahasa = isset($_POST['bahasa']) ? $_POST['bahasa'] : [];
    $pengalaman = validasiInput($_POST['pengalaman'] ?? '');
    $software = isset($_POST['software']) ? $_POST['software'] : [];
    $os = validasiInput($_POST['os'] ?? '');
    $php_level = validasiInput($_POST['php_level'] ?? '');

    if (empty($bahasa)) $errors[] = "Bahasa pemrograman harus diisi";
    if (empty($pengalaman)) $errors[] = "Pengalaman proyek harus diisi";
    if (empty($software)) $errors[] = "Software harus dipilih";
    if (empty($os)) $errors[] = "Sistem operasi harus dipilih";
    if (empty($php_level)) $errors[] = "Tingkat PHP harus dipilih";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Interaktif Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font">

  <header class="bg-white fixed top-0 left-0 w-full z-50 shadow-sm">
    <div class="px-8 flex justify-center items-center justify-between py-4">
      <div>
        <h1 class="text-2xl text-blue-700 font-bold">ProfilMhs.</h1>
      </div>
      
      <nav class="hidden md:flex space-x-8 items-center">
        <a href="#" class="text-blue-600 font-semibold">Profile</a>
        <a href="timeline.php" class="text-gray-600 hover:text-blue-600 transition-300">Experience</a>
        <a href="blog.php" class="text-gray-600 hover:text-blue-600 transition-300">Blog</a>
      </nav>

      <button class="md:text-gray-600">
        <i class="fas fa-bars text-xl"></i>
      </button>
    </div>
  </header>
  <main class="container max-w-5xl mx-auto px-4 py-8">
      
      <section class="mb-12 bg-white rounded-lg shadow-sm p-6 mt-20">
          <h2 class="text-xl font-semibold mb-4 text-gray-800">Data Diri</h2>
          <table class="min-w-full border-collapse">
              <tbody class="divide-y divide-gray-200">
                  <tr>
                      <td class="py-2 px-4 font-medium text-gray-700">Nama</td>
                      <td class="py-2 px-4">Adrian Ferdinand</td>
                  </tr>
                  <tr>
                      <td class="py-2 px-4 font-medium text-gray-700">NIM</td>
                      <td class="py-2 px-4">240441100023</td>
                  </tr>
                  <tr>
                      <td class="py-2 px-4 font-medium text-gray-700">Tempat, Tanggal Lahir</td>
                      <td class="py-2 px-4">Bangkalan, 09 Desember 2005</td>
                  </tr>
                  <tr>
                      <td class="py-2 px-4 font-medium text-gray-700">Email</td>
                      <td class="py-2 px-4">adrianferdinand540@gmail.com</td>
                  </tr>
                  <tr>
                      <td class="py-2 px-4 font-medium text-gray-700">Nomor HP</td>
                      <td class="py-2 px-4">+62 87864830002</td>
                  </tr>
              </tbody>
          </table>
      </section>

      <section class="mb-12 bg-white rounded-lg shadow-sm p-6">
          <h2 class="text-xl font-semibold mb-4 text-gray-800">Form Input</h2>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

              <div class="mb-4">
                  <label class="block text-gray-700 mb-2">Bahasa Pemrograman yang Dikuasai:</label>
                  <input type="text" name="bahasa[]" class="w-full p-2 border rounded text-sm mb-2" placeholder="Contoh: PHP">
                  <input type="text" name="bahasa[]" class="w-full p-2 border rounded text-sm mb-2" placeholder="Tambahkan bahasa lain">
                  <button type="button" id="tambahBahasa" class="bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-blue-700 transition">Tambah Bahasa</button>
              </div>

              <div class="mb-4">
                  <label class="block text-gray-700 mb-2">Pengalaman Proyek Pribadi:</label>
                  <textarea name="pengalaman" rows="4" class="w-full p-2 border rounded"></textarea>
              </div>

              <div class="mb-4">
                  <label class="block text-gray-700 mb-2">Software yang Sering Digunakan:</label>
                  <div class="flex flex-wrap gap-4">
                      <label class="inline-flex items-center">
                          <input type="checkbox" name="software[]" value="XAMPP" class="rounded text-blue-600">
                          <span class="ml-2 text-sm">XAMPP</span>
                      </label>
                      <label class="inline-flex items-center">
                          <input type="checkbox" name="software[]" value="VS Code" class="rounded text-blue-600">
                          <span class="ml-2 text-sm">VS Code</span>
                      </label>
                      <label class="inline-flex items-center">
                          <input type="checkbox" name="software[]" value="Git" class="rounded text-blue-600">
                          <span class="ml-2 text-sm">Git</span>
                      </label>
                      <label class="inline-flex items-center">
                          <input type="checkbox" name="software[]" value="Figma" class="rounded text-blue-600">
                          <span class="ml-2 text-sm">Figma</span>
                      </label>
                  </div>
              </div>

              <div class="mb-4">
                  <label class="block text-gray-700 mb-2">Sistem Operasi yang Digunakan:</label>
                  <div class="flex gap-4">
                      <label class="inline-flex items-center">
                          <input type="radio" name="os" value="Windows" class="text-blue-600">
                          <span class="ml-2 text-sm">Windows</span>
                      </label>
                      <label class="inline-flex items-center">
                          <input type="radio" name="os" value="Linux" class="text-blue-600">
                          <span class="ml-2 text-sm">Linux</span>
                      </label>
                      <label class="inline-flex items-center">
                          <input type="radio" name="os" value="Mac" class="text-blue-600">
                          <span class="ml-2 text-sm">Mac</span>
                      </label>
                  </div>
              </div>

              <div class="mb-4">
                  <label class="block text-gray-700 mb-2">Tingkat Penguasaan PHP:</label>
                  <select name="php_level" class="w-full p-2 border rounded">
                      <option value="">-- Pilih Tingkat --</option>
                      <option value="Pemula">Pemula</option>
                      <option value="Menengah">Menengah</option>
                      <option value="Mahir">Mahir</option>
                  </select>
              </div>

              <button type="submit" class="bg-green-600 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-green-700 transition">Submit</button>
          </form>
      </section>

      <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)): ?>

      <section class="mb-12 bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold mb-4 text-gray-800">Hasil Input</h2>
          
          <table class="min-w-full border-collapse mb-4">
              <tbody class="divide-y divide-gray-200">
                  <tr>
                      <td class="py-2 px-4 font-medium text-gray-700">Bahasa Pemrograman</td>
                      <td class="py-2 px-4"><?php echo implode(', ', $bahasa); ?></td>
                  </tr>
                  <tr>
                      <td class="py-2 px-4 font-medium text-gray-700">Software</td>
                      <td class="py-2 px-4"><?php echo implode(', ', $software); ?></td>
                  </tr>
                  <tr>
                      <td class="py-2 px-4 font-medium text-gray-700">Sistem Operasi</td>
                      <td class="py-2 px-4"><?php echo $os; ?></td>
                  </tr>
                  <tr>
                      <td class="py-2 px-4 font-medium text-gray-700">Tingkat PHP</td>
                      <td class="py-2 px-4"><?php echo $php_level; ?></td>
                  </tr>
              </tbody>
          </table>

          <h3 class="text-lg font-medium mb-2 text-gray-800">Pengalaman Proyek:</h3>
          <p class="mb-4 text-gray-700"><?php echo nl2br($pengalaman); ?></p>

          <?php if (count($bahasa) > 2): ?>
          <div class="bg-green-100 border-l-4 border-green-500 p-4">
              <p class="text-green-700">Anda cukup berpengalaman dalam pemrograman!</p>
          </div>
          <?php endif; ?>
      </section>
      <?php elseif (!empty($errors)): ?>

      <section class="mb-12 bg-red-50 rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold mb-4 text-red-800">Error</h2>
          <ul class="list-disc pl-5 text-red-700">
              <?php foreach ($errors as $error): ?>
              <li><?php echo $error; ?></li>
              <?php endforeach; ?>
          </ul>
      </section>
      <?php endif; ?>

      <nav class="flex justify-between">
        <div></div>
        <a href="tugas2.php" class="bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-blue-700 transition">Menuju Timeline Pengalaman</a>
      </nav>
  </main>

  <script>

      document.getElementById('tambahBahasa').addEventListener('click', function() {
          const div = document.createElement('div');
          div.className = 'flex mb-2';
          div.innerHTML = `
              <input type="text" name="bahasa[]" class="flex-1 p-2 border rounded">
              <button type="button" class="ml-2 bg-red-500 text-white px-2 rounded hover:bg-red-600 hapus-bahasa">×</button>
          `;
          this.parentNode.insertBefore(div, this);
          

          div.querySelector('.hapus-bahasa').addEventListener('click', function() {
              div.remove();
          });
      });
  </script>
</body>
</html>
