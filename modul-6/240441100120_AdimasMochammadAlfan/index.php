<?php
require_once 'config.php';
require_once 'auth.php';
require_once 'karyawan.php';
require_once 'absensi.php';
require_once 'header.php';

if (!isset($_SESSION['user_id'])): 
    require_once 'login.php';
else: 
    require_once 'sidebar.php';
    
    // Page Content
    if (!isset($_GET['page'])) {
        require_once 'dashboard.php';
    } elseif ($_GET['page'] == 'karyawan') {
        require_once 'data_karyawan.php';
    } elseif ($_GET['page'] == 'absensi') {
        require_once 'data_absensi.php';
    }
    
    // Modals
    require_once 'modals.php';
    
    require_once 'footer.php';
endif;
?>