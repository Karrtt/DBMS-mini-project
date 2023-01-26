<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2 style="font-family:'Georgia';font-size:25px">Login Form</h2></center>
			<div class="imgcontainer">
				<img src="imgs/login.png" alt="Avatar" class="avatar">
			</div>
		<form action="index.php" method="post">
		
			<div class="inner_container">
				<label style="font-family:'Consolas';font-size:20px;font-weight: bold;text-decoration: underline;">Enter your bank credentials</label>
				<br><br>
				<label style="font-family:'Consolas';font-size:18px"><b>Code</b></label>
				<input type="text" name="Code" required>
				<label style="font-family:'Consolas';font-size:18px"><b>Password</b></label>
				<input type="password" name="password" required>
				<button class="login_button" name="login" type="submit">Login</button>
				<button class="login_button" ><a href="signup.php">Sign up</a></button>
				<br><br><br>
				
			</div>
		</form>
		<button class="login_button" style="background-color:red" onclick="location.href ='query.php';" name="sql" type="submit">SQL Query </button>
				<br><br>
		
		<?php
			if(isset($_POST['login']))
			{
				
				@$Code=(int)$_POST['Code'];
				@$password=$_POST['password'];
				$query = "select * from bank where Code='$Code' and Password='$password' ";
				//echo $query;
				$query_run = mysqli_query($con,$query);
				//echo mysql_num_rows($query_run);
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0)
					{
					$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
					
					$_SESSION['Code'] = $Code;
					$_SESSION['Password'] = $password;
					
					header( "Location: branch.php");
					}
					else
					{
						echo '<script type="text/javascript">alert("No such Bank exists/ Invalid Credentials")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Database Error")</script>';
				}
			}
			else
			{
			}
		?>
		
	</div>
</body>
</html>