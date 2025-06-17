<?php
session_start();
$host = 'localhost'; $db = 'manajemen_karyawan'; $user = 'root'; $pass = '';
$conn = new mysqli($host, $user, $pass, $db);
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result && password_verify($password, $result['password'])) {
        $_SESSION['username'] = $username;
        header("Location: ../dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-blue-100">
<div class="bg-white shadow-md rounded-xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Login</h2>
    
    <form method="POST">
        <?php if (!empty($error)) : ?>
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline"><?= $error ?></span>
            </div>
        <?php endif; ?>
        <input type="text" name="username" placeholder="Username" required
            class="w-full px-4 py-2 mb-4 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

        <input type="password" name="password" placeholder="Password" required
            class="w-full px-4 py-2 mb-4 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">Login</button>
    </form>

    <p class="mt-4 text-center text-sm text-gray-600">
        Belum punya akun? <a href="register.php" class="text-blue-500 hover:underline">Daftar</a>
    </p>
</div>

</body>
</html>
