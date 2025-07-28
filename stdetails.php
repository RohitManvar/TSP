<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/home.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="./css/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type='text/css' href="css/manage.css">
</head>
<body>
<div class="title">
        <a href="dashboard.php"></a>
        <span class="heading">Manage Program</span>
        <a href="logout.php" style="color: white"><span class="fa fa-sign-out fa-2x">Logout</span></a>
    </div>
	<?php 
        include("header.php");
    ?>
	<div class="main">
		<?php
			include("init.php");
			session_start();
			if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_co'])) {
			// Delete the student based on the name and class sent through POST
			$delete_co = $_POST['delete_co']; // Corrected variable name
			$delete_nm = $_POST['delete_nm'];
			$delete_co_lower = strtolower($delete_co);
			//	echo $delete_co_lower;
			$delete_sql = "DELETE FROM `$delete_co_lower` WHERE `name` = '$delete_nm'"; // Use $delete_co instead of $nam
			mysqli_query($conn, $delete_sql);
			$delete_q = "DELETE FROM `all_asp_info` WHERE `class_name`='$delete_co' and `fullname` = '$delete_nm'";
			mysqli_query($conn, $delete_q);
			// Redirect to avoid duplicate deletion on page refresh
			header("Location: ".$_SERVER['PHP_SELF']);
			exit();
			}
			include("init.php");
				$nam = $_SESSION['selected_class'];
				$name = strtolower($nam);
				
				$sql = "SELECT `name`,`rno`,`class_name` FROM $name";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
				   echo "<table>
					<caption>Manage Students</caption>
					<tr>
					<th>Roll No</th>
					<th>Name</th>
					<th> Delete Class</th>
					</tr>";

					while($row = mysqli_fetch_array($result))
					  {
						echo "<tr>";
						echo "<td>" . $row['rno'] . "</td>";
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . '<form method="post" action="">
                         <input type="hidden" name="delete_co" value="'.$row['class_name'].'">
						 <input type="hidden" name="delete_nm" value="' . $row['name'] . '">
						 <button type="submit">Delete</button>
                       </form>' . "</td>";
					  }

					echo "</table>";
				} else {
					echo "0 Students";
				}
		
          
?>

<center><a href="manage_students.php"><button type="submit">Back</button></a></center>
</body>
</html>
