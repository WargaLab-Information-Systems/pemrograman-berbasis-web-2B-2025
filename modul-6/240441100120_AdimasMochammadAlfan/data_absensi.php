<!-- Data Absensi -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="p-6 border-b flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-clipboard-list mr-2 text-blue-500"></i>Data Absensi
        </h2>
        <button onclick="openModal('tambahAbsensi')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i>Tambah Absensi
        </button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Karyawan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Masuk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Pulang</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($daftar_absensi as $a): 
                    $masuk = new DateTime($a['jam_masuk']);
                    $pulang = new DateTime($a['jam_pulang']);
                    $durasi = $masuk->diff($pulang);
                ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap"><?= $a['nama'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $a['tanggal_absensi'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $a['jam_masuk'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $a['jam_pulang'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                            <?= $durasi->format('%h jam %i menit') ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>