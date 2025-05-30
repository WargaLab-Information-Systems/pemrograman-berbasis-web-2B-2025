<?php

function formatTanggalArtikel($tanggal) {
    $bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );
    return date('j', strtotime($tanggal)) . ' ' . $bulan[date('n', strtotime($tanggal))] . ' ' . date('Y', strtotime($tanggal));
}

$kutipan_motivasi = array(
    "Kesehatan adalah kekayaan sejati, bukan potongan emas dan perak. - Mahatma Gandhi",
    "Disiplin adalah jembatan antara tujuan dan pencapaian. - Jim Rohn",
    "Latihan bukan hanya tentang perubahan tubuh, tetapi perubahan pikiran, sikap, dan suasana hati. - Unknown",
    "Kode adalah seperti puisi; harus ringkas dan bermakna. - Anonymous",
    "Konsistensi adalah kunci untuk hasil yang berkelanjutan. - Unknown"
);

$artikel_blog = array(
    array(
        'id' => 1,
        'judul' => 'Pentingnya Olahraga Rutin untuk Kesehatan Mental',
        'tanggal' => '2024-03-15',
        'gambar' => 'art1.jpeg',
        'refleksi' => 'Selama tiga bulan terakhir, saya telah menjalani rutinitas olahraga 3 kali seminggu dan merasakan perubahan signifikan pada kesehatan mental. Endorfin yang dilepaskan setelah berolahraga membantu mengurangi stres dan meningkatkan mood. Awalnya sulit membangun kebiasaan ini, tetapi setelah konsisten selama 21 hari, tubuh mulai "merindukan" sesi olahraga. Tidak perlu langsung intens - mulai dari jalan kaki 30 menit pun sudah memberikan manfaat. Kini saya memahami betul pepatah "mens sana in corpore sano" (pikiran yang sehat dalam tubuh yang sehat).',
        'referensi' => 'https://www.halodoc.com/artikel/alasan-olahraga-baik-untuk-menjaga-kesehatan-mental'
    ),
    array(
        'id' => 2,
        'judul' => 'Peran Nutrisi dalam Meningkatkan Massa Otot Secara Alami',
        'tanggal' => '2024-02-28',
        'gambar' => 'art2.jpeg',
        'refleksi' => 'Setelah saya mulai fokus memperbaiki pola makan dan asupan nutrisi, saya menyadari bahwa latihan berat saja tidak cukup untuk membentuk otot secara optimal. Konsumsi protein berkualitas, karbohidrat yang cukup, dan lemak sehat sangat penting untuk pemulihan dan pertumbuhan otot. Saya juga belajar pentingnya mengatur waktu makan sebelum dan sesudah latihan untuk memberikan energi yang maksimal. Perjalanan ini mengajarkan saya bahwa proses alami dengan disiplin dan nutrisi seimbang jauh lebih berkelanjutan daripada mencari jalan pintas.',
        'referensi' => 'https://health.detik.com/berita-detikhealth/d-5773367/begini-cara-penuhi-kebutuhan-nutrisi-untuk-jaga-massa-otot'
    ),
    array(
        'id' => 3,
        'judul' => 'Perjalanan Belajar Coding Dasar untuk Pemula',
        'tanggal' => '2024-04-05',
        'gambar' => 'art3.jpg',
        'refleksi' => 'Sebagai pemula di dunia pemrograman, saya memulai dengan HTML/CSS dasar sebelum beralih ke JavaScript. Tantangan terbesar adalah mengubah pola pikir menjadi logika komputasional. Awalnya frustasi ketika kode tidak bekerja, tetapi belajar untuk menikmati proses debugging. Satu pelajaran berharga: memahami fundamental lebih penting daripada mengikuti framework terbaru. Sekarang saya bisa membuat website sederhana dan mulai menjelajahi back-end development. Kuncinya adalah konsistensi - coding 1 jam setiap hari lebih efektif daripada belajar 7 jam sekali seminggu.',
        'referensi' => 'https://itbox.id/blog/belajar-coding-pemula-harus-mulai-dari-mana/'
    )
);

$artikel = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    foreach ($artikel_blog as $item) {
        if ($item['id'] === $id) {
            $artikel = $item;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Reflektif</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <main class="container mx-auto px-4 py-8">

    <header class="bg-white fixed top-0 left-0 w-full z-50 shadow-sm">
        <div class="px-8 flex justify-center items-center justify-between py-4">
            <div>
                <h1 class="text-2xl text-blue-700 font-bold">ProfilMhs.</h1>
            </div>
      
            <nav class="hidden md:flex space-x-8 items-center">
                <a href="index.php" class="text-gray-600 hover:text-blue-600 transition-300">Profile</a>
                <a href="timeline.php" class="text-gray-600 hover:text-blue-600 transition-300">Experience</a>
                <a href="blog.php" class="text-blue-600 font-semibold">Blog</a>
            </nav>

            <button class="md:text-gray-600">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </header>
        <h1 class="text-2xl font-bold px-28 mb-8 text-blue-700 mt-20">Blog Reflektif</h1>
        <div class="max-w-5xl mx-auto px-28 mb-8 items-center">
            <p class="px-20 text-gray-600 italic mb-3">"Catatan perjalanan dan pemikiran tentang kesehatan, teknologi, dan pengembangan diri"</p>
            <div class="flex items-center">
                <div class="flex-grow border-t border-gray-300"></div>
                <div class="px-4 text-gray-500">
                   <i class="fas fa-book-open"></i>
                 </div>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>
        </div>
        
        <?php if ($artikel): ?>

        <section class="max-w-5xl mx-auto bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold mb-2 text-gray-800"><?php echo htmlspecialchars($artikel['judul']); ?></h2>
            <p class="text-gray-500 mb-4"><?php echo formatTanggalArtikel($artikel['tanggal']); ?></p>
            
            <img src="assets/images/<?php echo htmlspecialchars($artikel['gambar']); ?>" alt="<?php echo htmlspecialchars($artikel['judul']); ?>" class="w-full h-64 object-cover rounded mb-4">
            
            <p class="text-gray-700 mb-6"><?php echo nl2br(htmlspecialchars($artikel['refleksi'])); ?></p>
            
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                <p class="text-yellow-700 italic"><?php echo htmlspecialchars($kutipan_motivasi[array_rand($kutipan_motivasi)]); ?></p>
            </div>
            
            <?php if (!empty($artikel['referensi'])): ?>
            <div class="text-sm text-gray-600">
                <span class="font-medium">Referensi:</span>
                <a href="<?php echo htmlspecialchars($artikel['referensi']); ?>" target="_blank" class="text-blue-600 hover:underline"><?php echo htmlspecialchars($artikel['referensi']); ?></a>
            </div>
            <?php endif; ?>
            
            <a href="blog.php" class="inline-block mt-4 bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-blue-700 transition">Kembali ke Daftar Artikel</a>
        </section>
        <?php else: ?>

        <section class="max-w-5xl mx-auto">
            <?php foreach ($artikel_blog as $item): ?>
            <article class="flex bg-white shadow-md p-6 items-center border-b border-gray-100 hover:bg-gray-50 transition overflow-hidden">
                    <div class="flex flex-col md:flex-row md:items-center">

                        <div class="flex-shrink-0 w-20 h-20 flex flex-col justify-center items-center rounded-lg bg-blue-100 text-blue-800 mr-4">
                            <span class="text-2xl font-bold"><?php echo date('j', strtotime($item['tanggal'])); ?></span>
                            <span class="text-xs"><?php echo date('F', strtotime($item['tanggal'])); ?></span>
                        </div>

                        <div class="flex-grow">
                            <h2 class="text-lg font-bold text-gray-800 mb-1">
                                <a href="blog.php?id=<?php echo $item['id']; ?>" class="hover:text-blue-600"><?php echo htmlspecialchars($item['judul']); ?></a>
                            </h2>
                            <p class="text-gray-600 text-xs mb-2"><?php echo substr(htmlspecialchars($item['refleksi']), 0, 100); ?>...</p>
                            <div class="text-xs text-gray-500 mb-2">
                                <span class="inline-flex text-xs items-center mr-4">
                                    <svg class="w-4 h-4 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M6 2a1 1 0 011 1v1h6V3a1 1 0 112 0v1h1a2 2 0 012 2v1H3V6a2 2 0 012-2h1V3a1 1 0 011-1zM3 9h14v8a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/></svg>
                                    <?php echo formatTanggalArtikel($item['tanggal']); ?>
                                </span>
                            </div>
                        </div>
                        <a href="blog.php?id=<?php echo $item['id']; ?>" class="text-blue-600 text-xs hover:underline px-24">Detail Artikel</a>
                    </div>
            </article>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>

        <nav class="flex justify-between mt-10 px-10">
          <a href="tugas2.php" class="bg-blue-100 text-blue-600 text-sm font-semibold px-4 py-2 rounded-lg hover:bg-blue-200 transition">Menuju Timeline Experience</a>
        </nav>
    </main>
</body>
</html>

