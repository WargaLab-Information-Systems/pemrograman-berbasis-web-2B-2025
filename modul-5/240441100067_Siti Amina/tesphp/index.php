<?php
function tampilkanHasil($data) {
    $data['bahasa'] = array_filter($data['bahasa'], fn($b) => trim($b) !== '');
    echo "<div class='max-w-4xl mx-auto mt-10'>";
    echo "<h2 class='text-2xl font-bold mb-4'>Hasil Input:</h2>";
    echo "<table class='w-full table-auto border border-gray-300 bg-white shadow-sm'>";
    echo "<tr class='bg-gray-100'><th class='text-left p-2'>Bahasa Dikuasai</th><td class='p-2'>" . implode(", ", $data['bahasa']) . "</td></tr>";
    echo "<tr><th class='text-left p-2'>Pengalaman</th><td class='p-2'>" . htmlspecialchars($data['pengalaman']) . "</td></tr>";
    echo "<tr><th class='text-left p-2'>Software</th><td class='p-2'>" . implode(", ", $data['software']) . "</td></tr>";
    echo "<tr><th class='text-left p-2'>Sistem Operasi</th><td class='p-2'>" . $data['os'] . "</td></tr>";
    echo "<tr><th class='text-left p-2'>Penguasaan PHP</th><td class='p-2'>" . $data['tingkat'] . "</td></tr>";
    echo "</table>";

    echo "<p class='mt-4 text-gray-700'><strong>Pengalaman Proyek:</strong> " . htmlspecialchars($data['pengalaman']) . "</p>";

    if (count($data['bahasa']) > 2) {
        echo "<p class='text-green-600 text-center mt-4'><em>Anda cukup berpengalaman dalam pemrograman!</em></p>";
    }

    echo "</div>";
}

if (isset($_POST['submit'])) {
    if (
        !empty($_POST['bahasa']) &&
        !empty($_POST['pengalaman']) &&
        !empty($_POST['software']) &&
        !empty($_POST['os']) &&
        !empty($_POST['tingkat'])
    ) {
        tampilkanHasil($_POST);
    } else {
        echo "<p class='text-red-500 font-medium text-center mt-6'>Semua input wajib diisi!</p>";
    }
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Profil Interaktif Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans p-6">

<!-- Navigasi -->
<nav class="bg-white shadow p-4 mb-6">
    <div class="max-w-6xl mx-auto flex justify-between items-center">
        <div class="text-xl font-bold text-amber-700">Profil Interaktif Mahasiswa</div>
        <div class="space-x-4">
            <a href="index.php" class="text-gray-700 hover:text-blue-600">Profil</a>
            <a href="halaman2.php" class="text-gray-700 hover:text-blue-600">Timeline</a>
            <a href="halaman3.php" class="text-gray-700 hover:text-blue-600">Blog</a>
        </div>
    </div>
</nav>
<!-- Tabel Data Diri -->
<h2 class="text-2xl font-bold text-center mb-4">Data Diri</h2>
<table class="w-full max-w-4xl mx-auto mb-8 bg-white shadow border border-gray-400 border-collapse">
    <tr class="bg-amber-100">
        <th class="p-2 font-semibold border border-gray-400 w-1/3 text-left">Nama</th>
        <td class="p-2 border border-gray-400">SITI AMINA</td>
    </tr>
    <tr class="bg-amber-100">
        <th class="p-2 font-semibold border border-gray-400 text-left">NIM</th>
        <td class="p-2 border border-gray-400">240441100067</td>
    </tr>
    <tr class="bg-amber-100">
        <th class="p-2 font-semibold border border-gray-400 text-left">Tempat, Tanggal Lahir</th>
        <td class="p-2 border border-gray-400">Bangkalan, 20 Mei 2006</td>
    </tr>
    <tr class="bg-amber-100">
        <th class="p-2 font-semibold border border-gray-400 text-left">Email</th>
        <td class="p-2 border border-gray-400">aminahhh@gmail.com</td>
    </tr>
    <tr class="bg-amber-100">
        <th class="p-2 font-semibold border border-gray-400 text-left">Nomor HP</th>
        <td class="p-2 border border-gray-400">081234567890</td>
    </tr>
</table>


<!-- Form Input -->
<h2 class="text-2xl font-bold text-center mb-4">Form Isian</h2>
<form method="POST" class="space-y-6 w-full max-w-4xl mx-auto bg-white p-8 rounded shadow">
    <!-- Bahasa Pemrograman -->
    <div>
        <label class="block mb-2 font-semibold">Bahasa Pemrograman yang Dikuasai:</label>
        <div class="flex gap-2">
            <input type="text" id="bahasaInput" class="flex-1 border border-gray-300 rounded p-2">
            <button type="button" onclick="tambahBahasa()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah</button>
        </div>
        <ul id="daftarBahasa" class="list-disc pl-5 mt-2 text-sm text-gray-700"></ul>
        <div id="bahasaHiddenInputs"></div>
    </div>

    <!-- Pengalaman -->
    <div>
        <label class="block mb-2 font-semibold">Pengalaman Membuat Proyek:</label>
        <textarea name="pengalaman" rows="4" class="w-full border border-gray-300 rounded p-2"></textarea>
    </div>

    <!-- Software -->
    <div>
        <label class="block mb-2 font-semibold">Software yang Sering Digunakan:</label>
        <div class="space-x-4">
            <label><input type="checkbox" name="software[]" value="VS Code"> VS Code</label>
            <label><input type="checkbox" name="software[]" value="XAMPP"> XAMPP</label>
            <label><input type="checkbox" name="software[]" value="Git"> Git</label>
            <label><input type="checkbox" name="software[]" value="Sublime"> Sublime</label>
        </div>
    </div>

    <!-- Sistem Operasi -->
    <div>
        <label class="block mb-2 font-semibold">Sistem Operasi:</label>
        <div class="space-x-4">
            <label><input type="radio" name="os" value="Windows"> Windows</label>
            <label><input type="radio" name="os" value="Linux"> Linux</label>
            <label><input type="radio" name="os" value="Mac"> Mac</label>
        </div>
    </div>

    <!-- Penguasaan -->
    <div>
        <label class="block mb-2 font-semibold">Tingkat Penguasaan PHP:</label>
        <select name="tingkat" class="w-full border border-gray-300 rounded p-2">
            <option value="">-- Pilih --</option>
            <option value="Pemula">Pemula</option>
            <option value="Menengah">Menengah</option>
            <option value="Mahir">Mahir</option>
        </select>
    </div>

    <div>
        <input type="submit" name="submit" value="Kirim" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
    </div>
</form>



<script>
function tambahBahasa() {
    const input = document.getElementById('bahasaInput');
    const value = input.value.trim();
    if (value !== "") {
        const list = document.getElementById('daftarBahasa');
        const hiddenDiv = document.getElementById('bahasaHiddenInputs');

        const li = document.createElement('li');
        li.textContent = value;
        list.appendChild(li);

        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'bahasa[]';
        hidden.value = value;
        hiddenDiv.appendChild(hidden);

        input.value = ""; 
    }
}
</script>

</body>
</html>
