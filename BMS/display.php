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
	<a href="link.php" >Link</a>
    <a href="display.php" class="active" >Display</a>
	</div>

	<br><br>
<title>Link Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2 style="font-family:'Georgia';font-size:25px">Display page </h2></center>
		<form action="display.php" method="post">
			<div class="imgcontainer">
				<img src="imgs/display.png"alt="Avatar" class="avatar">
			</div>
			<div class="inner_container">
				<label style="font-family:'Consolas';font-size:18px;font-weight: bold;text-decoration: underline;">Enter details</label>
                <label for="cars">Choose a table:</label>

                <select name="sel" ">
                <option value="Branch">Branch</option>
                <option value="Customer">Customer</option>
                <option value="Account">Account</option>
                <option value="held_by_acc_cust">Held by acc customer</option>
				<option value="Bank">Bank</option>
                </select>

                
				<button name="display" class="sign_up_btn" type="submit">Display</button>
				
				
				<a href="index.php"><button type="button" class="back_btn"><< Back to Homepage</button></a>
			</div>
		</form>
    
        <?php
        if(isset($_POST['display'])){
            @$s = $_POST['sel'];
            echo $s;
            if ($s=='Branch'){
				$cod=$_SESSION['Code'];
                $sql = "select * from branch where Code = $cod";
                $result = mysqli_query($con,$sql);
					echo "<table border='1'><tr><th>Code</th><th>Branch ID</th><th>Name</th><th>Address</th></tr>";
                while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row['Code'] . "</td>";				  
					echo "<td>" . $row['Branch_ID'] . "</td>";				  
					echo "<td>" . $row['Name'] . "</td>";
					echo "<td>" . $row['Address'] . "</td>";
				  	echo "</tr>";
                }
				echo "</table>";
            }
			if ($s=='Customer'){
				$cod=$_SESSION['Code'];
				$presql="CREATE VIEW v5 AS SELECT DISTINCT customer.Cust_ID FROM customer,held_by_acc_cust,account,branch where 
						customer.Cust_ID=held_by_acc_cust.Cust_ID and held_by_acc_cust.Account_No=account.Account_No
						 and branch.Branch_ID=account.Branch_ID and Code=$cod";
                $res = mysqli_query($con,$presql);
                $sql = "select * from v5,customer where v5.Cust_ID = customer.Cust_ID";
                $result = mysqli_query($con,$sql);
					echo "<table border='1'><tr><th>Customer ID</th><th>Name</th><th>Phone number</th><th>Address</th></tr>";
                    
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
					echo "<td>" . $row['Cust_ID'] . "</td>";				  
					echo "<td>" . $row['Name'] . "</td>";				  
					echo "<td>" . $row['Phone_no'] . "</td>";
					echo "<td>" . $row['Address'] . "</td>";
				  	echo "</tr>";
				}

				echo "</table>";
				$R=mysqli_query($con,"DROP VIEW V5");
            }

			if ($s=='Account'){
				$cod=$_SESSION['Code'];
				$presql="CREATE VIEW v4 AS SELECT DISTINCT account.Branch_ID FROM account,branch,bank where 
				branch.Branch_ID=account.Branch_ID and branch.Code=bank.Code and bank.Code=$cod";
				$res = mysqli_query($con,$presql);
                $sql = "select * from v4,account where v4.Branch_ID=account.Branch_ID";
                $result = mysqli_query($con,$sql);
				echo "<table border='1'><tr><th>BranchId</th><th>Account No</th><th>Account Type</th><th>Balance</th></tr>";
				
				
                   
                while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row['Branch_ID'] . "</td>";				  
					echo "<td>" . $row['Account_No'] . "</td>";				  
					echo "<td>" . $row['Account_Type'] . "</td>";
					echo "<td>" . $row['Balance'] . "</td>";
				  	echo "</tr>";
					
				}	
				echo "</table>";
				$R=mysqli_query($con,"DROP VIEW V4");
            }

			if ($s=='held_by_acc_cust'){
				$cod=$_SESSION['Code'];
				$presql="CREATE VIEW v3 AS SELECT DISTINCT customer.Cust_ID FROM customer,held_by_acc_cust,account,branch where 
						customer.Cust_ID=held_by_acc_cust.Cust_ID and held_by_acc_cust.Account_No=account.Account_No
						 and branch.Branch_ID=account.Branch_ID and Code=$cod";
                $res = mysqli_query($con,$presql);
				
				
				$sql = "select * from v3,held_by_acc_cust where v3.Cust_ID= held_by_acc_cust.Cust_ID";
                $result = mysqli_query($con,$sql);
				echo "<table border='1'><tr><th>Customer Id</th><th>Account No</th></tr>";
				
				
                   
                while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row['Cust_ID'] . "</td>";				  
					echo "<td>" . $row['Account_No'] . "</td>";				  
				  	echo "</tr>";
					
				}	
				echo "</table>";
				$R=mysqli_query($con,"DROP VIEW V3");
            }
			if ($s=='Bank'){
				$cod=$_SESSION['Code'];
                $sql = "select * from bank where Code = $cod";
                $result = mysqli_query($con,$sql);
					echo "<table border='1'><tr><th>Code</th><th>Name</th><th>HQ Address</th><th>Password</th></tr>";
                while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row['Code'] . "</td>";				  			  
					echo "<td>" . $row['Name'] . "</td>";
					echo "<td>" . $row['HQ_Address'] . "</td>";
					echo "<td>" . $row['Password'] . "</td>";
				  	echo "</tr>";
                }
				echo "</table>";
            }


			
			
        }
        ?>

    </div>
</body>
</html>