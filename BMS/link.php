<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
?>
<!DOCTYPE html>
<html>
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
	<a href="branch.php"  >Branch</a>
	<a href="customer.php">Customer</a>
	<a href="account.php">Account</a>
	<a href="link.php" class = "active">Link</a>
    <a href="display.php">Display</a>
	</div>

	<br><br>
<title>Link Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2 style="font-family:'Georgia';font-size:25px">Account Customer Link page </h2></center>
		<form action="link.php" method="post">
			<div class="imgcontainer">
				<img src="imgs/link.png"style="border: 2px solid red;border-radius: 10px;" alt="Avatar" class="avatar">
			</div>
			<div class="inner_container">
				<label style="font-family:'Consolas';font-size:18px;font-weight: bold;text-decoration: underline;">Enter details</label>
				<br><br>
				<label style="font-family:'Consolas';font-size:18px"><b>Customer Id</b></label>
				<input type="text" name="cid" placeholder="Enter 6 digits" required>
				<label style="font-family:'Consolas';font-size:18px"><b>Account Number</b></label>
				<input type="text" name="accno" >

                
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
				@$cid=(int)$_POST['cid'];
				@$accno=(int)$_POST['accno'];
                
				
				if(True)
				{
					$query = "select * from held_by_acc_cust where Cust_ID='$cid'";
					echo $query;
					$query_run = mysqli_query($con,$query);
					echo mysqli_num_rows($query_run);
				    if($query_run)
					{
						if(mysqli_num_rows($query_run)<0)
						{
							echo '<script type="text/javascript">alert("This Customer Already exists..!")</script>';
						}
						else
						{
							$query = "insert into held_by_acc_cust values($cid,$accno)";
                            
							$query_run = mysqli_query($con,$query);
							if($query_run)
							{
								echo '<script type="text/javascript">alert("Details Registered")</script>';
								
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
                @$cid=$_POST['cid']; 
                $query = "delete from held_by_acc_cust where Cust_ID='$cid'";
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
                @$cid=$_POST['cid'];
				@$accno=(int)$_POST['accno'];
                
				
				if(True)
				{
					$query = "select * from held_by_acc_cust where Cust_ID='$cid'";
					echo $query;
					$query_run = mysqli_query($con,$query);
					echo mysqli_num_rows($query_run);
				    if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							$query = "update held_by_acc_cust set Account_No='$accno' where Cust_ID ='$cid'";
                            
							$query_run = mysqli_query($con,$query);
							if($query_run)
							{
								echo '<script type="text/javascript">alert("Details Updated..")</script>';
								
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