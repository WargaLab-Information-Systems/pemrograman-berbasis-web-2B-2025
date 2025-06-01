<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Pengalaman Kuliah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class='mx-12'>
    <h1 class="text-3xl font-bold text-center mb-8 text-blue-700">Timeline Pengalaman Kuliah</h1>
    <div class="w-full flex justify-center items-center">
    <div class="max-w-7xl mx-auto w-full grid grid-cols-9 px-2">
        <?php
        $timeline = [
            [
                "tahun" => "2024",
                "kegiatan" => "Masuk kuliah dan mengikuti orientasi mahasiswa baru."
            ],
            [
                "tahun" => "2024",
                "kegiatan" => "Mulai belajar dasar-dasar pemrograman."
            ],
            [
                "tahun" => "2024",
                "kegiatan" => "Mengikuti organisasi."
            ],
            [
                "tahun" => "2025",
                "kegiatan" => "belajar pemrograman berbasis web."
            ],
        ];

        foreach ($timeline as $index => $event) {
            $left = $index % 2 === 0; 
        ?>

            <?php if ($left): ?>
                <div class="col-span-4 w-full h-full">
                    <div class="w-full h-full bg-indigo-400 rounded-md p-2 md:pl-4">
                        <h1 class="text-white text-xl font-medium py-2"><?= $event["tahun"] ?></h1>
                        <p class="text-gray-100 sm:text-sm text-xs"><?= $event["kegiatan"] ?></p>
                    </div>
                </div>
                <div class="relative col-span-1 w-full h-full flex justify-center items-center">
                    <div class="h-full w-1 bg-indigo-300"></div>
                    <div class="absolute w-6 h-6 rounded-full bg-indigo-400 z-10 text-white text-center"><?= $index + 1 ?></div>
                </div>
                <div class="col-span-4 w-full h-full"></div>
            <?php else: ?>
                <div class="col-span-4 w-full h-full"></div>
                <div class="relative col-span-1 w-full h-full flex justify-center items-center">
                    <div class="h-full w-1 bg-indigo-300"></div>
                    <div class="absolute w-6 h-6 rounded-full bg-indigo-400 z-10 text-white text-center"><?= $index + 1 ?></div>
                </div>
                <div class="col-span-4 w-full h-full">
                    <div class="w-full h-full bg-indigo-400 rounded-md p-2 md:pl-4">
                        <h1 class="text-white text-xl font-medium py-2"><?= $event["tahun"] ?></h1>
                        <p class="text-gray-100 sm:text-sm text-xs"><?= $event["kegiatan"] ?></p>
                    </div>
                </div>
            <?php endif; ?>

        <?php } ?>
    </div>
    </div>
        <div class="mt-10 flex gap-10">
            <a href="halaman1.php" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">Profil</a>
            <a href="halaman3.php" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">Blog</a>
        </div>
    
</body>

</html>
