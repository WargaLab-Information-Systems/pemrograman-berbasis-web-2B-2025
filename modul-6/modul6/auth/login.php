<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

if (isLoggedIn()) {
    header('Location: ../pages/dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = 'Username dan password wajib diisi';
    } else {
        if (loginUser($username, $password)) {
            header('Location: ../pages/dashboard.php');
            exit();
        } else {
            $error = 'Username atau password salah';
        }
    }
}
?>

<?php include '../includes/header.php'; ?>

<div class="mt-10 max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-6 text-center">Login Akun</h2>

    <?php if ($error): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="login.php" method="POST" class="text-sm space-y-4" id="loginForm">
        <div>
            <label for="username" class="block text-gray-700 mb-2">Username</label>
            <input type="text" id="username" name="username"
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
        </div>

        <div>
            <label for="password" class="block text-gray-700 mb-2">Password</label>
            <input type="password" id="password" name="password"
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
        </div>

        <button type="submit"
                class="w-full font-semibold bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
            Login
        </button>
    </form>

    <p class="text-sm mt-4 text-center text-gray-600">
        Belum punya akun? <a href="register.php" class="text-sm text-purple-600 hover:underline">Daftar disini</a>
    </p>
</div>

<?php include '../includes/footer.php'; ?>