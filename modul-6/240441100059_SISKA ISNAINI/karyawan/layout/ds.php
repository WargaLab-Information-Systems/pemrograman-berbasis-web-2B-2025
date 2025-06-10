
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Sidebar</title>
  <style>

    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8ecac; 
      color: #1c0a0a;
    }


    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
      height: 100vh;
      background-color: #b81202;
      padding-top: 60px;
      transform: translateX(-250px);
      transition: transform 0.3s ease;
      overflow-y: auto;
      z-index: 1000;
      border-top-right-radius: 12px;
      border-bottom-right-radius: 12px;
    }
    .sidebar.active {
      transform: translateX(0);
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .sidebar ul li {
      padding: 15px 20px;
      color: #f8ecac;
      cursor: pointer;
      font-weight: 600;
      border-radius: 6px;
      margin: 8px 12px;
      transition: background-color 0.2s;
    }
    .sidebar ul li:hover {
      background-color: #7b110c;
    }


    .header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 60px;
      background-color: #550d08;
      display: flex;
      align-items: center;
      padding: 0 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
      z-index: 1100;
    }


    .hamburger {
      width: 30px;
      height: 22px;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      margin-right: 20px;
    }
    .hamburger span {
      display: block;
      height: 4px;
      background: #f8ecac;
      border-radius: 2px;
      transition: 0.3s;
    }

    .hamburger.active span:nth-child(1) {
      transform: rotate(45deg) translate(5px, 5px);
    }
    .hamburger.active span:nth-child(2) {
      opacity: 0;
    }
    .hamburger.active span:nth-child(3) {
      transform: rotate(-45deg) translate(6px, -6px);
    }

    .content {
      margin-top: 20px;
      padding: 20px;
      margin-left: 0;
      transition: margin-left 0.3s ease;
    }
    .content.shift {
      margin-left: 250px;
    }


    @media (max-width: 768px) {
      .sidebar {
        width: 200px;
        transform: translateX(-200px);
      }
      .sidebar.active {
        transform: translateX(0);
      }
      .content.shift {
        margin-left: 200px;
      }
    }

    a{
      text-decoration: none;
      color: #f8ecac;
    }

  </style>
</head>
<body>

  <div class="header">
    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>

 
  </div>
<nav class="sidebar" id="sidebar">
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="profile.php">Profil</a></li>
    <li><a href="pengaturan.php">Pengaturan</a></li>
    <li><a href="hai.php">Logout</a></li>
  </ul>
</nav>


  <main class="content" id="content">
    <h1></h1>
  </main>

  <script>
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    hamburger.addEventListener('click', () => {
      hamburger.classList.toggle('active');
      sidebar.classList.toggle('active');
      content.classList.toggle('shift');
    });
  </script>

</body>
</html>
