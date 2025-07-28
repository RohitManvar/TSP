<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4B61D1;
            --primary-hover: #3949b8;
            --text: #222;
            --bg: #f5f7fa;
            --card: #fff;
            --text-light: #666;
            --shadow: rgba(0, 0, 0, 0.1);
            --border: #e5e7eb;
        }

        /* Navigation Styles */
        .nav-container {
            background: var(--card);
            border-bottom: 1px solid var(--border);
            padding: 0 20px;
            box-shadow: 0 2px 10px var(--shadow);
        }

        .nav {
            display: flex;
            flex-wrap: wrap;
            gap: 0;
            max-width: 1400px;
            margin: 0 auto;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
            background: rgba(75, 97, 209, 0.05);
        }

        .nav-link i {
            margin-right: 8px;
            font-size: 1rem;
        }

        .dropdown-arrow {
            margin-left: 5px;
            font-size: 0.8rem;
            transition: transform 0.3s ease;
        }

        .nav-item:hover .dropdown-arrow {
            transform: rotate(180deg);
        }

        .dropdown-content {
            position: absolute;
            top: 100%;
            left: 0;
            background: var(--card);
            min-width: 200px;
            box-shadow: 0 8px 16px var(--shadow);
            border-radius: 8px;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            border: 1px solid var(--border);
        }

        .nav-item:hover .dropdown-content {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-content a {
            display: block;
            padding: 12px 20px;
            color: var(--text);
            text-decoration: none;
            transition: all 0.3s ease;
            border-bottom: 1px solid var(--border);
        }

        .dropdown-content a:last-child {
            border-bottom: none;
        }

        .dropdown-content a:hover {
            background: var(--primary);
            color: white;
        }

        .dropdown-content a:first-child {
            border-radius: 8px 8px 0 0;
        }

        .dropdown-content a:last-child {
            border-radius: 0 0 8px 8px;
        }

        /* Mobile Navigation */
        .mobile-nav-toggle {
            display: none;
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.2rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-container {
                padding: 10px 20px;
            }

            .mobile-nav-toggle {
                display: block;
                margin-left: auto;
            }

            .nav {
                display: none;
                flex-direction: column;
                width: 100%;
                background: var(--card);
                margin-top: 10px;
                border-radius: 8px;
                box-shadow: 0 4px 12px var(--shadow);
            }

            .nav.active {
                display: flex;
            }

            .nav-item {
                width: 100%;
                border-bottom: 1px solid var(--border);
            }

            .nav-item:last-child {
                border-bottom: none;
            }

            .nav-link {
                padding: 12px 20px;
                border-bottom: none;
                justify-content: space-between;
            }

            .dropdown-content {
                position: static;
                opacity: 1;
                visibility: visible;
                transform: none;
                box-shadow: none;
                border: none;
                background: rgba(75, 97, 209, 0.05);
                border-radius: 0;
                display: none;
            }

            .nav-item.active .dropdown-content {
                display: block;
            }

            .dropdown-content a {
                padding: 10px 40px;
                border-bottom: 1px solid var(--border);
            }
        }

        /* Page transition animation */
        .page-content {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <nav class="nav-container">
        <button class="mobile-nav-toggle" onclick="toggleMobileNav()">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="nav" id="mainNav">
            <div class="nav-item">
                <a href="Asdashboard.php" class="nav-link active">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </div>
            
            <div class="nav-item">
                <a href="Asdetails.php" class="nav-link">
                    <i class="fas fa-user-circle"></i>
                    Aspirant Details
                </a>
            </div>
            
            <div class="nav-item" onclick="toggleDropdown(this)">
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    Test Performance
                    <i class="fas fa-chevron-down dropdown-arrow"></i>
                </a>
                <div class="dropdown-content">
                    <a href="Result.php">
                        <i class="fas fa-poll"></i>
                        View Test Performance
                    </a>
                </div>
            </div>
            
            <div class="nav-item">
                <a href="Asnot.php" class="nav-link">
                    <i class="fas fa-bell"></i>
                    Notifications
                </a>
            </div>
        </div>
    </nav>

    <script>
        // Mobile navigation toggle
        function toggleMobileNav() {
            const nav = document.getElementById('mainNav');
            nav.classList.toggle('active');
        }

        // Desktop dropdown toggle for mobile
        function toggleDropdown(item) {
            if (window.innerWidth <= 768) {
                item.classList.toggle('active');
            }
        }

        // Set active nav item based on current page
        function setActiveNav() {
            const currentPage = window.location.pathname.split('/').pop();
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                const href = link.getAttribute('href');
                if (href && href.includes(currentPage)) {
                    link.classList.add('active');
                }
            });
        }

        // Close mobile nav when clicking outside
        document.addEventListener('click', function(event) {
            const nav = document.getElementById('mainNav');
            const toggle = document.querySelector('.mobile-nav-toggle');
            
            if (!nav.contains(event.target) && !toggle.contains(event.target)) {
                nav.classList.remove('active');
            }
        });

        // Initialize navigation
        document.addEventListener('DOMContentLoaded', function() {
            setActiveNav();
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.getElementById('mainNav').classList.remove('active');
            }
        });
    </script>
</body>
</html>