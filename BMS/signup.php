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
		<form action="signup.php" method="post">
		
			<div class="inner_container">
				<label style="font-family:'Consolas';font-size:20px;font-weight: bold;text-decoration: underline;">Enter your bank credentials</label>
				<br><br>
				<label style="font-family:'Consolas';font-size:18px"><b>Code</b></label>
				<input type="text" name="Code" required>
				<label style="font-family:'Consolas';font-size:18px"><b>Password</b></label>
				<input type="password" name="password" required>
                <label style="font-family:'Consolas';font-size:18px"><b>Name</b></label>
				<input type="text" name="Name" required>
                <label style="font-family:'Consolas';font-size:18px"><b>Address</b></label>
				<input type="text" name="Address" required>
				<button class="login_button" name="signup" type="submit">Sign up</button>

				<br><br><br>
                <a href="index.php"><button type="button" class="back_btn"><< Back to Homepage</button></a>
			</div>
		</form>
		
		
		<?php
			if(isset($_POST['signup']))
			{
				
				@$code=(int)$_POST['Code'];
				@$password=$_POST['password'];
                @$name=$_POST['Name'];
				@$add=$_POST['Address'];
				$query = "insert into bank values('$name','$code','$password','$add')";
				#echo $query;
				$query_run = mysqli_query($con,$query);
				//echo mysql_num_rows($query_run);
				if($query_run)
				{
					echo '<script type="text/javascript">alert("Bank Registered ")</script>';
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