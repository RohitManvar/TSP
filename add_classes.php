<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/form.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="./css/font-awesome-4.7.0/css/font-awesome.css">
    <title>Add Class</title>
	<script type="text/javascript">
        function convertSpaces(event) {
            var key = event.keyCode || event.which;
            if (key === 32) {
                // If space is pressed, replace it with underscore
                event.target.value += '_';
                event.preventDefault(); // Prevent default space behavior
            }
        }

        // Handle paste event
        function handlePaste(event) {
            // Get pasted data via clipboard API
            var clipboardData = event.clipboardData || window.clipboardData;
            var pastedData = clipboardData.getData('text');
            
            // Replace spaces with underscores
            event.target.value += pastedData.replace(/\s/g, '_');
            
            // Prevent default paste behavior
            event.preventDefault();
        }
    </script>
</head>
<body>
        
    <div class="title">
        <a href="dashboard.php"><img src="./images" alt="" class="logo"></a>
        <span class="heading">Add Program</span>
        <a href="logout.php" style="color: white"><span class="fa fa-sign-out fa-2x">Logout</span></a>
    </div>

    <?php 
        include("header.php");
    ?>

    <div class="main">
        <form action="" method="post">
            <fieldset>
                <legend>Add Class</legend>
                <input type="text" name="class_name" placeholder="Class Name" onkeypress="convertSpaces(event)" onpaste="handlePaste(event)">
                <input type="text" name="class_id" placeholder="Class ID" onkeypress="convertSpaces(event)" onpaste="handlePaste(event)">
				<input type="text" name="sub1" placeholder="Subject Name 1" onkeypress="convertSpaces(event)" onpaste="handlePaste(event)">
				<input type="text" name="sub2" placeholder="Subject Name 2" onkeypress="convertSpaces(event)" onpaste="handlePaste(event)">
				<input type="text" name="sub3" placeholder="Subject Name 3" onkeypress="convertSpaces(event)" onpaste="handlePaste(event)">
				<input type="text" name="sub4" placeholder="Subject Name 4" onkeypress="convertSpaces(event)" onpaste="handlePaste(event)">
				<input type="text" name="sub5" placeholder="Subject Name 5" onkeypress="convertSpaces(event)" onpaste="handlePaste(event)">
				<input type="submit" value="Submit" name ="submit">
            </fieldset>        
        </form>
    </div>

    <div class="footer">
        <!-- <span>Designed & Coded By Jibin Thomas</span> -->
    </div>
</body>
</html>
<?php 
	include('init.php');
    include('session.php');

    if (isset($_POST['submit'])) {
		$id=$_POST['class_id'];
        $name=$_POST['class_name'];
		$s1=$_POST['sub1'];
		$s2=$_POST['sub2'];
		$s3=$_POST['sub3'];
		$s4=$_POST['sub4'];
		$s5=$_POST['sub5'];
		
		if($name == null)
		{
			echo '<script language="javascript">';
			echo 'alert("Plz Select Class")';
			echo '</script>';
			exit;
		}
		elseif($id == null)
		{
			echo '<script language="javascript">';
			echo 'alert("Plz Enter ID NO")';
			echo '</script>';
			exit;
		}elseif($s1 == null || $s2 == null || $s3 == null || $s4 == null || $s5 == null )
		{
			echo '<script language="javascript">';
			echo 'alert("Plz Enter alL subject Name")';
			echo '</script>';
			exit;
		}
		
        /*if (empty($name) or empty($id))
		{    
			if(empty($name))
               echo '<p class="error">Please enter class</p>';
		   if(empty($id))
               echo '<p class="error">Please enter class id</p>';
		   if(empty($s1))
               echo '<p class="error">Please enter 1st Subject</p>';
		   if(empty($s2))
               echo '<p class="error">Please enter 2st Subject</p>';
		   if(empty($s3))
               echo '<p class="error">Please enter 3st Subject</p>';
		   if(empty($s4))
               echo '<p class="error">Please enter 4st Subject</p>';
			if(empty($s5))
               echo '<p class="error">Please enter 5st Subject</p>';
		   
            if(preg_match("/[a-z]/i",$id))// or !preg_match("/^[a-zA-Z_]+$/", $name) )
               echo '<p class="error">Please enter valid class id</p>';
            exit();
        }
		/*$sql2 = "CREATE TABLE $name (
				Mobile_No INT(12) NOT NULL,
				username VARCHAR(20) NOT NULL,
				password VARCHAR(50) NOT NULL,
				email VARCHAR(50) NOT NULL),
				totmarks VARCHAR(10) NOT NULL,
				per DOUBLE)";*/
				
				$sql1 = "CREATE TABLE $name (
					rno INT(5) AUTO_INCREMENT PRIMARY KEY,
					name VARCHAR(55) NOT NULL,
					class_name VARCHAR(55) NOT NULL,
					$s1 VARCHAR(20) NOT NULL,
					$s2 VARCHAR(20) NOT NULL,
					$s3 VARCHAR(20) NOT NULL,
					$s4 VARCHAR(20) NOT NULL,
				$s5 VARCHAR(20) NOT NULL)";

        $sql = "INSERT INTO `class` (`name`, `id`) VALUES ('$name', '$id')";
        try {
			if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql1)  > 0) {
				echo '<script language="javascript">';
				echo 'alert("Successful")';
				echo '</script>';
			}
		} catch (mysqli_sql_exception $e) {
			// Check if the error code is due to a duplicate entry
			if ($e->getCode() == 1062) {
				echo '<script language="javascript">';
				echo 'alert("Duplicate entry for primary key or Error: ' . $e->getMessage().'")';
				echo '</script>';
			} 
		} 
    }

?>