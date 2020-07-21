<?php
		
	include 'connect.php';
	
	if($_REQUEST["pref1select"] != "select" && $_REQUEST["pref2select"] != "select")
	{
		$sid = $_REQUEST["pref1select"];
		$rid = $_REQUEST["pref2select"];
		$amt = $_REQUEST["amt"];
		
		if($sid==$rid)
		{
			die("Cannot transfer credit to Yourself!");
		}

		
		$selectQuery1 = "SELECT * FROM user WHERE id='$sid'";
		$result = mysqli_query($conn,$selectQuery1);
			
		if(mysqli_num_rows($result) > 0)
		{
			$selectQuery2 = "SELECT * FROM user WHERE id='$rid'";
			$result = mysqli_query($conn,$selectQuery2);
			
			if(mysqli_num_rows($result) > 0)
			{
				$selectQuery3 = "SELECT credit FROM user WHERE id='$sid'";
				$result =mysqli_query($conn,$selectQuery3);
				
				$row = mysqli_fetch_row($result);
				$sbal=$row[0];
				
				if($sbal < $amt)
				{
					echo "<script>alert('Insufficient balance');
					window.location.href ='transfer.html';</script>";							
				}
				else
				{
					$newbal=$sbal-$amt;
					$updateQuery = "UPDATE user SET credit= '$newbal' WHERE id='$sid'";
					
					if (mysqli_query($conn, $updateQuery)) 
					{
						$selectQuery4 = "SELECT credit FROM user WHERE id='$rid'";
						$results =mysqli_query($conn,$selectQuery4);
						
						$rows = mysqli_fetch_row($results);
						$rbal=$rows[0];
					
						$rnew=$rbal+$amt;
						$updateQuery1 = "UPDATE user SET credit=$rnew WHERE id=$rid";
						$result = mysqli_query($conn,$updateQuery1);
						/*if(result)
						{	
							echo "Record updated successfully";
						}
						else
						{
							die("Error while updating");
						}*/
						$status="yes";
						
						$insertQuery = "INSERT INTO transfer(sid,rid,amt,status) VALUES ('$sid','$rid','$amt','$status')";
						$result = mysqli_query($conn,$insertQuery);
		
						/*if($result)
						{
							echo "New record created successfully";
						}
						else 
						{
							echo "Error"; 
						}*/ 
					}
					/*else 
					{
						echo "Error updating the record ";
					}*/
				
				}
			}
		}
	}
	else
	{
		echo "<script>alert('Please select a Sender and a Receiver!')</script>";
	}				
?>


<HTML>
	<HEAD>
		<link rel="stylesheet" type="text/css" href="navihome.css">
		
	
		<style>	
		
		body
		{
			background-image:url('transaction.png');
			background-size:50%;
			background-repeat: no-repeat;
			background-attachment: fixed;
			position: absolute;
			width:80%;
			height:12%;
			background-position:center;
			
		}
		
		.navi-left a 
		{
			color: crimson;
		}
		
		.header
		{
			margin-left:140px;
			font-size:32px;
			font-family:calibri;
			color:red;
			padding:10px;
		}
		
		
		table#t1
		{
			background-color: #f2f2f2
		}
		
		#t1
		tr:hover
		{
			background-color: #4CAF50
		}

		th
		{
			background-color: #4CAF50;
			color: white;
		}
		
		
		</style>
	</HEAD>
	<BODY>
		<div class="navi-left">
			<a href="index.html">HOME</a>
			<a href="view.php">VIEW ALL USERS</a>
			<a href="transfer.html">TRANSFER CREDIT</a>
		</div>
		<div class ="header">
			<H2 align="right"> TRANSACTION COMPLETED</H2>
		</div>
		<TABLE style="margin-left:10px">
			<TR>
				<TD><span style="font-size:22px; color:blue"><b>Sender's Updated Record</b></span></TD>
			</TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR>
				<TD>
					<?php
						
						include 'connect.php';

						$rid= $_REQUEST["pref2select"];
						
						$selectQuery = "SELECT id,name,credit FROM user WHERE id='$sid'";
						$result = mysqli_query($conn,$selectQuery);
					
						if(mysqli_num_rows($result)>0)
						{
							echo "<table align='center' border='1' cellpadding='15px' id='t1'>
									<tr>
										<th> ID </th>
										<th> Name </th>
										<th> Credit </th> 
									</tr>";
							while($row = mysqli_fetch_assoc($result))
							{
								echo "<tr>
								<td>" .$row["id"]."</td>
								<td>" .$row["name"]."</td>
								<td>" .$row["credit"]."</td>
								</tr></a>";
							}
							echo "</table>";			
						}
						else
						{
							echo "0 results";
						}
					?>
				</TD>
			</TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR>
				<TD><span style="font-size:22px; color:blue"><b>Receiver's Updated Record</b></span></TD>
			</TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR></TR>
			<TR>
				<TD>
					<?php
						
						include 'connect.php';

						$rid= $_REQUEST["pref2select"];
						
						$selectQuery = "SELECT id,name,credit FROM user WHERE id='$rid'";
						$result = mysqli_query($conn,$selectQuery);
					
						if(mysqli_num_rows($result)>0)
						{
							echo "<table align='center' border='1' cellpadding='15px' id='t1'>
									<tr>
										<th> ID </th>
										<th> Name </th>
										<th> Credit </th> 
									</tr>";
							while($row = mysqli_fetch_assoc($result))
							{
								echo "<tr>
								<td>" .$row["id"]."</td>
								<td>" .$row["name"]."</td>
								<td>" .$row["credit"]."</td>
								</tr></a>";
							}
							echo "</table>";			
						}
						else
						{
							echo "0 results";
						}
					?>
				</TD>
			</TR>
</BODY>
</HTML>

