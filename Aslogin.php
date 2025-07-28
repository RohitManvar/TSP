<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <link rel="stylesheet" href="css/formb.css">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
	<div class="title">
        <a href="dashboard.php"><img src="./images" alt="" class="logo"></a>
        <span class="heading">Test Series Performance</span>
        <a href="logout.php" style="color: white"><span class="fa fa-sign-out fa-1x">Logout</span></a>
    </div>
	
	<?php 
        include("Aheader.php");
    ?>

    <div class="login">
            <form action="./Result.php" method="get">
                <fieldset>
                    <legend class="heading">Aspirants</legend>

                    <?php
                        include('init.php');

                        $class_result=mysqli_query($conn,"SELECT `name` FROM `class`");
                            echo '<select name="class">';
                            echo '<option selected disabled>Select Class</option>';
                        while($row = mysqli_fetch_array($class_result)){
                            $display=$row['name'];
                            echo '<option value="'.$display.'">'.$display.'</option>';
                        }
                        echo'</select>'
                    ?>

                    <input type="text" name="rn" placeholder="Roll No">
					<input type="submit" name="submit" value="Get Result">
                </fieldset>
            </form>
        </div>

</body>
</html>

<?php
    /*include("init.php");
    session_start();

    if (isset($_POST["submit"]))
    {
        $username=$_POST["userid"];
        $password=$_POST["password"];
        $sql = "SELECT userid FROM admin_login WHERE userid='$username' and password = '$password'";
        $result=mysqli_query($conn,$sql);

        // $row=mysqli_fetch_array($result);
        $count=mysqli_num_rows($result);
        
        if($count==1) {
            $_SESSION['login_user']=$username;
            header("Location: dashboard.php");
        }else {
            echo '<script language="javascript">';
            echo 'alert("Invalid Username or Password")';
            echo '</script>';
        }
        
    }*/
	$username = $_SESSION['login_user'];
	
?>
