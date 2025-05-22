<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Timeline Pengalaman Kuliah</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-300">
    <div class=" p-6 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-500">Timeline Pengalaman Kuliah</h1>

        <div class="border-l-4 pl-4 space-y-6">
            <?php
            $pengalaman = [
                [
                    "bulan" => "agustus",
                    "konteks" => "masuk kuliah",
                    "deskripsi" => "mulai masuk kuliah dengan dengan mengikuti ospek dan masuk ukm."
                ],
                [
                    "bulan" => "september",
                    "konteks" => "mata kuliah",
                    "deskripsi" => "mulai mengikuti mata kuliah pada semester satu."
                ],
                [
                    "bulan" => "oktober ",
                    "konteks" => "praktikum",
                    "deskripsi" => "mengikuti praktikum untuk pertamakalinya pada semester satu."
                ],
                [
                    "bulan" => "november",
                    "konteks" => "makasi",
                    "deskripsi" => "membuat acara untuk satu angkatan dan menjadi salah satu panitia."
                ],
                [
                    "bulan" => "desember ",
                    "konteks" => "uas",
                    "deskripsi" => "mengikuti uas untuk pertmak kalinnya"
                ]
            ];

            foreach ($pengalaman as $item) {
                echo '
                <div class="relative pl-6">
                    <div class="absolute left-0 top-1.5 w-3 h-3 rounded-full"></div>
                    <h3 class="text-lg font-semibold">' . $item["bulan"] . ' - ' . $item["konteks"] . '</h3>
                    <p class="text-gray-600">' . $item["deskripsi"] . '</p>
                </div>';
            }
            ?>
        </div>

        <div class="mt-8 flex justify-between">
            <a href="coba.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl">Kembali ke Profil</a>
            <a href="blog.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl">Menuju Blog</a>
        </div>
    </div>
</body>
</html>