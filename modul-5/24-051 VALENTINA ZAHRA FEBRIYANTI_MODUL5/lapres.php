<?php
function awal() {
    for ($angka = 1; $angka <= 10; $angka++) {
        if ($angka == 5) {
            echo "angka 5 dilewati<br>";
            continue; 
        }
        echo "selamat datang user $angka <br>";
    }
}
awal(); 
?>
