<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

if (isLoggedIn()) {
    header('Location: ../pages/dashboard.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = 'Semua field harus diisi';
    } elseif ($password !== $confirm_password) {
        $error = 'Password dan konfirmasi password tidak cocok';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter';
    } else {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->fetch()) {
            $error = 'Username sudah digunakan';
        } else {
            if (registerUser($username, $password)) {
                $success = 'Registrasi berhasil! Silakan login.';
                $username = '';
            } else {
                $error = 'Gagal melakukan registrasi';
            }
        }
    }
}
?>

<?php include '../includes/header.php'; ?>

<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-6 text-center">Registrasi Akun</h2>

    <?php if ($error): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <form action="register.php" method="POST" class="text-sm space-y-4" id="registerForm">
        <div>
            <label for="username" class="block text-gray-700 mb-2">Username</label>
            <input type="text" id="username" name="username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
        </div>

        <div>
            <label for="password" class="block text-gray-700 mb-2">Password</label>
            <input type="password" id="password" name="password" 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
            <p class="text-xs text-gray-500 mt-1">Minimal 6 karakter</p>
        </div>

        <div>
            <label for="confirm_password" class="block text-gray-700 mb-2">Konfirmasi Password</label>
            <input type="password" id="confirm_password" name="confirm_password" 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
        </div>

        <button type="submit" class="w-full bg-purple-600 text-white py-2 px-4 font-semibold rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
            Daftar
        </button>
    </form>

    <p class="text-sm mt-4 text-center text-gray-600">
        Sudah punya akun? <a href="login.php" class="text-sm text-purple-600 hover:underline">Login disini</a>
    </p>
</div>

<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    if (password.length < 6) {
        alert('Password minimal 6 karakter');
        e.preventDefault();
        return false;
    }

    if (password !== confirmPassword) {
        alert('Password dan konfirmasi password tidak cocok');
        e.preventDefault();
        return false;
    }

    return true;
});
</script>

<?php include '../includes/footer.php'; ?>
