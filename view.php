<HTML>
	<HEAD>
		<link rel="stylesheet" type="text/css" href="navihome.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<style>
		
		input[type=text]
		{
			padding: 12px 20px;
			margin: 5px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		
		body
		{
			background-image:url('user.gif');
			background-size:120%;
			background-repeat: no-repeat;
			background-attachment: fixed;
			position: absolute;
			width:80%;
			height:12%;
			background-position:bottom-left;
			z-index:10000000;
		}
		
		table#t1
		{
			background-color: #f2f2f2
		}
		
		table#t2
		{
			background-color: transparent;
		}
		
		#t2
		tr
		{
			background-color: white;
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
		
		#t2
		th
		{
			font-size: 25px;
			color: white;
		}
		
		
		p
		{	
			font-size: 20px;
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
		<br>
		<br>
		<br>
		<br>
		<br>
		
		<TABLE style="margin-left:10px">
			<TR>
				<TD>
					<?php
						include 'connect.php';
	
						$selectQuery = "SELECT id,name,credit FROM user";
						
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
								echo "<a href='view.php?hello=true'><tr>
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
				<TD valign="top">
				<span style="margin-top:0%; margin-left:160px; font-size:22px; color:yellow">DETAILS OF THE USER: </span>
				<TABLE valign="top" id ='t2' border='1' cellpadding='10px' cellspacing = '10px' height='100px'  align="center" style="margin-left:130px">
					<TR></TR>
					<TR></TR>
					<TR>
						<TH>ID : </TH><TH>NAME : </TH><TH>GENDER : </TH><TH>EMAIL : </TH><TH>CREDIT : </TH>
					</TR>
					<TR>
						<TD align="center"><p style="color:purple; font-size:20px;" name="id" id="id" ></p></TD>
						<TD align="center"><p style="color:purple; font-size:20px;" name="name" id="name"></p></TD>
						<TD align="center"><p style="color:purple; font-size:20px;" name="gender" id="gender"></p></TD>
						<TD align="center"><p style="color:purple; font-size:20px;" name="email" id="email"></p></TD>
						<TD align="center"><p style="color:purple; font-size:20px;" name="credit" id="credit"></p></TD>
					</TR>
				</TABLE>
				<script>
					var t1 = document.getElementById('t1'),rIndex;
					var xyz = 1;
					for(var i = 0; i < t1.rows.length; i++)
					{
						t1.rows[i].onclick = function()
						{	
							rIndex = this.rowIndex;
							//console.log(rIndex);
							document.getElementById("id").innerHTML = this.cells[0].innerHTML;
							//xyz = this.cells[0].innerHTML;
							document.getElementById("name").innerHTML = this.cells[1].innerHTML;
							document.getElementById("credit").innerHTML = this.cells[2].innerHTML;
							$.ajax({
							type : "POST",  //type of method
							url  : "xp.php",  //your page
							data : { id : this.cells[0].innerHTML },// passing the values
							success: function(res)
									{  
										//alert(res);
										var temp = res.split(" ");
										document.getElementById("gender").innerHTML = temp[0];
										document.getElementById("email").innerHTML = temp[1];
									}
							});
						};
					}
				</script>
				</TD>
			</TR>
		</TABLE>
	</BODY>
</HTML>

