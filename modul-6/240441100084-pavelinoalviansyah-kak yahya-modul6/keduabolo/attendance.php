<?php
require 'config.php';
requireLogin();

// CRUD Operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM karyawan_absensi WHERE id = ?");
        $stmt->execute([$_POST['id']]);
    } elseif (isset($_POST['id'])) {
        // Update
        $stmt = $pdo->prepare("UPDATE karyawan_absensi SET karyawan_id=?, tanggal=?, jam_masuk=?, jam_pulang=? WHERE id=?");
        $stmt->execute([
            $_POST['karyawan_id'],
            $_POST['tanggal'],
            $_POST['jam_masuk'],
            $_POST['jam_pulang'],
            $_POST['id']
        ]);
    } else {
        // Create
        $stmt = $pdo->prepare("INSERT INTO karyawan_absensi (karyawan_id, tanggal, jam_masuk, jam_pulang) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $_POST['karyawan_id'],
            $_POST['tanggal'],
            $_POST['jam_masuk'],
            $_POST['jam_pulang']
        ]);
    }
    header("Location: attendance.php");
    exit();
}

// Get all attendance records with employee names
$attendance = $pdo->query("
    SELECT ka.*, k.nama 
    FROM karyawan_absensi ka
    JOIN karyawan k ON ka.karyawan_id = k.id
    ORDER BY ka.tanggal DESC
")->fetchAll();

// Get attendance for edit
$editAttendance = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM karyawan_absensi WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editAttendance = $stmt->fetch();
}

// Get all employees for dropdown
$employees = $pdo->query("SELECT id, nip, nama FROM karyawan ORDER BY nama")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5><?= $editAttendance ? 'Edit' : 'Add' ?> Attendance</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <?php if ($editAttendance): ?>
                                <input type="hidden" name="id" value="<?= $editAttendance['id'] ?>">
                            <?php endif; ?>
                            
                            <div class="mb-3">
                                <label class="form-label">Employee</label>
                                <select name="karyawan_id" class="form-select" required>
                                    <?php foreach ($employees as $emp): ?>
                                        <option value="<?= $emp['id'] ?>" 
                                            <?= $editAttendance && $editAttendance['karyawan_id'] == $emp['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($emp['nip']) ?> - <?= htmlspecialchars($emp['nama']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="tanggal" class="form-control" 
                                    value="<?= $editAttendance ? $editAttendance['tanggal'] : date('Y-m-d') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Check In</label>
                                <input type="time" name="jam_masuk" class="form-control" 
                                    value="<?= $editAttendance ? $editAttendance['jam_masuk'] : '08:00' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Check Out</label>
                                <input type="time" name="jam_pulang" class="form-control" 
                                    value="<?= $editAttendance ? $editAttendance['jam_pulang'] : '17:00' ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary"><?= $editAttendance ? 'Update' : 'Save' ?></button>
                            <?php if ($editAttendance): ?>
                                <a href="attendance.php" class="btn btn-secondary">Cancel</a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Attendance Records</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Employee</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($attendance as $att): ?>
                                <tr>
                                    <td><?= date('d M Y', strtotime($att['tanggal'])) ?></td>
                                    <td><?= htmlspecialchars($att['nama']) ?></td>
                                    <td><?= htmlspecialchars($att['jam_masuk']) ?></td>
                                    <td><?= htmlspecialchars($att['jam_pulang']) ?></td>
                                    <td>
                                        <a href="attendance.php?edit=<?= $att['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" style="display:inline">
                                            <input type="hidden" name="delete" value="1">
                                            <input type="hidden" name="id" value="<?= $att['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>