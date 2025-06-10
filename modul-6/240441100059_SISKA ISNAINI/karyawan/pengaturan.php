<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Menu Karyawan</title>

  <style>
    body {
      background-color: #f8ecac;
      color: #1c0a0a;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 20px;
    }

h1 {
      color: #550d08;
      text-align: center;
      margin-bottom: 30px;
      text-shadow: 1px 1px 3px #7b110c;
    }

    .menu-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #f8ecac;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(85, 13, 8, 0.2);
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .menu-container a {
      display: block;
      text-align: center;
      text-decoration: none;
      background-color: #550d08;
      color: #f8ecac;
      padding: 14px;
      font-size: 18px;
      font-weight: bold;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(85, 13, 8, 0.4);
      transition: background-color 0.3s ease;
    }

    .menu-container a:hover {
      background-color: #7b110c;
    }
  </style>
</head>
<body>
<?php include "layout/ds.php" ?>

  <h1>C.U.R.D</h1>

  <div class="menu-container">
    <a href="crud/daftar.php">Daftar Karyawan</a>
    <a href="crud/input.php"> Tambah Karyawan</a>
    <a href="crud/edit.php"> Edit Karyawan</a>
  </div>

</body>
<footer style="color: #1c0a0a; padding: 20px 0; text-align: center;">
  <p>&copy; 2025 siskaisn Website. All rights reserved.</p>
  <p>Contact: <a href="https://www.instagram.com/sissssskaaaaaisn?igsh=MTMxaG8zODQ2ZncybA==" style="color: #1c0a0a; text-decoration: underline;">@sissssskaaaaaisn</a></p>
</footer>

</html>
