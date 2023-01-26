<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/style.css">
<head>
<style>#navbar {
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
		<a href="display.php">Display</a>
	</div>
	
	<br><br>
<title>Account Registration Page</title>


</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2 style="font-family:'Georgia';font-size:25px">Account Registration </h2></center>
		<form action="account.php" method="post">
			<div class="imgcontainer">
				<img src="imgs/account.png" alt="Avatar" class="avatar">
			</div>
			<div class="inner_container">
				<label style="font-family:'Consolas';font-size:18px;font-weight: bold;text-decoration: underline;">Enter account details (Enter branch id and account number to perform delete)</label>
				<br><br>
				<label style="font-family:'Consolas';font-size:18px"><b>Branch Id</b></label>
				<input type="text" name="branchid" placeholder="eg: MKM001" required>
				<label style="font-family:'Consolas';font-size:18px"><b>Customer Id</b></label>
				<input type="text" name="custid"placeholder="Enter 6 digits" >
				<label style="font-family:'Consolas';font-size:18px"><b>Account Number</b></label>
				<input type="text" name="accno" placeholder="Enter 11 digit unique account number" required>
				<label style="font-family:'Consolas';font-size:18px"><b>Account Type</b></label>
				<input type="text" name="acctype" placeholder = "NRI/Current/Savings" >
				<label style="font-family:'Consolas';font-size:18px"><b>Balance</b></label>
				<input type="text" name="accbal" >
                
				<button name="register" class="sign_up_btn" type="submit">Register</button>
				<button name="update" class="sign_up_btn" type="submit">Update</button>
                <button name="delete" class="sign_up_btn" type="submit">Delete</button>
				
				<a href="index.php"><button type="button" class="back_btn"><< Back to Homepage</button></a>
			</div>
		</form>
		
		<?php
			if(isset($_POST['register']))
			{
                #@$cbid=$_POST['cbid'];
				@$branchid=$_POST['branchid'];
				@$accno=(int)$_POST['accno'];
				@$acctype=$_POST['acctype'];
				@$balance= (int)$_POST['accbal'];
				@$custid = $_POST['custid'];
                
				
				if(True)
				{
					$query = "select * from account where Account_No=$accno";
					echo $query;
					$query_run = mysqli_query($con,$query);
					echo mysqli_num_rows($query_run);
				    if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							echo '<script type="text/javascript">alert("This Account Already exists..!")</script>';
						}
						else
						{
							$query = "insert into account values('$branchid',$accno,'$acctype',$balance)";
							
                            echo $query;
							$query_run = mysqli_query($con,$query);
							
							if($query_run)
							{
								echo '<script type="text/javascript">alert("Account Registered Successfully")</script>';
								
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
				
				
			}
			else
			{
			}
            if(isset($_POST['delete']))
            {
                @$accno=(int)$_POST['accno']; 
                $query = "delete from account where Account_No=$accno'";
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
				@$accno=(int)$_POST['accno'];
				@$acctype=$_POST['acctype'];
				@$balance= (int)$_POST['accbal'];
				
				
				if(True)
				{
					$query = "select * from account where Account_No='$accno'";
					echo $query;
					$query_run = mysqli_query($con,$query);
					echo mysqli_num_rows($query_run);
				    if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							$query = "update account set Branch_Id ='$branchid',Account_Type='$acctype' where Account_No='$accno'";
                            
							$query_run = mysqli_query($con,$query);
							if($query_run)
							{
								echo '<script type="text/javascript">alert("Account Updated.. Welcome")</script>';
								
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