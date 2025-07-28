<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UPSCAcademy | Home</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    :root {
      --primary: #4B61D1;
      --text: #222;
      --bg: #f5f7fa;
      --card: #fff;
      --footer-bg: #2f2f2f;
      --text-light: #aaa;
      --shadow: rgba(0, 0, 0, 0.1);
    }

    body.dark {
      --primary: #6a80ff;
      --text: #f1f1f1;
      --bg: #121212;
      --card: #1e1e2d;
      --footer-bg: #1b1b1b;
      --text-light: #888;
      --shadow: rgba(255, 255, 255, 0.05);
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
      transition: all 0.3s ease-in-out;
    }

    header {
      background: var(--primary);
      padding: 20px;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .logo {
      font-size: 1.5rem;
      font-weight: bold;
    }

    nav a {
      color: white;
      text-decoration: none;
      margin: 0 15px;
      font-weight: 500;
    }

    nav a:hover {
      text-decoration: underline;
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
      background-color: #ccc;
      border-radius: 34px;
      transition: 0.4s;
    }

    .slider:before {
      content: "";
      position: absolute;
      height: 20px; width: 20px;
      left: 3px;
      bottom: 3px;
      background-color: white;
      border-radius: 50%;
      transition: 0.4s;
    }

    input:checked + .slider {
      background-color: var(--primary);
    }

    input:checked + .slider:before {
      transform: translateX(24px);
    }

    .hero {
      padding: 60px 20px;
      text-align: center;
      background: linear-gradient(to right, var(--primary), #7686f8);
      color: white;
    }

    .hero h1 {
      font-size: 2.8rem;
      margin-bottom: 20px;
      animation: fadeInUp 1s ease-in-out;
    }

    .hero p {
      font-size: 1.1rem;
      max-width: 800px;
      margin: auto;
      opacity: 0.9;
      animation: fadeInUp 1.5s ease-in-out;
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

    .features {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
      padding: 60px 20px;
      max-width: 1200px;
      margin: auto;
    }

    .feature-card {
      background: var(--card);
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 8px 16px var(--shadow);
      transition: transform 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-5px);
    }

    .feature-card h3 {
      margin-bottom: 10px;
      color: var(--primary);
    }

    .feature-card p {
      color: var(--text-light);
    }

    .about {
      padding: 60px 20px;
      max-width: 1000px;
      margin: auto;
      line-height: 1.8;
    }

    .about h2 {
      color: var(--primary);
      margin-bottom: 20px;
    }

    footer {
      background: var(--footer-bg);
      color: white;
      padding: 30px 20px;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .footer-section {
      margin-bottom: 20px;
      flex: 1 1 300px;
    }

    .footer-section h4 {
      margin-bottom: 10px;
    }

    .footer-section a {
      display: block;
      color: var(--text-light);
      text-decoration: none;
      margin: 5px 0;
    }

    .footer-section a:hover {
      color: white;
    }

    @media (max-width: 768px) {
      header, .theme-switch {
        flex-direction: column;
        align-items: flex-start;
      }

      nav {
        margin-top: 10px;
      }
    }
  </style>
</head>

<body>
  <header>
    <div class="logo">UPSCAcademy</div>
    <nav>
      <a href="#">Home</a>
      <a href="login.php">Admin Login</a>
      <a href="ulogin.php">Aspirant Login</a>
      <a href="Registration.php">Register</a>
    </nav>
    <div class="theme-switch">
      <label for="theme-toggle">Dark Mode</label>
      <label class="switch">
        <input type="checkbox" id="theme-toggle" onchange="toggleTheme()" />
        <span class="slider"></span>
      </label>
    </div>
  </header>

  <section class="hero">
    <h1>Empowering Aspirants. Enabling Success.</h1>
    <p>
      Join UPSCAcademy to unlock a modern, expert-led UPSC preparation platform
      that adapts to your needs and boosts your journey toward success.
    </p>
  </section>

  <section class="about">
    <h2>About UPSCAcademy</h2>
    <p>
      Welcome to UPSCAcademy, your premier online learning destination for UPSC exam preparation. Established with a vision to redefine UPSC education, UPSCAcademy draws inspiration from the esteemed legacy of the University of Mumbai. Originating in 1857 as the University of Bombay, we proudly transitioned to the "University of Mumbai" in 1996, aligning with the city's nomenclature change.

      Recognized with a 5-star status in 2001 and an 'A' grade in 2012 by NAAC, UPSCAcademy stands as a University with Potential for Excellence (UPE) endorsed under the PURSE Scheme by DST. Our commitment to excellence is unwavering, and we strive to be a beacon of academic brilliance.

      At UPSCAcademy, we comprehend the challenges of UPSC preparation. Our platform offers an array of courses, study materials, and expert guidance, catering to the diverse needs of aspirants. Whether you're a novice or an experienced candidate, our comprehensive resources empower you to navigate the intricate landscape of UPSC exams.

      Key Features:
      - Comprehensive Course Offerings: Covering the entire UPSC syllabus with detailed study plans.
      - Expert Educators: Learn from passionate and experienced educators dedicated to your success.
      - Interactive Learning: Engage in live sessions, quizzes, and discussions for an immersive learning experience.
      - Personalized Study Plans: Tailored study schedules to match your pace and requirements.
      - Exam Strategies and Mock Tests: Hone your skills with strategic approaches and regular mock tests.

      Join UPSCAcademy and embark on a transformative journey towards success!
    </p>
  </section>

  <section class="features">
    <div class="feature-card">
      <h3><i class="fas fa-book"></i> Comprehensive Courses</h3>
      <p>Access complete UPSC syllabus with curated materials and structured plans.</p>
    </div>
    <div class="feature-card">
      <h3><i class="fas fa-user-tie"></i> Expert Educators</h3>
      <p>Learn from passionate, top-rated teachers dedicated to your growth.</p>
    </div>
    <div class="feature-card">
      <h3><i class="fas fa-chalkboard-teacher"></i> Live Classes</h3>
      <p>Attend interactive classes, real-time doubt solving, and discussions.</p>
    </div>
    <div class="feature-card">
      <h3><i class="fas fa-file-alt"></i> Test Series</h3>
      <p>Practice with real exam-level mock tests and analytics for improvement.</p>
    </div>
    <div class="feature-card">
      <h3><i class="fas fa-pen-fancy"></i> Personalized Plans</h3>
      <p>Get tailored schedules that suit your pace and study goals.</p>
    </div>
    <div class="feature-card">
      <h3><i class="fas fa-award"></i> Results & Scholarships</h3>
      <p>Track performance and apply for merit-based scholarships with ease.</p>
    </div>
  </section>

  <footer>
    <div class="footer-section">
      <h4>Contact</h4>
      <p>Rohit Manvar: rohitmanvar@gmail.com | +91-0000777777</p>
      <p>Nayan Marthak: nayanmarthak@gmail.com | +91-0000887777</p>
    </div>
    <div class="footer-section">
      <h4>Quick Links</h4>
      <a href="login.php">Admin Login</a>
      <a href="ulogin.php">Results</a>
      <a href="Registration.php">Register</a>
    </div>
    <div class="footer-section">
      <h4>Follow Us</h4>
      <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
      <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
      <a href="#"><i class="fab fa-youtube"></i> YouTube</a>
    </div>
  </footer>

  <script>
    const toggle = document.getElementById("theme-toggle");
    const isDark = localStorage.getItem("theme") === "dark";
    if (isDark) {
      document.body.classList.add("dark");
      toggle.checked = true;
    }
    function toggleTheme() {
      document.body.classList.toggle("dark");
      const newTheme = document.body.classList.contains("dark") ? "dark" : "light";
      localStorage.setItem("theme", newTheme);
    }
  </script>
</body>
</html>
