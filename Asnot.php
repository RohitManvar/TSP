<?php 
    include("init.php");
    $n = mysqli_query($conn, "SELECT title, notification FROM `notify` ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notifications - UPSC Academy</title>
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
            --info: #3b82f6;
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
            max-width: 1200px;
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
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .title-icon {
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

        /* Notifications Container */
        .notifications-container {
            background: var(--card);
            border-radius: 16px;
            box-shadow: 0 4px 12px var(--shadow);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .container-header {
            background: linear-gradient(135deg, var(--primary), #7686f8);
            color: white;
            padding: 20px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .container-title {
            font-size: 1.3rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notification-count {
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .notifications-list {
            padding: 0;
            max-height: 70vh;
            overflow-y: auto;
        }

        /* Custom Scrollbar */
        .notifications-list::-webkit-scrollbar {
            width: 8px;
        }

        .notifications-list::-webkit-scrollbar-track {
            background: var(--bg);
        }

        .notifications-list::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 4px;
        }

        .notifications-list::-webkit-scrollbar-thumb:hover {
            background: var(--text-light);
        }

        /* Notification Items */
        .notification-item {
            padding: 25px 30px;
            border-bottom: 1px solid var(--border);
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item:hover {
            background: rgba(75, 97, 209, 0.02);
            transform: translateX(5px);
        }

        .notification-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--primary);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .notification-item:hover::before {
            transform: scaleY(1);
        }

        .notification-header {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 12px;
        }

        .notification-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--info), #60a5fa);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .notification-content {
            flex: 1;
        }

        .notification-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .notification-text {
            color: var(--text-light);
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .notification-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Empty State */
        .empty-state {
            padding: 60px 30px;
            text-align: center;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: rgba(75, 97, 209, 0.1);
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 20px;
        }

        .empty-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--text);
            margin-bottom: 10px;
        }

        .empty-description {
            color: var(--text-light);
            font-size: 1rem;
        }

        /* Floating Action */
        .floating-actions {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            z-index: 1000;
        }

        .fab {
            width: 56px;
            height: 56px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(75, 97, 209, 0.4);
        }

        .fab:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(75, 97, 209, 0.5);
        }

        /* Footer */
        .footer {
            background: var(--footer-bg);
            color: white;
            padding: 40px 20px 20px;
            margin-top: 60px;
        }

        .footer-content {
            max-width: 1200px;
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

            .page-title {
                font-size: 1.5rem;
            }

            .notification-item {
                padding: 20px 15px;
            }

            .container-header {
                padding: 15px 20px;
            }

            .floating-actions {
                bottom: 20px;
                right: 20px;
            }

            .notification-header {
                gap: 10px;
            }

            .notification-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
        }

        /* Animation for notifications */
        .notification-item {
            animation: slideInRight 0.5s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
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

        /* Notification Priority Indicators */
        .notification-item.priority-high .notification-icon {
            background: linear-gradient(135deg, var(--danger), #fca5a5);
        }

        .notification-item.priority-medium .notification-icon {
            background: linear-gradient(135deg, var(--warning), #fbbf24);
        }

        .notification-item.priority-low .notification-icon {
            background: linear-gradient(135deg, var(--success), #34d399);
        }

        /* Marquee Animation */
        .notification-marquee {
            overflow: hidden;
            white-space: nowrap;
        }

        .marquee-content {
            display: inline-block;
            animation: marquee 15s linear infinite;
            padding-left: 100%;
        }

        @keyframes marquee {
            0% { transform: translate3d(100%, 0, 0); }
            100% { transform: translate3d(-100%, 0, 0); }
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
            <div class="header-title">Notifications</div>
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
                <div class="page-title">
                    <div class="title-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <span>Notifications Center</span>
                </div>
                <div class="breadcrumb">
                    <a href="Asdashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Notifications</span>
                </div>
            </div>

            <div class="notifications-container">
                <div class="container-header">
                    <div class="container-title">
                        <i class="fas fa-inbox"></i>
                        <span>Latest Announcements</span>
                    </div>
                    <div class="notification-count">
                        <?php echo mysqli_num_rows($n); ?> notifications
                    </div>
                </div>

                <div class="notifications-list">
                    <?php if (mysqli_num_rows($n) > 0): ?>
                        <?php 
                        $delay = 0;
                        while ($row = mysqli_fetch_assoc($n)): 
                            $priority = ['high', 'medium', 'low'][array_rand(['high', 'medium', 'low'])];
                        ?>
                            <div class="notification-item priority-<?php echo $priority; ?>" style="animation-delay: <?php echo $delay * 0.1; ?>s">
                                <div class="notification-header">
                                    <div class="notification-icon">
                                        <?php
                                        $icons = ['fa-bullhorn', 'fa-info-circle', 'fa-exclamation-triangle', 'fa-calendar', 'fa-book'];
                                        echo '<i class="fas ' . $icons[array_rand($icons)] . '"></i>';
                                        ?>
                                    </div>
                                    <div class="notification-content">
                                        <div class="notification-title">
                                            <?php echo htmlspecialchars($row['title']); ?>
                                        </div>
                                        <div class="notification-text">
                                            <?php echo htmlspecialchars($row['notification']); ?>
                                        </div>
                                        <div class="notification-meta">
                                            <div class="meta-item">
                                                <i class="fas fa-clock"></i>
                                                <span><?php echo date('M d, Y'); ?></span>
                                            </div>
                                            <div class="meta-item">
                                                <i class="fas fa-tag"></i>
                                                <span>Priority: <?php echo ucfirst($priority); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        $delay++;
                        endwhile; 
                        ?>
                    <?php else: ?>
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-bell-slash"></i>
                            </div>
                            <div class="empty-title">No Notifications</div>
                            <div class="empty-description">
                                You're all caught up! Check back later for new announcements and updates.
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Floating Actions -->
    <div class="floating-actions">
        <button class="fab" onclick="refreshNotifications()" title="Refresh notifications">
            <i class="fas fa-sync-alt"></i>
        </button>
        <button class="fab" onclick="markAllRead()" title="Mark all as read">
            <i class="fas fa-check-double"></i>
        </button>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p><strong>UPSC Academy</strong> - Stay updated with latest announcements</p>
            <p>&copy; 2024 UPSC Academy. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Refresh notifications
        function refreshNotifications() {
            const fab = document.querySelector('.fab i');
            fab.classList.add('fa-spin');
            
            setTimeout(() => {
                fab.classList.remove('fa-spin');
                showToast('Notifications refreshed!', 'success');
                location.reload();
            }, 1500);
        }

        // Mark all as read
        function markAllRead() {
            const notifications = document.querySelectorAll('.notification-item');
            notifications.forEach(item => {
                item.style.opacity = '0.6';
            });
            showToast('All notifications marked as read!', 'success');
        }

        // Show toast notification
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? 'var(--success)' : 'var(--info)'};
                color: white;
                padding: 15px 20px;
                border-radius: 8px;
                font-weight: 500;
                z-index: 10000;
                animation: slideInDown 0.3s ease-out;
            `;
            toast.textContent = message;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideOutUp 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Add click handlers to notification items
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function() {
                this.style.backgroundColor = 'rgba(75, 97, 209, 0.05)';
                this.style.borderLeft = '4px solid var(--primary)';
            });
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'r' && e.ctrlKey) {
                e.preventDefault();
                refreshNotifications();
            }
        });

        // Auto-refresh every 5 minutes
        setInterval(() => {
            if (document.visibilityState === 'visible') {
                location.reload();
            }
        }, 300000);

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInDown {
                from { transform: translateY(-100px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }
            @keyframes slideOutUp {
                from { transform: translateY(0); opacity: 1; }
                to { transform: translateY(-100px); opacity: 0; }
            }
        `;
        document.head.appendChild(style);

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Add stagger animation to notification items
            const notifications = document.querySelectorAll('.notification-item');
            notifications.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.1}s`;
            });
            
            // Show welcome message if notifications exist
            if (notifications.length > 0) {
                setTimeout(() => {
                    showToast(`You have ${notifications.length} notification(s)`, 'info');
                }, 1000);
            }
        });
    </script>
</body>
</html>