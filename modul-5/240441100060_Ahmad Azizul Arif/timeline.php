<!-- timeline.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Timeline Pengalaman Kuliah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
    <h1 class="text-2xl font-bold mb-4">Timeline Pengalaman Kuliah</h1>

    <div class="border-l-4 border-blue-500 pl-4">
        <?php
        $pengalaman = [
            "Semester 1" => "Belajar dasar pemrograman dan algoritma.",
            "Semester 2" => "Membuat proyek web statis dan belajar basis data.",
            "Semester 3" => "Proyek e-commerce, belajar Java dan OOP.",
            "Semester 4" => "Magang di perusahaan software lokal."
        ];

        function tampilkanTimeline($data) {
            foreach ($data as $semester => $detail) {
                echo "<div class='mb-4'>";
                echo "<h2 class='text-blue-700 font-semibold'>$semester</h2>";
                echo "<p class='text-gray-700'>$detail</p>";
                echo "</div>";
            }
        }

        tampilkanTimeline($pengalaman);
        ?>
    </div>

    <div class="mt-6">
        <a href="index.php" class="text-blue-600 hover:underline mr-4">Kembali ke Profil</a>
        <a href="blog.php" class="text-blue-600 hover:underline">Menuju Blog</a>
    </div>
</body>
</html>
