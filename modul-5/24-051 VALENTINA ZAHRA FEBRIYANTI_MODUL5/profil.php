<?php
function tampilkanData($data) {
    echo "<div class='max-w-3xl mx-auto mt-8'>";
    echo "<div class='bg-white border p-6 rounded shadow'>"; // Kotak tunggal untuk semua konten

    echo "<img src='foto biru.jpg' class='rounded mb-6 h-32 w-full object-contain' alt='Foto Mahasiswa'>";

    // Data Diri (Statis)
    echo "<h2 class='text-xl font-bold mb-4 text-center text-blue-600'>Data Diri Mahasiswa</h2>";
    echo "<table class='w-full table-auto border mb-6'>";
    $labels = [
        'Nama' => 'Valentina Zahra Febriyanti',
        'NIM' => '240441100051',
        'Tempat, Tanggal Lahir' => 'Lamongan, 13 Februari 2006',
        'Email' => 'valentinazahra@gmail.com',
        'Nomor HP' => '081524871650'
    ];
    foreach ($labels as $label => $val) {
        echo "<tr><th class='text-left p-2 border bg-gray-100'>$label</th><td class='p-2 border'>$val</td></tr>";
    }
    echo "</table>";

    echo "<h2 class='text-xl font-bold mb-4 text-center text-blue-600'>Hasil Isian Form</h2>";

    $bahasa = array_filter($data['bahasa']);
    echo "<p><strong>Bahasa Pemrograman:</strong> " . implode(', ', array_map('htmlspecialchars', $bahasa)) . "</p>";
    if (count($bahasa) >= 2) {
        echo "<p class='mt-4 text-green-600 font-semibold'>Anda cukup berpengalaman dalam pemrograman!</p>";
    }

    // Pengalaman
    echo "<p class='mt-4'><strong>Pengalaman Proyek:</strong><br>" . nl2br(htmlspecialchars($data['pengalaman'])) . "</p>";

    // Software
    $software = isset($data['software']) ? $data['software'] : [];
    echo "<p class='mt-4'><strong>Software:</strong> " . implode(', ', array_map('htmlspecialchars', $software)) . "</p>";

    echo "<p><strong>Sistem Operasi:</strong> " . htmlspecialchars($data['os']) . "</p>";
    echo "<p><strong>Tingkat PHP:</strong> " . htmlspecialchars($data['php_level']) . "</p>";

    echo "<a href='profil.php' class='inline-block mt-6 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600'>Kembali</a>";

    echo "</div>"; // tutup kotak tunggal
    echo "</div>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Profil Interaktif Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function validateForm() {
            const f = document.forms["profilForm"];
            const bahasa = f.querySelectorAll("input[name='bahasa[]']");
            const pengalaman = f["pengalaman"].value.trim();
            const software = f.querySelectorAll("input[name='software[]']:checked");
            const os = f.querySelector("input[name='os']:checked");
            const php_level = f["php_level"].value;

            let adaBahasa = false;
            for (let b of bahasa) {
                if (b.value.trim() !== "") {
                    adaBahasa = true;
                    break;
                }
            }

            if (!adaBahasa) {
                alert("Masukkan minimal satu bahasa pemrograman.");
                return false;
            }

            if (!pengalaman || software.length === 0 || !os || !php_level) {
                alert("Semua kolom wajib diisi!");
                return false;
            }

            return true;
        }
    </script>
</head>
<body style="background-color: #FF8FB1;" class="min-h-screen">

<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-2xl font-bold text-center mb-6">Profil Interaktif Mahasiswa</h1>

    <!-- Navigasi -->
    <nav class="flex justify-center space-x-6 mb-8">
        <a href="profil.php" style="color: #850E35;" class="font-semibold hover:underline">Profil</a>
        <a href="timeline.php" style="color: #850E35;" class="font-semibold hover:underline">Timeline</a>
        <a href="blog.php" style="color: #850E35;" class="font-semibold hover:underline">Blog</a>
    </nav>

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <?php tampilkanData($_POST); ?>
    <?php else: ?>
        <!-- Data Diri (Statis) -->
        <div class="bg-white border p-6 rounded shadow mb-6">
            <img src="foto biru.jpg" class="rounded mb-6 h-32 w-full object-contain" alt="Foto Mahasiswa">
            <h2 class="text-xl font-bold mb-4 text-center text-blue-600">Data Diri Mahasiswa</h2>
            <table class="w-full table-auto border">
                <tr><th class="text-left p-2 border bg-gray-100">Nama</th><td class="p-2 border">Valentina Zahra Febriyanti</td></tr>
                <tr><th class="text-left p-2 border bg-gray-100">NIM</th><td class="p-2 border">240441100051</td></tr>
                <tr><th class="text-left p-2 border bg-gray-100">Tempat, Tanggal Lahir</th><td class="p-2 border">Lamongan, 13 Februari 2006</td></tr>
                <tr><th class="text-left p-2 border bg-gray-100">Email</th><td class="p-2 border">valentinazahra@gmail.com</td></tr>
                <tr><th class="text-left p-2 border bg-gray-100">Nomor HP</th><td class="p-2 border">081524871650</td></tr>
            </table>
        </div>

        <!-- Form Dinamis -->
        <div class="bg-white border p-6 rounded shadow">
            <form name="profilForm" method="post" action="profil.php" onsubmit="return validateForm()" class="space-y-4">
                <div>
                    <label class="block font-medium">Bahasa Pemrograman (minimal 1):</label>
                    <input type="text" name="bahasa[]" class="w-full p-2 border rounded mb-1" placeholder="Contoh: PHP">
                    <input type="text" name="bahasa[]" class="w-full p-2 border rounded mb-1">
                    <input type="text" name="bahasa[]" class="w-full p-2 border rounded">
                </div>

                <div>
                    <label class="block font-medium">Pengalaman Proyek:</label>
                    <textarea name="pengalaman" rows="4" class="w-full p-2 border rounded" placeholder="Ceritakan proyek pribadi Anda..."></textarea>
                </div>

                <div>
                    <label class="block font-medium">Software yang Sering Digunakan (bisa lebih dari satu):</label>
                    <?php
                    $tools = ['VS Code', 'XAMPP', 'Git'];
                    foreach ($tools as $t) {
                        echo "<label class='block'><input type='checkbox' name='software[]' value='$t' class='mr-2'> $t</label>";
                    }
                    ?>
                </div>

                <div>
                    <label class="block font-medium">Sistem Operasi:</label>
                    <label><input type="radio" name="os" value="Windows" class="mr-2"> Windows</label><br>
                    <label><input type="radio" name="os" value="Linux" class="mr-2"> Linux</label><br>
                    <label><input type="radio" name="os" value="Mac" class="mr-2"> Mac</label>
                </div>

                <div>
                    <label class="block font-medium">Tingkat Penguasaan PHP:</label>
                    <select name="php_level" class="w-full p-2 border rounded">
                        <option value="">-- Pilih --</option>
                        <option value="Pemula">Pemula</option>
                        <option value="Menengah">Menengah</option>
                        <option value="Mahir">Mahir</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">Submit</button>
                </div>
            </form>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
