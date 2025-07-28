<?php
				session_start(); // ✅ must be FIRST
				include("init.php");

				$error_message = "";

				if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["userid"], $_POST["password"])) {
					$username = $_POST["userid"];
					$password = $_POST["password"];

					$stmt = $conn->prepare("SELECT name FROM `reg` WHERE `username`=? AND `password`=?");
					$stmt->bind_param("ss", $username, $password);
					$stmt->execute();
					$result = $stmt->get_result();

					if ($result->num_rows === 1) {
						$_SESSION['login_user'] = $username;
						header("Location: Asdashboard.php");
						exit();
					} else {
						$error_message = "Invalid Username or Password";
					}
				}
				?>

            <?php if (!empty($error_message)): ?>
                <div class="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?php echo $error_message; ?></span>
                </div>
            <?php endif; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspirant Login - UPSC Academy</title>
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
            background: linear-gradient(135deg, var(--primary), #7686f8);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: var(--card);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            position: relative;
        }

        .login-header {
            background: var(--primary);
            color: white;
            padding: 40px 30px 30px;
            text-align: center;
            position: relative;
        }

        .login-header::before {
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

        .logo {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .title {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitle {
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .login-form {
            padding: 40px 30px 30px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--bg);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(75, 97, 209, 0.1);
            background: white;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .login-btn {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .login-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(75, 97, 209, 0.3);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-secondary {
            flex: 1;
            background: var(--text-light);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: block;
        }

        .btn-secondary:hover {
            background: #555;
            transform: translateY(-1px);
        }

        .alert {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid var(--danger);
            color: var(--danger);
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }

        .footer-text {
            text-align: center;
            margin-top: 30px;
            color: var(--text-light);
            font-size: 0.85rem;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .login-container {
                margin: 10px;
            }
            
            .login-header {
                padding: 30px 20px 20px;
            }
            
            .title {
                font-size: 1.5rem;
            }
            
            .login-form {
                padding: 30px 20px 20px;
            }
            
            .action-buttons {
                flex-direction: column;
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
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="title">UPSC Academy</div>
            <div class="subtitle">Aspirant Login Portal</div>
        </div>

        <div class="login-form">
            
            <form action="" method="post" name="ulogin" id="loginForm">
                <div class="form-group">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="userid" class="form-input" placeholder="Username" autocomplete="off" required>
                </div>
                
                <div class="form-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" class="form-input" placeholder="Password" autocomplete="off" required>
                </div>
                
                <button type="submit" class="login-btn" id="loginBtn">
                    <span class="btn-text">Login to Dashboard</span>
                </button>
            </form>

            <div class="action-buttons">
                <a href="index.php" class="btn-secondary">
                    <i class="fas fa-home"></i> Back to Home
                </a>
                <a href="Registration.php" class="btn-secondary">
                    <i class="fas fa-user-plus"></i> Register
                </a>
            </div>

            <div class="footer-text">
                © 2024 UPSC Academy. All rights reserved.
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const loginBtn = document.getElementById('loginBtn');
            const btnText = loginBtn.querySelector('.btn-text');
            
            btnText.innerHTML = '<div class="loading"></div> Logging in...';
            loginBtn.disabled = true;
        });

        // Auto-focus on username field
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('input[name="userid"]').focus();
        });
    </script>
</body>
</html>