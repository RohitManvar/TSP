<?php
session_start();
include('init.php');

if (isset($_SESSION['login_user'])) {
    $username = $_SESSION['login_user'];
    $sql = "SELECT * FROM `reg` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "User not found.";
    }
} else {
    header("location: ulogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - UPSC Academy</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #4B61D1;
            --primary-hover: #3949b8;
            --text: #222;
            --bg: #f5f7fa;
            --card: #fff;
            --footer-bg: #2f2f2f;
            --text-light: #666;
            --shadow: rgba(0, 0, 0, 0.1);
            --success: #10b981;
            --warning: #f59e0b;
            --border: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto", sans-serif;
        }

        body {
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* Header Styles */
        .header {
            background: var(--primary);
            padding: 15px 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            box-shadow: 0 2px 10px var(--shadow);
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .header-title {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 15px;
            border-radius: 8px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .welcome-card {
            background: linear-gradient(135deg, var(--primary), #7686f8);
            color: white;
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
        }

        .welcome-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .welcome-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Dashboard Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .info-card {
            background: var(--card);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px var(--shadow);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), #7686f8);
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px var(--shadow);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), #7686f8);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 5px;
        }

        .card-content {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .card-description {
            color: var(--text-light);
            font-size: 0.9rem;
            line-height: 1.4;
        }

        /* Quick Actions */
        .quick-actions {
            background: var(--card);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px var(--shadow);
            border: 1px solid var(--border);
            margin-bottom: 30px;
        }

        .quick-actions h3 {
            margin-bottom: 20px;
            color: var(--text);
            font-size: 1.3rem;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            background: var(--bg);
            border: 2px solid var(--border);
            border-radius: 10px;
            text-decoration: none;
            color: var(--text);
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .action-btn:hover {
            border-color: var(--primary);
            background: rgba(75, 97, 209, 0.05);
            transform: translateY(-2px);
            color: var(--primary);
        }

        .action-btn i {
            font-size: 1.2rem;
        }

        /* Stats Overview */
        .stats-overview {
            background: var(--card);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px var(--shadow);
            border: 1px solid var(--border);
        }

        .stats-overview h3 {
            margin-bottom: 20px;
            color: var(--text);
            font-size: 1.3rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 15px;
            background: var(--bg);
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Footer */
        .footer {
            background: var(--footer-bg);
            color: white;
            padding: 40px 20px 20px;
            margin-top: 60px;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            text-align: center;
        }

        .footer p {
            color: #ccc;
            margin-bottom: 8px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .header-actions {
                width: 100%;
                justify-content: space-between;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .welcome-title {
                font-size: 1.5rem;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(75, 97, 209, 0.3);
            border-radius: 50%;
            border-top-color: var(--primary);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Page Transitions */
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
    <!-- Header -->
    <header class="header">
        <div class="logo-section">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="header-title">Dashboard</div>
        </div>
        <div class="header-actions">
            <?php if (isset($user)): ?>
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <span><?php echo htmlspecialchars($user['name']); ?></span>
            </div>
            <?php endif; ?>
            <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </header>

    <?php include("Aheader.php"); ?>

    <!-- Main Content -->
    <main class="main-container">
        <div class="page-content">
            <!-- Welcome Card -->
            <div class="welcome-card">
                <div class="welcome-content">
                    <div class="welcome-title">
                        Welcome back, <?php echo isset($user) ? htmlspecialchars($user['name']) : 'Aspirant'; ?>!
                    </div>
                    <div class="welcome-subtitle">
                        Ready to continue your UPSC preparation journey?
                    </div>
                </div>
            </div>

            <!-- Dashboard Info Cards -->
            <div class="dashboard-grid">
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>
                    <div class="card-title">Aspirant Name</div>
                    <div class="card-content">
                        <?php echo isset($user) ? htmlspecialchars($user['name']) : 'N/A'; ?>
                    </div>
                    <div class="card-description">
                        Your registered name in the system
                    </div>
                </div>

                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                    </div>
                    <div class="card-title">Course Enrolled</div>
                    <div class="card-content">
                        <?php echo isset($user) ? htmlspecialchars($user['prog']) : 'N/A'; ?>
                    </div>
                    <div class="card-description">
                        Your current program of study
                    </div>
                </div>

                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                    <div class="card-title">Join Date</div>
                    <div class="card-content">
                        <?php echo isset($user) ? date('d M Y', strtotime($user['date'])) : 'N/A'; ?>
                    </div>
                    <div class="card-description">
                        Date you joined UPSC Academy
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
                <div class="action-buttons">
                    <a href="Asdetails.php" class="action-btn">
                        <i class="fas fa-user-circle"></i>
                        <span>View Profile Details</span>
                    </a>
                    <a href="Result.php" class="action-btn">
                        <i class="fas fa-chart-line"></i>
                        <span>Check Test Performance</span>
                    </a>
                    <a href="Asnot.php" class="action-btn">
                        <i class="fas fa-bell"></i>
                        <span>View Notifications</span>
                    </a>
                    <a href="#" class="action-btn" onclick="showStudyTips()">
                        <i class="fas fa-lightbulb"></i>
                        <span>Study Tips</span>
                    </a>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="stats-overview">
                <h3><i class="fas fa-chart-bar"></i> Your Progress Overview</h3>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number" id="tests-attempted">0</div>
                        <div class="stat-label">Tests Attempted</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" id="avg-score">0%</div>
                        <div class="stat-label">Average Score</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" id="study-days">0</div>
                        <div class="stat-label">Study Days</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" id="notifications">0</div>
                        <div class="stat-label">New Notifications</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p><strong>UPSC Academy</strong> - Empowering aspirants with quality education</p>
            <p>&copy; 2024 UPSC Academy. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Animate stats on page load
        function animateStats() {
            const stats = [
                { id: 'tests-attempted', target: Math.floor(Math.random() * 10) + 1 },
                { id: 'avg-score', target: Math.floor(Math.random() * 30) + 70, suffix: '%' },
                { id: 'study-days', target: Math.floor(Math.random() * 100) + 50 },
                { id: 'notifications', target: Math.floor(Math.random() * 5) + 1 }
            ];
            
            stats.forEach(stat => {
                const element = document.getElementById(stat.id);
                let current = 0;
                const increment = stat.target / 50;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= stat.target) {
                        current = stat.target;
                        clearInterval(timer);
                    }
                    element.textContent = Math.floor(current) + (stat.suffix || '');
                }, 50);
            });
        }

        // Show study tips modal
        function showStudyTips() {
            const tips = [
                "Create a structured daily study schedule and stick to it.",
                "Focus on current affairs - read newspapers daily.",
                "Practice answer writing regularly for mains preparation.",
                "Take mock tests to improve your speed and accuracy.",
                "Revise previously covered topics weekly.",
                "Join study groups for better understanding and motivation."
            ];
            
            const randomTip = tips[Math.floor(Math.random() * tips.length)];
            alert("💡 Study Tip:\n\n" + randomTip);
        }

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            animateStats();
            
            // Add greeting based on time
            const hour = new Date().getHours();
            let greeting = "Good morning";
            if (hour >= 12 && hour < 17) greeting = "Good afternoon";
            else if (hour >= 17) greeting = "Good evening";
            
            const welcomeTitle = document.querySelector('.welcome-title');
            if (welcomeTitle) {
                welcomeTitle.textContent = greeting + ", " + welcomeTitle.textContent.split(', ')[1];
            }
        });

        // Add loading states to action buttons
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (this.getAttribute('href') !== '#') {
                    const icon = this.querySelector('i');
                    const originalIcon = icon.className;
                    icon.className = 'loading';
                    
                    setTimeout(() => {
                        icon.className = originalIcon;
                    }, 1000);
                }
            });
        });
    </script>
</body>
</html>