<?php
require_once 'config.php';
?>

<!-- Main App Layout -->
<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg min-h-screen hidden md:block">
        <div class="p-6">
            <h1 class="text-xl font-bold text-blue-600 flex items-center">
                <i class="fas fa-user-tie mr-2"></i> HR System
            </h1>
            <p class="text-gray-500 text-sm mt-1">Welcome, <?= htmlspecialchars($_SESSION['username'] ?? '') ?></p>
        </div>
        
        <nav class="mt-6">
            <a href="index.php" class="block py-3 px-6 text-gray-700 hover:bg-blue-50 hover:text-blue-600 <?= (!isset($_GET['page']) ? 'bg-blue-50 text-blue-600' : '') ?>">
                <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
            </a>
            <a href="index.php?page=karyawan" class="block py-3 px-6 text-gray-700 hover:bg-blue-50 hover:text-blue-600 <?= (isset($_GET['page']) && $_GET['page'] == 'karyawan' ? 'bg-blue-50 text-blue-600' : '') ?>">
                <i class="fas fa-users mr-3"></i>Data Karyawan
            </a>
            <a href="index.php?page=absensi" class="block py-3 px-6 text-gray-700 hover:bg-blue-50 hover:text-blue-600 <?= (isset($_GET['page']) && $_GET['page'] == 'absensi' ? 'bg-blue-50 text-blue-600' : '') ?>">
                <i class="fas fa-clipboard-list mr-3"></i>Data Absensi
            </a>
        </nav>
        
        <div class="absolute bottom-0 w-full p-6">
            <a href="?logout" class="block w-full bg-red-100 hover:bg-red-200 text-red-700 py-2 px-4 rounded-lg text-center transition duration-200">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </a>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="flex-1 p-8">
        <!-- Mobile Header -->
        <div class="md:hidden flex justify-between items-center mb-6">
            <button id="mobileMenuButton" class="text-gray-600">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-xl font-bold text-blue-600">HR System</h1>
            <div class="w-6"></div> <!-- Spacer -->
        </div>
        
        <!-- Mobile Menu (Hidden by default) -->
        <div id="mobileMenu" class="hidden bg-white rounded-lg shadow-lg p-4 mb-6">
            <a href="index.php" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 rounded <?= (!isset($_GET['page']) ? 'bg-blue-50 text-blue-600' : '') ?>">
                <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
            </a>
            <a href="index.php?page=karyawan" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 rounded <?= (isset($_GET['page']) && $_GET['page'] == 'karyawan' ? 'bg-blue-50 text-blue-600' : '') ?>">
                <i class="fas fa-users mr-3"></i>Data Karyawan
            </a>
            <a href="index.php?page=absensi" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 rounded <?= (isset($_GET['page']) && $_GET['page'] == 'absensi' ? 'bg-blue-50 text-blue-600' : '') ?>">
                <i class="fas fa-clipboard-list mr-3"></i>Data Absensi
            </a>
            <a href="?logout" class="block py-2 px-4 text-red-600 hover:bg-red-50 rounded mt-2">
                <i class="fas fa-sign-out-alt mr-3"></i>Logout
            </a>
        </div>