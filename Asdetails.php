<?php
session_start();
include('init.php');

if (isset($_SESSION['login_user'])) {
    $username = $_SESSION['login_user'];
    $sql = "SELECT * FROM `reg` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $nm = $row['name'];
            $pro = $row['prog'];
            $dt = $row['date'];
        }
    } else {
        echo "User not found.";
    }
    
    $sql1 = "SELECT * FROM `all_asp_info` WHERE `fullname`='$nm' and `class_name`='$pro'";
    $data = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($data) > 0) {
        while($row = mysqli_fetch_array($data)) {
            $mob = $row['Mobile_No'];
            $em = $row['email'];
        }
    } else {
        $mob = "Not Available";
        $em = "Not Available";
    }
    
    $sql2 = "SELECT * FROM `$pro` WHERE `name`='$nm' and `class_name`='$pro'";
    $data2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($data2) > 0) {
        while($rows = mysqli_fetch_array($data2)) {
            $rno = $rows['rno'];
        }
    } else {
        $rno = "Not Assigned";
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aspirant Details - UPSC Academy</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--border);
        }

        .page-title {
            font-size: 2rem;
            font-weight: bold;
            color: var(--text);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
        }

        /* Profile Card */
        .profile-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .profile-sidebar {
            background: var(--card);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 12px var(--shadow);
            border: 1px solid var(--border);
            text-align: center;
            height: fit-content;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, var(--primary), #7686f8);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            margin: 0 auto 20px;
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--text);
            margin-bottom: 5px;
        }

        .profile-course {
            color: var(--text-light);
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .profile-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .profile-details {
            background: var(--card);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 12px var(--shadow);
            border: 1px solid var(--border);
        }

        .details-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }

        .details-icon {
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

        .details-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--text);
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .detail-item {
            padding: 20px;
            background: var(--bg);
            border-radius: 12px;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .detail-item:hover {
            border-color: var(--primary);
            background: rgba(75, 97, 209, 0.02);
        }

        .detail-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text);
            word-break: break-word;
        }

        /* Actions Section */
        .actions-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .action-card {
            background: var(--card);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px var(--shadow);
            border: 1px solid var(--border);
            text-align: center;
            transition: all 0.3s ease;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px var(--shadow);
        }

        .action-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), #7686f8);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            margin: 0 auto 15px;
        }

        .action-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 10px;
        }

        .action-description {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .action-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .action-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
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

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .profile-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .actions-section {
                grid-template-columns: 1fr;
            }
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
            <div class="header-title">Aspirant Details</div>
        </div>
        <div class="header-actions">
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
            <div class="page-header">
                <h1 class="page-title">Profile Details</h1>
                <div class="breadcrumb">
                    <a href="Asdashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Aspirant Details</span>
                </div>
            </div>

            <!-- Profile Container -->
            <div class="profile-container">
                <!-- Profile Sidebar -->
                <div class="profile-sidebar">
                    <div class="profile-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="profile-name"><?php echo htmlspecialchars($nm); ?></div>
                    <div class="profile-course"><?php echo htmlspecialchars($pro); ?></div>
                    <div class="profile-status">
                        <i class="fas fa-check-circle"></i>
                        <span>Active Aspirant</span>
                    </div>
                </div>

                <!-- Profile Details -->
                <div class="profile-details">
                    <div class="details-header">
                        <div class="details-icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <div class="details-title">Personal Information</div>
                    </div>

                    <div class="details-grid">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-hashtag"></i>
                                Roll Number
                            </div>
                            <div class="detail-value"><?php echo htmlspecialchars($rno); ?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-user"></i>
                                Full Name
                            </div>
                            <div class="detail-value"><?php echo htmlspecialchars($nm); ?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-envelope"></i>
                                Email Address
                            </div>
                            <div class="detail-value"><?php echo htmlspecialchars($em); ?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-phone"></i>
                                Mobile Number
                            </div>
                            <div class="detail-value"><?php echo htmlspecialchars($mob); ?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-book-open"></i>
                                Course Name
                            </div>
                            <div class="detail-value"><?php echo htmlspecialchars($pro); ?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-calendar-alt"></i>
                                Join Date
                            </div>
                            <div class="detail-value"><?php echo date('d M Y', strtotime($dt)); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="actions-section">
                <div class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="action-title">Test Performance</div>
                    <div class="action-description">
                        View your test results and performance analytics
                    </div>
                    <a href="Result.php" class="action-btn">View Results</a>
                </div>

                <div class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="action-title">Notifications</div>
                    <div class="action-description">
                        Check latest announcements and updates
                    </div>
                    <a href="Asnot.php" class="action-btn">View Notifications</a>
                </div>

                <div class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <div class="action-title">Dashboard</div>
                    <div class="action-description">
                        Go back to your main dashboard
                    </div>
                    <a href="Asdashboard.php" class="action-btn">Go to Dashboard</a>
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
        // Add loading states to action buttons
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const originalText = this.textContent;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                this.style.pointerEvents = 'none';
                
                setTimeout(() => {
                    window.location.href = this.getAttribute('href');
                }, 500);
            });
        });

        // Add hover effects to detail items
        document.querySelectorAll('.detail-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>