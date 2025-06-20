<!-- Dashboard -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-xl shadow-md p-6 card">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div>
                <p class="text-gray-500">Total Karyawan</p>
                <h3 class="text-2xl font-bold"><?= count($daftar_karyawan) ?></h3>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-6 card">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                <i class="fas fa-clipboard-list text-xl"></i>
            </div>
            <div>
                <p class="text-gray-500">Total Absensi</p>
                <h3 class="text-2xl font-bold"><?= count($daftar_absensi) ?></h3>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-6 card">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                <i class="fas fa-calendar-day text-xl"></i>
            </div>
            <div>
                <p class="text-gray-500">Hari Ini</p>
                <h3 class="text-2xl font-bold"><?= date('d F Y') ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold mb-4 flex items-center">
            <i class="fas fa-user-clock mr-2 text-blue-500"></i>Absensi Terakhir
        </h3>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2 px-4">Nama</th>
                        <th class="text-left py-2 px-4">Tanggal</th>
                        <th class="text-left py-2 px-4">Jam Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_slice($daftar_absensi, 0, 5) as $a): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4"><?= $a['nama'] ?></td>
                        <td class="py-3 px-4"><?= $a['tanggal_absensi'] ?></td>
                        <td class="py-3 px-4"><?= $a['jam_masuk'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold mb-4 flex items-center">
            <i class="fas fa-user-plus mr-2 text-blue-500"></i>Karyawan Terbaru
        </h3>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2 px-4">NIP</th>
                        <th class="text-left py-2 px-4">Nama</th>
                        <th class="text-left py-2 px-4">Departemen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_slice($daftar_karyawan, 0, 5) as $k): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4"><?= $k['nip'] ?></td>
                        <td class="py-3 px-4"><?= $k['nama'] ?></td>
                        <td class="py-3 px-4"><?= $k['departemen'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>