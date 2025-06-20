<div class="flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-blue-600 py-6 px-8 text-center">
                <h2 class="text-2xl font-bold text-white">Sistem Manajemen Karyawan</h2>
                <p class="text-blue-100 mt-1">Silakan login untuk melanjutkan</p>
            </div>
            <div class="p-8">
                <form method="POST">
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="username">
                            <i class="fas fa-user mr-2 text-blue-500"></i>Username
                        </label>
                        <input type="text" name="username" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="password">
                            <i class="fas fa-lock mr-2 text-blue-500"></i>Password
                        </label>
                        <input type="password" name="password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <button type="submit" name="login" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </button>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-gray-600">Belum punya akun? 
                        <button onclick="toggleForms()" class="text-blue-600 hover:text-blue-800 font-medium">Daftar disini</button>
                    </p>
                </div>
                
                <form method="POST" id="registerForm" class="hidden mt-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Registrasi Akun Baru</h3>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="reg_username">
                            <i class="fas fa-user-plus mr-2 text-blue-500"></i>Username
                        </label>
                        <input type="text" name="username" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="reg_password">
                            <i class="fas fa-key mr-2 text-blue-500"></i>Password
                        </label>
                        <input type="password" name="password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <button type="submit" name="register" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-user-plus mr-2"></i>Daftar
                    </button>
                    
                    <div class="mt-4 text-center">
                        <button type="button" onclick="toggleForms()" class="text-blue-600 hover:text-blue-800 text-sm">
                            <i class="fas fa-arrow-left mr-1"></i>Kembali ke Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="mt-6 text-center text-gray-500 text-sm">
            <p>© 2023 Sistem Manajemen Karyawan. All rights reserved.</p>
        </div>
    </div>
</div>

<script>
    function toggleForms() {
        const loginForm = document.querySelector('form[method="POST"]:not(#registerForm)');
        const registerForm = document.getElementById('registerForm');
        
        loginForm.classList.toggle('hidden');
        registerForm.classList.toggle('hidden');
    }
</script>