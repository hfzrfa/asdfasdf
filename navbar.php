<?php
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar - ApotekQiu</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: white;
            color: #222;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: white;
            flex-wrap: wrap;
        }

        .logo img {
            height: 50px;
        }

        .nav-center {
            background-color: #00774D;
            border-radius: 40px;
            padding: 10px 20px;
            display: flex;
            gap: 25px;
            position: relative;
        }

        .nav-center a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .nav-indicator {
            position: absolute;
            background-color: white;
            border-radius: 25px;
            z-index: 1;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }

        .nav-center a.active {
            color: black;
        }

        .nav-center a:hover {
            color: #e0e0e0;
        }

        .nav-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 10px 30px;
        }

        .nav-right a {
            margin-left: 15px;
            font-weight: bold;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 30px;
            transition: 0.3s;
            color: #333;
        }

        .nav-right .login-btn,
        .nav-right .logout-btn {
            margin-left: 15px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 30px;
            transition: 0.3s;
            color: white;
            background-color: #00774d;
        }

        .nav-right .login-btn:hover {
            background-color: #005e3f;
        }

        .nav-right .logout-btn {
            background-color: #00774d;
        }

        .nav-right .logout-btn:hover {
            background-color: #00867f;
        }

        .burger-menu {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .burger-bar {
            width: 25px;
            height: 3px;
            background-color: #00774D;
            margin: 3px 0;
            border-radius: 3px;
        }

        @media screen and (max-width: 768px) {
            .navbar {
                padding: 20px;
            }
            
            .burger-menu {
                display: flex;
                order: 1;
            }
            
            .logo {
                order: 0;
                flex-grow: 1;
            }
            
            .nav-right {
                order: 2;
                padding: 10px 0;
            }
            
            .nav-center {
                flex-direction: column;
                position: fixed;
                top: 90px;
                left: -100%;
                width: 70%;
                height: auto;
                background-color: #00774D;
                z-index: 100;
                transition: all 0.5s ease;
                gap: 0;
                padding: 15px;
                border-radius: 0 0 10px 0;
            }
            
            .nav-center.show {
                left: 0;
            }
            
            .nav-center a {
                width: 100%;
                text-align: left;
                padding: 15px;
                margin: 5px 0;
            }
            
            .nav-indicator {
                display: none;
            }
            
            .nav-right {
                font-size: 0.9em;
                flex-grow: 0;
            }
            
            .nav-right span {
                display: none;
            }
            
            .nav-right .login-btn,
            .nav-right .logout-btn {
                padding: 8px 15px;
                margin-left: 5px;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const burgerMenu = document.createElement('div');
            burgerMenu.className = 'burger-menu';
            burgerMenu.innerHTML = '<div class="burger-bar"></div><div class="burger-bar"></div><div class="burger-bar"></div>';
            
            const navbar = document.querySelector('.navbar');
            const logo = document.querySelector('.logo');
            
            navbar.insertBefore(burgerMenu, logo.nextSibling);
            
            burgerMenu.addEventListener('click', function() {
                const navCenter = document.querySelector('.nav-center');
                navCenter.classList.toggle('show');
            });
            
            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                const navCenter = document.querySelector('.nav-center');
                const burgerMenu = document.querySelector('.burger-menu');
                
                if (!navCenter.contains(event.target) && !burgerMenu.contains(event.target) && navCenter.classList.contains('show')) {
                    navCenter.classList.remove('show');
                }
            });
        });
    </script></script>
</head>

<body>

    <div class="navbar">
        <div class="logo">
            <img src="logo.png" alt="ApotekQiu Logo">
        </div>
        <div class="nav-center">
            <div class="nav-indicator"></div>
            <a href="beranda.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'beranda.php' ? 'active' : '' ?>">Beranda</a>
            <a href="dashboard.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">Produk</a>
            <a href="artikel.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'artikel.php' ? 'active' : '' ?>">Artikel</a>
            <a href="blog.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : '' ?>">Tentang</a>
        </div>

        <div class="nav-right">
            <?php if (isset($_SESSION['username'])): ?>
                <span>Hai, <?= htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="logout-btn">Keluar</a>
            <?php else: ?>
                <span>Selamat Datang!</span>
                <a href="login.php" class="login-btn">Masuk</a>
            <?php endif; ?>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navItems = document.querySelectorAll('.nav-item');
        const indicator = document.querySelector('.nav-indicator');
        
        // Set initial position for the indicator
        function setIndicator(element) {
            indicator.style.width = `${element.offsetWidth}px`;
            indicator.style.height = `${element.offsetHeight}px`;
            indicator.style.left = `${element.offsetLeft}px`;
            indicator.style.top = `${element.offsetTop}px`;
        }
        
        // Find the active nav item
        const activeItem = document.querySelector('.nav-item.active') || navItems[0];
        
        // Initialize the indicator position
        setIndicator(activeItem);
        
        // Add click event to each nav item
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                setIndicator(this);
            });
        });
    });
</script>
