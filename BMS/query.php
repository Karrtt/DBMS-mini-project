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
				<img src="imgs/bank.png" alt="Avatar" class="avatar">
			</div>
		<form action="query.php" method="post">
		
			<div class="inner_container">
				<label style="font-family:'Consolas';font-size:18px"><b>Query</b></label>
				<input type="text" name="query" required>
				
				<button class="login_button" name="sql" type="submit">Run</button>
				<br><br><br>
				<a href="index.php"><button type="button" class="back_btn"><< Back to Homepage</button></a>
			</div>
		</form>
        


        <?php
			if(isset($_POST['sql']))
			{
				@$q=$_POST['query'];
				
				$query = "$q ";
				echo $query;
				$query_run = mysqli_query($con,$query);
				if(!query_run){
                    echo '<script type="text/javascript">alert("Error")</script>';
                }
                else{
					while($row = mysqli_fetch_array($query_run)){
						echo print_r($row,'/n');
					}
                    #echo mysqli_num_rows($query_run);
                }
				
			}
			else
			{
			}
		?>
		
	</div>
</body>
</html>