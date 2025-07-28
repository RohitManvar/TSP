<?php
		ob_start(); // (Optional but helpful) Start output buffering to catch accidental output
		include("init.php");
		session_start();
		error_reporting(E_ERROR | E_PARSE);

		$username = $_SESSION['login_user'];
		$sql = "SELECT * FROM `reg` WHERE `username` = '$username'";
		$result2 = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result2) > 0) {
			while($row2 = mysqli_fetch_array($result2)) {
				$nm = $row2['name'];
				$class = $row2['prog'];
				$dt = $row2['date'];
			}
		} else {
			echo "User not found.";
			exit();
		}
        
        $query = "SHOW COLUMNS FROM $class";
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            $columns = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $columns[] = $row['Field'];
            }
            
            if (count($columns) >= 8) {
                $id = $columns[0];
                $name = $columns[1];
                $cl = $columns[2];
                $sub1 = $columns[3];
                $sub2 = $columns[4];
                $sub3 = $columns[5];
                $sub4 = $columns[6];
                $sub5 = $columns[7];
            } else {
                echo "Not enough columns available.";
                exit();
            }
        }
        
        $sql = "SELECT * FROM `$class` WHERE `name` = '$nm' and `class_name`='$class'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
                $rn = $row['rno'];
                $nm = $row['name'];
                $pro = $row['class_name'];
                $s1 = $row[$sub1];
                $s2 = $row[$sub2];
                $s3 = $row[$sub3];
                $s4 = $row[$sub4];
                $s5 = $row[$sub5];
            }
            
            if(empty($s1)) {
                $no_result = true;
            } else {
                $total_marks = $s1 + $s2 + $s3 + $s4 + $s5;
                $percentage = ($total_marks / 500) * 100;
                $no_result = false;
            }
        } else {
            echo "User not found.";
            exit();
        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Performance - UPSC Academy</title>
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
            --danger: #ef4444;
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

        /* Main Content */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--text);
            margin-bottom: 10px;
        }

        .page-subtitle {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        /* Result Card */
        .result-container {
            background: var(--card);
            border-radius: 20px;
            box-shadow: 0 10px 30px var(--shadow);
            overflow: hidden;
            border: 1px solid var(--border);
            margin-bottom: 30px;
        }

        .result-header {
            background: linear-gradient(135deg, var(--primary), #7686f8);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .result-header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 20px;
            background: var(--card);
            border-radius: 20px 20px 0 0;
        }

        .student-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .info-item {
            text-align: center;
        }

        .info-label {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 1.3rem;
            font-weight: bold;
        }

        /* Marks Section */
        .marks-section {
            padding: 40px 30px;
        }

        .section-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--text);
            margin-bottom: 30px;
        }

        .marks-table {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 40px;
        }

        .subjects-column, .marks-column {
            background: var(--bg);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .column-header {
            background: var(--primary);
            color: white;
            padding: 15px 20px;
            font-size: 1.2rem;
            font-weight: 600;
            text-align: center;
        }

        .column-content {
            padding: 0;
        }

        .table-row {
            padding: 15px 20px;
            border-bottom: 1px solid var(--border);
            font-size: 1.1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .table-row:last-child {
            border-bottom: none;
        }

        .table-row:hover {
            background: rgba(75, 97, 209, 0.05);
        }

        .marks-column .table-row {
            text-align: center;
            color: var(--primary);
            font-weight: 600;
        }

        /* Summary Section */
        .summary-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: var(--card);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px var(--shadow);
            border: 1px solid var(--border);
            text-align: center;
            transition: all 0.3s ease;
        }

        .summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px var(--shadow);
        }

        .summary-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 15px;
            color: white;
        }

        .total-marks .summary-icon {
            background: linear-gradient(135deg, var(--primary), #7686f8);
        }

        .percentage .summary-icon {
            background: linear-gradient(135deg, var(--success), #34d399);
        }

        .summary-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-light);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .summary-value {
            font-size: 2rem;
            font-weight: bold;
            color: var(--text);
        }

        /* Performance Indicator */
        .performance-indicator {
            background: var(--card);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px var(--shadow);
            border: 1px solid var(--border);
            text-align: center;
            margin-bottom: 30px;
        }

        .performance-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--text);
        }

        .progress-bar {
            background: var(--border);
            height: 12px;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), #7686f8);
            border-radius: 6px;
            transition: width 1s ease-in-out;
            position: relative;
        }

        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .grade-display {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: 600;
        }

        /* Action Button */
        .action-section {
            text-align: center;
            margin-top: 30px;
        }

        .print-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .print-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(75, 97, 209, 0.3);
        }

        /* Error State */
        .error-message {
            background: var(--card);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px var(--shadow);
            border: 1px solid var(--border);
            text-align: center;
        }

        .error-icon {
            width: 80px;
            height: 80px;
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 20px;
        }

        .error-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--danger);
            margin-bottom: 10px;
        }

        .error-description {
            color: var(--text-light);
            font-size: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .marks-table {
                grid-template-columns: 1fr;
            }

            .summary-section {
                grid-template-columns: 1fr;
            }

            .student-info {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .page-title {
                font-size: 2rem;
            }

            .result-header {
                padding: 20px;
            }

            .marks-section {
                padding: 30px 20px;
            }
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
            }
            
            .header, .action-section {
                display: none;
            }
            
            .result-container {
                box-shadow: none;
                border: 1px solid #ddd;
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
            <div class="header-title">Test Performance</div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-container">
        <div class="page-content">
            <div class="page-header">
                <h1 class="page-title">Test Performance Report</h1>
                <p class="page-subtitle">Your detailed academic performance analysis</p>
            </div>

            <?php if ($no_result): ?>
                <div class="error-message">
                    <div class="error-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="error-title">No Results Available</div>
                    <div class="error-description">
                        Your test results have not been published yet. Please check back later or contact your instructor.
                    </div>
                </div>
            <?php else: ?>
                <div class="result-container">
                    <!-- Result Header -->
                    <div class="result-header">
                        <div class="student-info">
                            <div class="info-item">
                                <div class="info-label">Student Name</div>
                                <div class="info-value"><?php echo htmlspecialchars($nm); ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Class/Program</div>
                                <div class="info-value"><?php echo htmlspecialchars($pro); ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Roll Number</div>
                                <div class="info-value"><?php echo htmlspecialchars($rn); ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Marks Section -->
                    <div class="marks-section">
                        <h2 class="section-title">Subject-wise Performance</h2>
                        
                        <div class="marks-table">
                            <div class="subjects-column">
                                <div class="column-header">Subjects</div>
                                <div class="column-content">
                                    <div class="table-row"><?php echo htmlspecialchars($sub1); ?></div>
                                    <div class="table-row"><?php echo htmlspecialchars($sub2); ?></div>
                                    <div class="table-row"><?php echo htmlspecialchars($sub3); ?></div>
                                    <div class="table-row"><?php echo htmlspecialchars($sub4); ?></div>
                                    <div class="table-row"><?php echo htmlspecialchars($sub5); ?></div>
                                </div>
                            </div>
                            
                            <div class="marks-column">
                                <div class="column-header">Marks Obtained</div>
                                <div class="column-content">
                                    <div class="table-row"><?php echo $s1; ?>/100</div>
                                    <div class="table-row"><?php echo $s2; ?>/100</div>
                                    <div class="table-row"><?php echo $s3; ?>/100</div>
                                    <div class="table-row"><?php echo $s4; ?>/100</div>
                                    <div class="table-row"><?php echo $s5; ?>/100</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary Section -->
                <div class="summary-section">
                    <div class="summary-card total-marks">
                        <div class="summary-icon">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <div class="summary-title">Total Marks</div>
                        <div class="summary-value"><?php echo $total_marks; ?>/500</div>
                    </div>
                    
                    <div class="summary-card percentage">
                        <div class="summary-icon">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <div class="summary-title">Percentage</div>
                        <div class="summary-value"><?php echo number_format($percentage, 1); ?>%</div>
                    </div>
                </div>

                <!-- Performance Indicator -->
                <div class="performance-indicator">
                    <h3 class="performance-title">Overall Performance</h3>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: <?php echo $percentage; ?>%"></div>
                    </div>
                    <div class="grade-display">
                        <i class="fas fa-trophy"></i>
                        <span>
                            <?php 
                                if ($percentage >= 90) echo "Excellent (A+)";
                                elseif ($percentage >= 80) echo "Very Good (A)";
                                elseif ($percentage >= 70) echo "Good (B+)";
                                elseif ($percentage >= 60) echo "Above Average (B)";
                                elseif ($percentage >= 50) echo "Average (C)";
                                else echo "Below Average (D)";
                            ?>
                        </span>
                    </div>
                </div>

                <!-- Action Section -->
                <div class="action-section">
                    <button onclick="window.print()" class="print-btn">
                        <i class="fas fa-print"></i>
                        <span>Print Result</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script>
        // Animate progress bar on page load
        document.addEventListener('DOMContentLoaded', function() {
            const progressFill = document.querySelector('.progress-fill');
            if (progressFill) {
                const percentage = progressFill.style.width;
                progressFill.style.width = '0%';
                setTimeout(() => {
                    progressFill.style.width = percentage;
                }, 500);
            }
            
            // Add hover effects to table rows
            document.querySelectorAll('.table-row').forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });

        // Print button functionality
        function printResult() {
            window.print();
        }

        // Add loading state to print button
        document.querySelector('.print-btn')?.addEventListener('click', function() {
            const originalContent = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Preparing...</span>';
            this.disabled = true;
            
            setTimeout(() => {
                this.innerHTML = originalContent;
                this.disabled = false;
            }, 2000);
        });
    </script>
</body>
</html>