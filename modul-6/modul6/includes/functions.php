<?php
require_once __DIR__ . '/../config/database.php';

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}

function getAllKaryawan() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM karyawan_absensi ORDER BY nama ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getKaryawanById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM karyawan_absensi WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function isNipExist($nip) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id FROM karyawan_absensi WHERE nip = ?");
    $stmt->execute([$nip]);
    return $stmt->fetch() ? true : false;
}

function addKaryawan($data) {
    global $pdo;

    if (!ctype_digit($data['nip'])) {
        return [
            'success' => false,
            'errors' => ['NIP harus berupa angka saja.']
        ];
    }

    try {
        if (isNipExist($data['nip'])) {
            return [
                'success' => false,
                'errors' => ['NIP sudah terdaftar, gunakan NIP lain.']
            ];
        }

        $stmt = $pdo->prepare("INSERT INTO karyawan_absensi 
            (nip, nama, umur, jenis_kelamin, departemen, jabatan, kota_asal, tanggal_absensi, jam_masuk, jam_pulang) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $result = $stmt->execute([
            $data['nip'],
            $data['nama'],
            $data['umur'] !== '' ? (int)$data['umur'] : null,
            $data['jenis_kelamin'],
            $data['departemen'],
            $data['jabatan'],
            $data['kota_asal'],
            $data['tanggal_absensi'],
            $data['jam_masuk'],
            $data['jam_pulang']
        ]);

        if ($result) {
            return ['success' => true];
        } else {
            return [
                'success' => false,
                'errors' => ['Gagal menyimpan data ke database.']
            ];
        }
    } catch (PDOException $e) {
        return [
            'success' => false,
            'errors' => ['Error database: ' . $e->getMessage()]
        ];
    }
}

function updateKaryawan($id, $data) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE karyawan_absensi SET nip = ?, nama = ?, umur = ?, jenis_kelamin = ?, departemen = ?, jabatan = ?, kota_asal = ?, tanggal_absensi = ?, jam_masuk = ?, jam_pulang = ? WHERE id = ?");
    return $stmt->execute([
        $data['nip'],
        $data['nama'],
        $data['umur'],
        $data['jenis_kelamin'],
        $data['departemen'],
        $data['jabatan'],
        $data['kota_asal'],
        $data['tanggal_absensi'],
        $data['jam_masuk'],
        $data['jam_pulang'],
        $id
    ]);
}

function deleteKaryawan($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM karyawan_absensi WHERE id = ?");
    return $stmt->execute([$id]);
}

function registerUser($username, $password) {
    global $pdo;
    $hashedPassword = hashPassword($password);
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    return $stmt->execute([$username, $hashedPassword]);
}

function loginUser($username, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && verifyPassword($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        return true;
    }
    return false;
}
?>