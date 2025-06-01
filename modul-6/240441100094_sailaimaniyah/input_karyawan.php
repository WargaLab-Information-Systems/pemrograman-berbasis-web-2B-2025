<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id" >
<head>
  <meta charset="UTF-8" />
  <title>Input Data Karyawan & Absensi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

<div class="max-w-xl mx-auto bg-white rounded shadow p-8">
  <h2 class="text-2xl font-semibold mb-6">Input Data Karyawan & Absensi</h2>

  <form id="formKaryawan" method="POST" novalidate class="space-y-4">
   
    <div>
      <label for="nip" class="block text-gray-700 font-medium mb-1">NIP </label>
      <input type="text" name="nip" id="nip" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
      <p class="text-red-600 mt-1 hidden text-sm" id="nipError">NIP wajib diisi.</p>
    </div>
    

    <div>
      <label for="nama" class="block text-gray-700 font-medium mb-1">Nama </label>
      <input type="text" name="nama" id="nama" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
      <p class="text-red-600 mt-1 hidden text-sm" id="namaError">Nama wajib diisi.</p>
    </div>

    <div>
      <label for="umur" class="block text-gray-700 font-medium mb-1">Umur </label>
      <input type="text" name="umur" id="umur" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
      <p class="text-red-600 mt-1 hidden text-sm" id="umurError">Umur wajib diisi.</p>
    </div>

    <div>
      <label for="jenis_kelamin" class="block text-gray-700 font-medium mb-1">Jenis Kelamin </label>
      <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <option value="" disabled selected>Pilih jenis kelamin</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
      <p class="text-red-600 mt-1 hidden text-sm" id="jkError">Jenis kelamin wajib dipilih.</p>
    </div>

    <div>
      <label for="departemen" class="block text-gray-700 font-medium mb-1">Departemen </label>
      <input type="text" name="departemen" id="departemen" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
      <p class="text-red-600 mt-1 hidden text-sm" id="departemenError">Departemen wajib diisi.</p>
    </div>

    <div>
      <label for="jabatan" class="block text-gray-700 font-medium mb-1">Jabatan </label>
      <input type="text" name="jabatan" id="jabatan" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
      <p class="text-red-600 mt-1 hidden text-sm" id="jabatanError">Jabatan wajib diisi.</p>
    </div>

    <div>
      <label for="kota_asal" class="block text-gray-700 font-medium mb-1">Kota Asal </label>
      <input type="text" name="kota_asal" id="kota_asal" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
      <p class="text-red-600 mt-1 hidden text-sm" id="kotaError">Kota asal wajib diisi.</p>
    </div>

    <div>
      <label for="tanggal" class="block text-gray-700 font-medium mb-1">Tanggal Absensi </label>
      <input type="date" name="tanggal" id="tanggal" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
      <p class="text-red-600 mt-1 hidden text-sm" id="tanggalError">Tanggal wajib dipilih.</p>
    </div>

    <div>
      <label for="jam_masuk" class="block text-gray-700 font-medium mb-1">Jam Masuk </label>
      <input type="time" name="jam_masuk" id="jam_masuk" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
      <p class="text-red-600 mt-1 hidden text-sm" id="jamMasukError">Jam masuk wajib diisi.</p>
    </div>

    <div>
      <label for="jam_pulang" class="block text-gray-700 font-medium mb-1">Jam Pulang </label>
      <input type="time" name="jam_pulang" id="jam_pulang" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
      <p class="text-red-600 mt-1 hidden text-sm" id="jamPulangError">Jam pulang wajib diisi.</p>
    </div>

    <button type="submit" name="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan Data</button>
  </form>

  <p class="mt-4 text-sm">
    <a href="tampil_karyawan.php" class="text-blue-600 underline">Kembali</a> |
    <a href="logout.php" class="text-red-600 underline">Logout</a>
  </p>
</div>

<script>
const form = document.getElementById('formKaryawan');
const valid = {};

// Fungsi untuk cek dan tampilkan error
function checkInput(id, condition) {
  const errorElem = document.getElementById(id + 'Error');
  const inputElem = document.getElementById(id);
  if (!condition) {
    errorElem.classList.remove('hidden');
    inputElem.classList.add('border-red-600');
    valid[id] = false;
  } else {
    errorElem.classList.add('hidden');
    inputElem.classList.remove('border-red-600');
    valid[id] = true;
  }
}

form.addEventListener('submit', e => {
  checkInput('nip', form.nip.value.trim() !== '');
  checkInput('nama', form.nama.value.trim() !== '');
  checkInput('umur', form.umur.value !== '');
  checkInput('jenis_kelamin', form.jenis_kelamin.value !== '');
  checkInput('departemen', form.departemen.value.trim() !== '');
  checkInput('jabatan', form.jabatan.value.trim() !== '');
  checkInput('kota_asal', form.kota_asal.value.trim() !== '');
  checkInput('tanggal', form.tanggal.value !== '');
  checkInput('jam_masuk', form.jam_masuk.value !== '');
  checkInput('jam_pulang', form.jam_pulang.value !== '');

  // Cek semua valid
  if (!Object.values(valid).every(v => v)) {
    e.preventDefault();
  }
});
</script>

<?php
if (isset($_POST['submit'])) {
    $nip = $_POST['nip'];
    $nama =  $_POST['nama'];
    $umur = (int)$_POST['umur'];
    $jenis_kelamin =  $_POST['jenis_kelamin'];
    $departemen =  $_POST['departemen'];
    $jabatan = $_POST['jabatan'];
    $kota_asal = $_POST['kota_asal'];
    $tanggal = $_POST['tanggal'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_pulang = $_POST['jam_pulang'];

    $sql = "INSERT INTO karyawan_absensi
            (nip, nama, umur, jenis_kelamin, departemen, jabatan, kota_asal, tanggal_absensi , jam_masuk, jam_pulang)
            VALUES
            ('$nip', '$nama', $umur, '$jenis_kelamin', '$departemen', '$jabatan', '$kota_asal', '$tanggal', '$jam_masuk', '$jam_pulang')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<p class='text-green-600 mt-4'>Data berhasil disimpan.</p>";
    } else {
        echo "<p class='text-red-600 mt-4'>Error: " . mysqli_error($koneksi) . "</p>";
    }
}
?>

</body>
</html>
