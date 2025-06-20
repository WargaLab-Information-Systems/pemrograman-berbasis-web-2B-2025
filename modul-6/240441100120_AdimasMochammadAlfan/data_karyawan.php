<!-- Data Karyawan -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="p-6 border-b flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-users mr-2 text-blue-500"></i>Data Karyawan
        </h2>
        <button onclick="openModal('tambahKaryawan')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i>Tambah Karyawan
        </button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Umur</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departemen</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($daftar_karyawan as $k): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap"><?= $k['nip'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $k['nama'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $k['umur'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $k['jenis_kelamin'] == 'Laki-laki' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' ?>">
                            <?= $k['jenis_kelamin'] ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $k['departemen'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button onclick="openEditModal(<?= $k['id'] ?>)" class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-edit"></i>
                        </button>
                        <a href="index.php?delete_karyawan=<?= $k['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>