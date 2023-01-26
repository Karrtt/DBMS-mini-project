<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
?>
<!DOCTYPE html>
<html>
<head>
	<style>
		
		#navbar {
		overflow: hidden;
		background-color: #333;
		display: flex;
 		justify-content: center;
  		align-items: center;
		}

		/* Navbar links */
		#navbar a {
		float: left;
		display: block;
		font-family: Georgia, serif;
		font-size:32px;
		color: #f2f2f2;
		text-align: center;
		padding: 14px;
		text-decoration: none;
		}

		/* Page content */
		.content {
		padding: 16px;
		}

		/* The sticky class is added to the navbar with JS when it reaches its scroll position */
		.sticky {
		position: fixed;
		top: 0;
		width: 100%;
		}

		/* Add some top padding to the page content to prevent sudden quick movement (as the navigation bar gets a new position at the top of the page (position:fixed and top:0) */
		.sticky + .content {
		padding-top: 60px;
		}</style>
	
	<div id="navbar">
	<a href="branch.php" class = "active" >Branch</a>
	<a href="customer.php">Customer</a>
	<a href="account.php">Account</a>
	<a href="link.php">Link</a>
	<a href="display.php"  >Display</a>
	</div>

	<br><br>
<title  >Branch Registration Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2 style="font-family:'Georgia';font-size:25px">Branch Registration </h2></center>
		<form action="branch.php" method="post">
			<div class="imgcontainer">
				<img src="imgs/bank.png" alt="Avatar" class="avatar">
			</div>
			<div class="inner_container">
				<label style="font-family:'Consolas';font-size:18px"><b>Code</b></label>
				<input type="text" value=<?php echo $_SESSION['Code'];?> name="code" disabled >
				<label style="font-family:'Consolas';font-size:18px"><b>Branch ID</b></label>
				<input type="text" name="branchid" placeholder="eg: MKM001" required>
				<label style="font-family:'Consolas';font-size:18px"><b>Branch Name</b></label>
				<input type="text" name="name" >
				<label style="font-family:'Consolas';font-size:18px"><b>Address</b></label>
				<input type="text" name="address" >
				<button name="register" class="sign_up_btn" type="submit">Register</button>
				<button name="update" class="sign_up_btn" type="submit">Update</button>
				<button name="delete" class="sign_up_btn" type="submit">Delete</button>
				
				<a href="index.php"><button type="button" class="back_btn"><< Back to Homepage</button></a>
			</div>
		</form>
		
		<?php
			if(isset($_POST['register']))
			{
				@$code=$_SESSION['Code'];
				@$branchid=$_POST['branchid'];
				@$name=$_POST['name'];
				@$address=$_POST['address'];
				
				if(True)
				{
					$query = "select * from branch where Code='$code'";
					#echo $query;
					$query_run = mysqli_query($con,$query);
					#echo mysqli_num_rows($query_run);
				if($query_run)
					{
						if(mysqli_num_rows($query_run)<0)
						{
							echo '<script type="text/javascript">alert("Br Already exists.. Please try another username!")</script>';
						}
						else
						{
							$query = "insert into branch values($code,'$branchid','$name','$address')";
							#echo $query;
							$query_run = mysqli_query($con,$query);
							if($query_run)
							{
								echo '<script type="text/javascript">alert("Branch Registered Successfully.. ")</script>';
								#$_SESSION['username'] = $username;
								#$_SESSION['password'] = $password;
								#header( "Location: homepage.php");
							}
							else
							{
								echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
							}
						}
					}
					else
					{
						echo '<script type="text/javascript">alert("DB error")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Password and Confirm Password do not match")</script>';
				}
				
			}
			else
			{
			}
			if(isset($_POST['delete']))
            {
				@$code=$_SESSION['Code'];
                @$Branch_ID=$_POST['branchid']; 
                $query = "delete from branch where Branch_ID='$Branch_ID' and Code=$code";
				#echo $query;
				$query_run = mysqli_query($con,$query);
				if($query_run){
                    echo '<script type="text/javascript">alert("Deleted successfully")</script>';
                }
                else{
                    echo '<script type="text/javascript">alert("Unsuccessful deletion")</script>';
                }
            }
			if(isset($_POST['update']))
			{
                
				@$branchid=$_POST['branchid'];
				@$name=$_POST['name'];
				@$address=$_POST['address'];
                
				
				if(True)
				{
					$query = "select * from branch where Branch_ID='$branchid'";
					echo $query;
					$query_run = mysqli_query($con,$query);
					echo mysqli_num_rows($query_run);
				    if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							$query = "update branch set Name ='$name',Address='$address' where Branch_ID ='$branchid'";
                            
							$query_run = mysqli_query($con,$query);
							if($query_run)
							{
								echo '<script type="text/javascript">alert("Branch Updated.. Welcome")</script>';
								
							}
							else
							{
								echo '<p class="bg-danger msg-block">Updation Unsuccessful due to server error. Please try later</p>';
							}	
						}
						else
						{	
							echo '<script type="text/javascript">alert("Nothing to update")</script>';
							
						}
					}
					else
					{
						echo '<script type="text/javascript">alert("DB error")</script>';
					}
				}
				
			}

		?>
	</div>
</body>
</html>