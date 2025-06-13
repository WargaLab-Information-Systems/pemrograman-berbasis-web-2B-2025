<?php
session_start();
include("koneksi.php");
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM karyawan_absensi WHERE id = $id");
    header("Location: data.php");
    exit;
}

// Ambil data edit
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM karyawan_absensi WHERE id = $id");
    $editData = mysqli_fetch_assoc($result);
}

// Update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jk = $_POST['jenis_kelamin'];
    $departemen = $_POST['departemen'];
    $jabatan = $_POST['jabatan'];
    $kota = $_POST['kota_asal'];
    $tanggal = $_POST['tanggal_absensi'];
    $masuk = $_POST['jam_masuk'];
    $pulang = $_POST['jam_pulang'];

    $sql = "UPDATE karyawan_absensi SET nip='$nip', nama='$nama', umur='$umur', jenis_kelamin='$jk', departemen='$departemen', jabatan='$jabatan', kota_asal='$kota', tanggal_absensi='$tanggal', jam_masuk='$masuk', jam_pulang='$pulang' WHERE id = $id";
    mysqli_query($conn, $sql);
    header("Location: data.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM karyawan_absensi");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Karyawan & Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="max-w-7xl mx-auto mt-10 p-4 bg-white shadow-md rounded-xl">
    <h2 class="text-2xl font-bold mb-6">Data Karyawan & Absensi</h2>

    <div class="mb-4 flex justify-between">
        <a href="absen.php" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Tambah Data</a>
        <a href="dashboard.php" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Kembali</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border text-sm text-left">
            <thead class="bg-gray-200 text-gray-600 uppercase">
                <tr>
                    <th class="px-3 py-2">NIP</th>
                    <th class="px-3 py-2">Nama</th>
                    <th class="px-3 py-2">Umur</th>
                    <th class="px-3 py-2">JK</th>
                    <th class="px-3 py-2">Departemen</th>
                    <th class="px-3 py-2">Jabatan</th>
                    <th class="px-3 py-2">Kota</th>
                    <th class="px-3 py-2">Tanggal</th>
                    <th class="px-3 py-2">Masuk</th>
                    <th class="px-3 py-2">Pulang</th>
                    <th class="px-3 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <?php while($row = mysqli_fetch_assoc($data)): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2"><?= $row['nip'] ?></td>
                        <td class="px-3 py-2"><?= $row['nama'] ?></td>
                        <td class="px-3 py-2"><?= $row['umur'] ?></td>
                        <td class="px-3 py-2"><?= $row['jenis_kelamin'] ?></td>
                        <td class="px-3 py-2"><?= $row['departemen'] ?></td>
                        <td class="px-3 py-2"><?= $row['jabatan'] ?></td>
                        <td class="px-3 py-2"><?= $row['kota_asal'] ?></td>
                        <td class="px-3 py-2"><?= $row['tanggal_absensi'] ?></td>
                        <td class="px-3 py-2"><?= $row['jam_masuk'] ?></td>
                        <td class="px-3 py-2"><?= $row['jam_pulang'] ?></td>
                        <td class="px-3 py-2 space-x-2">
                            <a href="?edit=<?= $row['id'] ?>" class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500 text-xs">Edit</a>
                            <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus data?')" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-xs">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if ($editData): ?>
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-lg">
    <h2 class="text-xl font-semibold mb-4 text-blue-600">Edit Data Karyawan & Absensi</h2>
    <form method="post" class="space-y-3">
        <input type="hidden" name="id" value="<?= $editData['id'] ?>">

        <input type="text" name="nip" value="<?= $editData['nip'] ?>" required class="w-full p-2 border rounded focus:ring focus:ring-blue-300" placeholder="NIP">
        <input type="text" name="nama" value="<?= $editData['nama'] ?>" required class="w-full p-2 border rounded focus:ring focus:ring-blue-300" placeholder="Nama">
        <input type="number" name="umur" value="<?= $editData['umur'] ?>" required class="w-full p-2 border rounded focus:ring focus:ring-blue-300" placeholder="Umur">
        
        <select name="jenis_kelamin" required class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-laki" <?= $editData['jenis_kelamin']=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
            <option value="Perempuan" <?= $editData['jenis_kelamin']=='Perempuan'?'selected':'' ?>>Perempuan</option>
        </select>

        <input type="text" name="departemen" value="<?= $editData['departemen'] ?>" required class="w-full p-2 border rounded focus:ring focus:ring-blue-300" placeholder="Departemen">
        <input type="text" name="jabatan" value="<?= $editData['jabatan'] ?>" required class="w-full p-2 border rounded focus:ring focus:ring-blue-300" placeholder="Jabatan">
        <input type="text" name="kota_asal" value="<?= $editData['kota_asal'] ?>" required class="w-full p-2 border rounded focus:ring focus:ring-blue-300" placeholder="Kota Asal">
        <input type="date" name="tanggal_absensi" value="<?= $editData['tanggal_absensi'] ?>" required class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
        <input type="time" name="jam_masuk" value="<?= $editData['jam_masuk'] ?>" required class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
        <input type="time" name="jam_pulang" value="<?= $editData['jam_pulang'] ?>" required class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
        
        <div class="flex space-x-3">
            <button type="submit" name="update" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            <a href="data.php" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Batal</a>
        </div>
    </form>
</div>
<?php endif; ?>

</body>
</html>
