<?php
require 'config.php';
requireLogin();

// CRUD Operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM karyawan WHERE id = ?");
        $stmt->execute([$_POST['id']]);
    } elseif (isset($_POST['id'])) {
        // Update
        $stmt = $pdo->prepare("UPDATE karyawan SET nip=?, nama=?, umur=?, jenis_kelamin=?, departemen=?, jabatan=?, kota_asal=? WHERE id=?");
        $stmt->execute([
            $_POST['nip'],
            $_POST['nama'],
            $_POST['umur'],
            $_POST['jenis_kelamin'],
            $_POST['departemen'],
            $_POST['jabatan'],
            $_POST['kota_asal'],
            $_POST['id']
        ]);
    } else {
        // Create
        $stmt = $pdo->prepare("INSERT INTO karyawan (nip, nama, umur, jenis_kelamin, departemen, jabatan, kota_asal) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['nip'],
            $_POST['nama'],
            $_POST['umur'],
            $_POST['jenis_kelamin'],
            $_POST['departemen'],
            $_POST['jabatan'],
            $_POST['kota_asal']
        ]);
    }
    header("Location: employees.php");
    exit();
}

// Get all employees
$employees = $pdo->query("SELECT * FROM karyawan")->fetchAll();

// Get employee for edit
$editEmployee = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM karyawan WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editEmployee = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5><?= $editEmployee ? 'Edit' : 'Add' ?> Employee</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <?php if ($editEmployee): ?>
                                <input type="hidden" name="id" value="<?= $editEmployee['id'] ?>">
                            <?php endif; ?>
                            
                            <div class="mb-3">
                                <label class="form-label">NIP</label>
                                <input type="text" name="nip" class="form-control" value="<?= $editEmployee ? $editEmployee['nip'] : '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="nama" class="form-control" value="<?= $editEmployee ? $editEmployee['nama'] : '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Age</label>
                                <input type="number" name="umur" class="form-control" value="<?= $editEmployee ? $editEmployee['umur'] : '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="Male" <?= $editEmployee && $editEmployee['jenis_kelamin'] === 'Male' ? 'selected' : '' ?>>Male</option>
                                    <option value="Female" <?= $editEmployee && $editEmployee['jenis_kelamin'] === 'Female' ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <input type="text" name="departemen" class="form-control" value="<?= $editEmployee ? $editEmployee['departemen'] : '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Position</label>
                                <input type="text" name="jabatan" class="form-control" value="<?= $editEmployee ? $editEmployee['jabatan'] : '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hometown</label>
                                <input type="text" name="kota_asal" class="form-control" value="<?= $editEmployee ? $editEmployee['kota_asal'] : '' ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary"><?= $editEmployee ? 'Update' : 'Save' ?></button>
                            <?php if ($editEmployee): ?>
                                <a href="employees.php" class="btn btn-secondary">Cancel</a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Employee List</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Department</th>
                                    <th>Position</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($employees as $emp): ?>
                                <tr>
                                    <td><?= htmlspecialchars($emp['nip']) ?></td>
                                    <td><?= htmlspecialchars($emp['nama']) ?></td>
                                    <td><?= htmlspecialchars($emp['umur']) ?></td>
                                    <td><?= htmlspecialchars($emp['jenis_kelamin']) ?></td>
                                    <td><?= htmlspecialchars($emp['departemen']) ?></td>
                                    <td><?= htmlspecialchars($emp['jabatan']) ?></td>
                                    <td>
                                        <a href="employees.php?edit=<?= $emp['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" style="display:inline">
                                            <input type="hidden" name="delete" value="1">
                                            <input type="hidden" name="id" value="<?= $emp['id'] ?>">
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