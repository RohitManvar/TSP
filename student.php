<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/student.css">
    <title>Result</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: auto;
        }

        .details, .main, .result, .button {
            margin-top: 20px;
        }

        .s1, .s2 {
            display: inline-block;
            vertical-align: top;
            margin-right: 20px;
        }

        .button {
            text-align: center;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <?php
        include("init.php");

        if (!isset($_GET['class'])) {
            $class = null;
        } else {
            $class = $_GET['class'];
        }
        $rn = $_GET['rn'];

        // validation
        if (empty($class) || empty($rn) || preg_match("/[a-z]/i", $rn)) {
            if (empty($class)) {
                echo '<p class="error">Please select your class</p>';
            }
            if (empty($rn)) {
                echo '<p class="error">Please enter your roll number</p>';
            }
            if (preg_match("/[a-z]/i", $rn)) {
                echo '<p class="error">Please enter a valid roll number</p>';
            }
            exit();
        }

        $name_sql = mysqli_query($conn, "SELECT `name` FROM `students` WHERE `rno`='$rn' and `class_name`='$class'");
        $name = "";
        while ($row = mysqli_fetch_assoc($name_sql)) {
            $name = $row['name'];
        }

        $result_sql = mysqli_query($conn, "SELECT `p1`, `p2`, `p3`, `p4`, `p5`, `marks`, `percentage` FROM `result` WHERE `rno`='$rn' and `class`='$class'");
        $p1 = $p2 = $p3 = $p4 = $p5 = $mark = $percentage = 0;
        if (mysqli_num_rows($result_sql) > 0) {
            while ($row = mysqli_fetch_assoc($result_sql)) {
                $p1 = $row['p1'];
                $p2 = $row['p2'];
                $p3 = $row['p3'];
                $p4 = $row['p4'];
                $p5 = $row['p5'];
                $mark = $row['marks'];
                $percentage = $row['percentage'];
            }
        } else {
            echo "<p>No result</p>";
            exit();
        }
    ?>

    <div class="container">
        <div class="details">
            <span>Name:</span> <?php echo $name; ?> <br>
            <span>Class:</span> <?php echo $class; ?> <br>
            <span>Roll No:</span> <?php echo $rn; ?> <br>
        </div>

        <div class="main">
            <div class="s1">
                <p>Subjects</p>
                <p>Paper 1</p>
                <p>Paper 2</p>
                <p>Paper 3</p>
                <p>Paper 4</p>
                <p>Paper 5</p>
            </div>
            <div class="s2">
                <p>Marks</p>
                <?php echo '<p>' . $p1 . '</p>'; ?>
                <?php echo '<p>' . $p2 . '</p>'; ?>
                <?php echo '<p>' . $p3 . '</p>'; ?>
                <?php echo '<p>' . $p4 . '</p>'; ?>
                <?php echo '<p>' . $p5 . '</p>'; ?>
            </div>
        </div>

        <div class="result">
            <?php echo '<p>Total Marks: ' . $mark . '</p>'; ?>
            <?php echo '<p>Percentage: ' . $percentage . '%</p>'; ?>
        </div>

        <div class="button">
            <button onclick="window.print()">Print Result</button>
        </div>
    </div>
</body>
</html>
