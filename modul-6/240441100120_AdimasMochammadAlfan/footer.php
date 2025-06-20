        <script>
            // Toggle mobile menu
            document.getElementById('mobileMenuButton').addEventListener('click', function() {
                document.getElementById('mobileMenu').classList.toggle('hidden');
            });
            
            // Modal functions
            function openModal(id) {
                document.getElementById(id).classList.remove('hidden');
            }
            
            function closeModal(id) {
                document.getElementById(id).classList.add('hidden');
            }
            
            // Auto close alerts after 5 seconds
            setTimeout(() => {
                const alerts = document.querySelectorAll('[class*="fixed top-4 right-4"]');
                alerts.forEach(alert => {
                    alert.style.display = 'none';
                });
            }, 5000);

            function openEditModal(id) {
                // Ambil data karyawan dari daftar yang sudah dimuat
                const karyawan = <?php echo json_encode($daftar_karyawan); ?>;
                const data = karyawan.find(k => k.id == id);
                
                if (data) {
                    // Isi form dengan data karyawan
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_nip').value = data.nip;
                    document.getElementById('edit_nama').value = data.nama;
                    document.getElementById('edit_umur').value = data.umur;
                    document.getElementById('edit_jenis_kelamin').value = data.jenis_kelamin;
                    document.getElementById('edit_departemen').value = data.departemen;
                    document.getElementById('edit_jabatan').value = data.jabatan;
                    document.getElementById('edit_kota_asal').value = data.kota_asal;
                    
                    // Buka modal
                    openModal('editKaryawan');
                } else {
                    alert('Data karyawan tidak ditemukan');
                }
            }
        </script>
    </div>
</body>
</html>