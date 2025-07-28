<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPSC Academy | Management System</title>
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

        body.dark {
            --primary: #6a80ff;
            --primary-hover: #5a70ef;
            --text: #f1f1f1;
            --bg: #121212;
            --card: #1e1e2d;
            --footer-bg: #1b1b1b;
            --text-light: #888;
            --shadow: rgba(255, 255, 255, 0.05);
            --border: #374151;
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
            transition: all 0.3s ease;
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

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 10px;
            font-size: 1.8rem;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .theme-switch {
            display: flex;
            align-items: center;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
            margin-left: 10px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(255,255,255,0.3);
            border-radius: 34px;
            transition: 0.4s;
            cursor: pointer;
        }

        .slider:before {
            content: "";
            position: absolute;
            height: 20px; width: 20px;
            left: 3px; bottom: 3px;
            background-color: white;
            border-radius: 50%;
            transition: 0.4s;
        }

        input:checked + .slider:before {
            transform: translateX(24px);
        }

        .logout-btn {
            background: rgba(255,255,255,0.2);
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
            background: rgba(255,255,255,0.3);
        }

        /* Navigation Styles */
        .nav-container {
            background: var(--card);
            border-bottom: 1px solid var(--border);
            padding: 0 20px;
        }

        .nav {
            display: flex;
            flex-wrap: wrap;
            gap: 0;
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

        /* Main Content */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--card);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px var(--shadow);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), #7686f8);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px var(--shadow);
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .stat-icon {
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

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Page Content */
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

        /* Form Styles */
        .form-container {
            background: var(--card);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px var(--shadow);
            border: 1px solid var(--border);
            margin-bottom: 30px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text);
        }

        .form-input, .form-select {
            padding: 12px 16px;
            border: 2px solid var(--border);
            border-radius: 8px;
            background: var(--bg);
            color: var(--text);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(75, 97, 209, 0.1);
        }

        .form-button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .form-button:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .form-button.secondary {
            background: var(--text-light);
        }

        .form-button.danger {
            background: var(--danger);
        }

        /* Table Styles */
        .table-container {
            background: var(--card);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px var(--shadow);
            border: 1px solid var(--border);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: var(--primary);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 500;
        }

        .table td {
            padding: 15px;
            border-bottom: 1px solid var(--border);
        }

        .table tbody tr:hover {
            background: rgba(75, 97, 209, 0.05);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-small {
            padding: 6px 12px;
            font-size: 0.8rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: var(--warning);
            color: white;
        }

        .btn-delete {
            background: var(--danger);
            color: white;
        }

        .btn-small:hover {
            transform: translateY(-1px);
        }

        /* Alert Styles */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert.success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid var(--success);
            color: var(--success);
        }

        .alert.error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid var(--danger);
            color: var(--danger);
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
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .footer-section h4 {
            margin-bottom: 15px;
            color: white;
        }

        .footer-section p, .footer-section a {
            color: #ccc;
            text-decoration: none;
            margin-bottom: 8px;
            display: block;
        }

        .footer-section a:hover {
            color: white;
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

            .nav {
                flex-direction: column;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .table-container {
                overflow-x: auto;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
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
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            <span>UPSC Academy</span>
        </div>
        <div class="header-actions">
            <div class="theme-switch">
                <label for="theme-toggle">Dark Mode</label>
                <label class="switch">
                    <input type="checkbox" id="theme-toggle" onchange="toggleTheme()">
                    <span class="slider"></span>
                </label>
            </div>
            <a href="#" class="logout-btn" onclick="logout()">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="nav-container">
        <div class="nav">
            <div class="nav-item">
                <a href="#" class="nav-link active" onclick="showPage('dashboard')">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-graduation-cap"></i>
                    Programs <i class="fas fa-chevron-down"></i>
                </a>
                <div class="dropdown-content">
                    <a href="#" onclick="showPage('add-program')">Add Program</a>
                    <a href="#" onclick="showPage('manage-programs')">Manage Programs</a>
                </div>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i>
                    Aspirants <i class="fas fa-chevron-down"></i>
                </a>
                <div class="dropdown-content">
                    <a href="#" onclick="showPage('add-aspirant')">Add Aspirants</a>
                    <a href="#" onclick="showPage('manage-aspirants')">Manage Aspirants</a>
                </div>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    Test Performance <i class="fas fa-chevron-down"></i>
                </a>
                <div class="dropdown-content">
                    <a href="#" onclick="showPage('add-results')">Add Performance</a>
                    <a href="#" onclick="showPage('manage-results')">Manage Performance</a>
                </div>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-bell"></i>
                    Notifications <i class="fas fa-chevron-down"></i>
                </a>
                <div class="dropdown-content">
                    <a href="#" onclick="showPage('add-notification')">Add Notification</a>
                    <a href="#" onclick="showPage('manage-notifications')">Manage Notifications</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-container">
        <!-- Dashboard Page -->
        <div id="dashboard" class="page-content">
            <div class="page-header">
                <h1 class="page-title">Dashboard</h1>
                <div class="breadcrumb">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                    </div>
                    <div class="stat-number" id="total-programs">12</div>
                    <div class="stat-label">Total Programs</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-number" id="total-students">245</div>
                    <div class="stat-label">Total Aspirants</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                    <div class="stat-number" id="total-results">189</div>
                    <div class="stat-label">Results Published</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                    </div>
                    <div class="stat-number">78.5%</div>
                    <div class="stat-label">Average Performance</div>
                </div>
            </div>
        </div>

        <!-- Add Program Page -->
        <div id="add-program" class="page-content" style="display: none;">
            <div class="page-header">
                <h1 class="page-title">Add Program</h1>
                <div class="breadcrumb">
                    <a href="#" onclick="showPage('dashboard')">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Add Program</span>
                </div>
            </div>

            <div class="form-container">
                <form id="add-program-form">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Program Name</label>
                            <input type="text" class="form-input" name="program_name" placeholder="Enter program name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Program ID</label>
                            <input type="text" class="form-input" name="program_id" placeholder="Enter program ID" required>
                        </div>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Subject 1</label>
                            <input type="text" class="form-input" name="subject1" placeholder="Subject name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subject 2</label>
                            <input type="text" class="form-input" name="subject2" placeholder="Subject name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subject 3</label>
                            <input type="text" class="form-input" name="subject3" placeholder="Subject name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subject 4</label>
                            <input type="text" class="form-input" name="subject4" placeholder="Subject name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subject 5</label>
                            <input type="text" class="form-input" name="subject5" placeholder="Subject name" required>
                        </div>
                    </div>

                    <button type="submit" class="form-button">
                        <i class="fas fa-plus"></i>
                        Add Program
                    </button>
                </form>
            </div>
        </div>

        <!-- Manage Programs Page -->
        <div id="manage-programs" class="page-content" style="display: none;">
            <div class="page-header">
                <h1 class="page-title">Manage Programs</h1>
                <div class="breadcrumb">
                    <a href="#" onclick="showPage('dashboard')">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Manage Programs</span>
                </div>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Program ID</th>
                            <th>Program Name</th>
                            <th>Subjects</th>
                            <th>Students</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="programs-table">
                        <tr>
                            <td>UPSC001</td>
                            <td>Civil Services Preliminary</td>
                            <td>5 Subjects</td>
                            <td>45 Students</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-small btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn-small btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>UPSC002</td>
                            <td>Civil Services Mains</td>
                            <td>5 Subjects</td>
                            <td>38 Students</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-small btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn-small btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Aspirant Page -->
        <div id="add-aspirant" class="page-content" style="display: none;">
            <div class="page-header">
                <h1 class="page-title">Add Aspirants</h1>
                <div class="breadcrumb">
                    <a href="#" onclick="showPage('dashboard')">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Add Aspirants</span>
                </div>
            </div>

            <div class="form-container">
                <form id="add-aspirant-form">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Select Program</label>
                            <select class="form-select" name="program" required>
                                <option value="">Select Program</option>
                                <option value="UPSC001">Civil Services Preliminary</option>
                                <option value="UPSC002">Civil Services Mains</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Upload Student Data (Excel/CSV)</label>
                            <input type="file" class="form-input" name="student_file" accept=".xlsx,.xls,.csv" required>
                        </div>
                    </div>

                    <button type="submit" class="form-button">
                        <i class="fas fa-upload"></i>
                        Upload Students
                    </button>
                </form>
            </div>
        </div>

        <!-- Add Results Page -->
        <div id="add-results" class="page-content" style="display: none;">
            <div class="page-header">
                <h1 class="page-title">Add Test Performance</h1>
                <div class="breadcrumb">
                    <a href="#" onclick="showPage('dashboard')">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Add Performance</span>
                </div>
            </div>

            <div class="form-container">
                <form id="add-results-form">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Select Program</label>
                            <select class="form-select" name="program" required>
                                <option value="">Select Program</option>
                                <option value="UPSC001">Civil Services Preliminary</option>
                                <option value="UPSC002">Civil Services Mains</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Roll Number</label>
                            <input type="text" class="form-input" name="roll_no" placeholder="Enter roll number" required>
                        </div>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Subject 1 Marks</label>
                            <input type="number" class="form-input" name="marks1" placeholder="Enter marks" min="0" max="100" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subject 2 Marks</label>
                            <input type="number" class="form-input" name="marks2" placeholder="Enter marks" min="0" max="100" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subject 3 Marks</label>
                            <input type="number" class="form-input" name="marks3" placeholder="Enter marks" min="0" max="100" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subject 4 Marks</label>
                            <input type="number" class="form-input" name="marks4" placeholder="Enter marks" min="0" max="100" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subject 5 Marks</label>
                            <input type="number" class="form-input" name="marks5" placeholder="Enter marks" min="0" max="100" required>
                        </div>
                    </div>

                    <button type="submit" class="form-button">
                        <i class="fas fa-save"></i>
                        Save Results
                    </button>
                </form>
            </div>
        </div>

        <!-- Add Notification Page -->
        <div id="add-notification" class="page-content" style="display: none;">
            <div class="page-header">
                <h1 class="page-title">Add Notification</h1>
                <div class="breadcrumb">
                    <a href="#" onclick="showPage('dashboard')">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Add Notification</span>
                </div>
            </div>

            <div class="form-container">
                <form id="add-notification-form">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Notification Title</label>
                            <input type="text" class="form-input" name="notification_title" placeholder="Enter notification title" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Notification Description</label>
                        <textarea class="form-input" name="notification_description" rows="4" placeholder="Enter notification description" required style="resize: vertical; min-height: 100px;"></textarea>
                    </div>

                    <button type="submit" class="form-button">
                        <i class="fas fa-bell"></i>
                        Add Notification
                    </button>
                </form>
            </div>
        </div>

        <!-- Manage Aspirants Page -->
        <div id="manage-aspirants" class="page-content" style="display: none;">
            <div class="page-header">
                <h1 class="page-title">Manage Aspirants</h1>
                <div class="breadcrumb">
                    <a href="#" onclick="showPage('dashboard')">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Manage Aspirants</span>
                </div>
            </div>

            <div class="form-container">
                <form id="select-program-form">
                    <div class="form-group">
                        <label class="form-label">Select Program</label>
                        <select class="form-select" name="program" required onchange="loadStudents(this.value)">
                            <option value="">Select Program</option>
                            <option value="UPSC001">Civil Services Preliminary</option>
                            <option value="UPSC002">Civil Services Mains</option>
                        </select>
                    </div>
                    <button type="button" class="form-button" onclick="showStudents()">
                        <i class="fas fa-search"></i>
                        Show Students
                    </button>
                </form>
            </div>

            <div id="students-table-container" class="table-container" style="display: none;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Roll No</th>
                            <th>Name</th>
                            <th>Program</th>
                            <th>Total Marks</th>
                            <th>Percentage</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="students-table">
                        <!-- Students will be loaded here dynamically -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Manage Results Page -->
        <div id="manage-results" class="page-content" style="display: none;">
            <div class="page-header">
                <h1 class="page-title">Manage Test Performance</h1>
                <div class="breadcrumb">
                    <a href="#" onclick="showPage('dashboard')">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Manage Performance</span>
                </div>
            </div>

            <div class="form-container">
                <form id="delete-results-form">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Select Program</label>
                            <select class="form-select" name="program" required>
                                <option value="">Select Program</option>
                                <option value="UPSC001">Civil Services Preliminary</option>
                                <option value="UPSC002">Civil Services Mains</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Roll Number</label>
                            <input type="text" class="form-input" name="roll_no" placeholder="Enter roll number" required>
                        </div>
                    </div>

                    <button type="submit" class="form-button danger">
                        <i class="fas fa-trash"></i>
                        Delete Performance
                    </button>
                </form>
            </div>
        </div>

        <!-- Manage Notifications Page -->
        <div id="manage-notifications" class="page-content" style="display: none;">
            <div class="page-header">
                <h1 class="page-title">Manage Notifications</h1>
                <div class="breadcrumb">
                    <a href="#" onclick="showPage('dashboard')">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Manage Notifications</span>
                </div>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="notifications-table">
                        <tr>
                            <td>1</td>
                            <td>Exam Schedule Updated</td>
                            <td>The preliminary exam schedule has been updated. Please check the new dates.</td>
                            <td>2024-01-15</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-small btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn-small btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>New Study Material Available</td>
                            <td>Latest study materials for current affairs have been uploaded to the portal.</td>
                            <td>2024-01-10</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-small btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn-small btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>Contact Information</h4>
                <p>Rohit Manvar: rohitmanvar@gmail.com</p>
                <p>Phone: +91-0000777777</p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <a href="#" onclick="showPage('dashboard')">Dashboard</a>
                <a href="#" onclick="showPage('add-program')">Add Program</a>
                <a href="#" onclick="showPage('manage-programs')">Manage Programs</a>
                <a href="#" onclick="showPage('add-aspirant')">Add Aspirants</a>
            </div>
            <div class="footer-section">
                <h4>Follow Us</h4>
                <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
                <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#"><i class="fab fa-youtube"></i> YouTube</a>
                <a href="#"><i class="fab fa-linkedin"></i> LinkedIn</a>
            </div>
            <div class="footer-section">
                <h4>About UPSC Academy</h4>
                <p>Empowering aspirants with quality education and comprehensive preparation for UPSC examinations.</p>
                <p>&copy; 2024 UPSC Academy. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Theme Management
        function toggleTheme() {
            document.body.classList.toggle('dark');
            const isDark = document.body.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

        // Load saved theme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.body.classList.add('dark');
            document.getElementById('theme-toggle').checked = true;
        }

        // Page Navigation
        function showPage(pageId) {
            // Hide all pages
            const pages = document.querySelectorAll('.page-content');
            pages.forEach(page => page.style.display = 'none');
            
            // Show selected page
            document.getElementById(pageId).style.display = 'block';
            
            // Update active nav link
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => link.classList.remove('active'));
            
            // Add active class to current nav item based on page
            const activeNavMap = {
                'dashboard': 0,
                'add-program': 1,
                'manage-programs': 1,
                'add-aspirant': 2,
                'manage-aspirants': 2,
                'add-results': 3,
                'manage-results': 3,
                'add-notification': 4,
                'manage-notifications': 4
            };
            
            if (activeNavMap[pageId] !== undefined) {
                navLinks[activeNavMap[pageId]].classList.add('active');
            }
        }

        // Form Handlers
        document.getElementById('add-program-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<div class="loading"></div> Adding...';
            submitBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                showAlert('Program added successfully!', 'success');
                this.reset();
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 1500);
        });

        document.getElementById('add-aspirant-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<div class="loading"></div> Uploading...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                showAlert('Students uploaded successfully!', 'success');
                this.reset();
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        });

        document.getElementById('add-results-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<div class="loading"></div> Saving...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                showAlert('Results saved successfully!', 'success');
                this.reset();
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 1500);
        });

        document.getElementById('add-notification-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<div class="loading"></div> Adding...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                showAlert('Notification added successfully!', 'success');
                this.reset();
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 1500);
        });

        document.getElementById('delete-results-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (confirm('Are you sure you want to delete this performance record?')) {
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<div class="loading"></div> Deleting...';
                submitBtn.disabled = true;
                
                setTimeout(() => {
                    showAlert('Performance record deleted successfully!', 'success');
                    this.reset();
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 1500);
            }
        });

        // Alert System
        function showAlert(message, type = 'success') {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert ${type}`;
            alertDiv.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${message}</span>
            `;
            
            const mainContainer = document.querySelector('.main-container');
            mainContainer.insertBefore(alertDiv, mainContainer.firstChild);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }

        // Students Management
        function showStudents() {
            const programSelect = document.querySelector('#select-program-form select[name="program"]');
            if (!programSelect.value) {
                showAlert('Please select a program first!', 'error');
                return;
            }
            
            // Show students table with sample data
            const tableContainer = document.getElementById('students-table-container');
            const studentsTable = document.getElementById('students-table');
            
            // Sample student data
            const sampleStudents = [
                { rollNo: '001', name: 'Rajesh Kumar', program: 'Civil Services Preliminary', totalMarks: '385', percentage: '77%' },
                { rollNo: '002', name: 'Priya Sharma', program: 'Civil Services Preliminary', totalMarks: '420', percentage: '84%' },
                { rollNo: '003', name: 'Amit Singh', program: 'Civil Services Preliminary', totalMarks: '395', percentage: '79%' }
            ];
            
            studentsTable.innerHTML = '';
            sampleStudents.forEach(student => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${student.rollNo}</td>
                    <td>${student.name}</td>
                    <td>${student.program}</td>
                    <td>${student.totalMarks}</td>
                    <td>${student.percentage}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-small btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn-small btn-delete" onclick="deleteStudent('${student.rollNo}')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </td>
                `;
                studentsTable.appendChild(row);
            });
            
            tableContainer.style.display = 'block';
        }

        function deleteStudent(rollNo) {
            if (confirm(`Are you sure you want to delete student with Roll No: ${rollNo}?`)) {
                showAlert(`Student with Roll No ${rollNo} deleted successfully!`, 'success');
                showStudents(); // Refresh the table
            }
        }

        // Logout function
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                showAlert('Logging out...', 'success');
                setTimeout(() => {
                    window.location.href = 'index.html';
                }, 1500);
            }
        }

        // Delete buttons for tables
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-delete') && !e.target.onclick) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this item?')) {
                    const row = e.target.closest('tr');
                    row.remove();
                    showAlert('Item deleted successfully!', 'success');
                }
            }
        });

        // Initialize dashboard stats with animation
        function animateStats() {
            const stats = [
                { id: 'total-programs', target: 12 },
                { id: 'total-students', target: 245 },
                { id: 'total-results', target: 189 }
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
                    element.textContent = Math.floor(current);
                }, 50);
            });
        }

        // Initialize the app
        document.addEventListener('DOMContentLoaded', function() {
            animateStats();
        });
    </script>
</body>
</html>