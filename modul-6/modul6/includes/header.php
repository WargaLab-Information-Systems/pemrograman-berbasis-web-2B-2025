<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Karyawan dan Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-white text-purple shadow-sm">
        <div class="container mx-auto py-3 flex justify-between items-center">
            <a href="../pages/dashboard.php" class="text-xl font-bold text-purple-600">KaryaManage</a>
            <div class="flex space-x-2">
                <?php if (isLoggedIn()): ?>
                    <a href="#" class="text-purple-600 text-sm font-semibold px-4 py-2 rounded-md hover:text-purple-200 transition">Data Karyawan</a>
                    <a href="../pages/absensi" class="text-purple-600 text-sm font-semibold px-4 py-2 rounded-md hover:text-purple-200 transition">Data Absensi</a>
                    <a href="../auth/logout.php" class="text-purple-600 text-sm font-semibold px-4 py-2 rounded-md hover:text-purple-200 transition">Logout</a>
                <?php else: ?>
                    <a href="../auth/login.php" class="bg-purple-100 text-purple-600 text-sm font-semibold px-4 py-2 rounded-md hover:bg-purple-200 transition">Login</a>
                    <a href="../auth/register.php" class="bg-purple-600 text-white text-sm font-semibold px-4 py-2 rounded-md hover:bg-purple-200 transition">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-6">