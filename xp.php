<?php
	include 'connect.php';

	$id = $_POST['id'];
	$gender = "";
	$email = "";
	$result = "";
	
	$selectQuery = "SELECT gender,email FROM user where id ='$id'";
	$ret = mysqli_query($conn,$selectQuery);
	if ($ret->num_rows > 0)
	{
		while($row = $ret->fetch_assoc())
		{
			$gender = $row["gender"];
			$email = $row["email"];
		}
	}
	
	$result = $gender." ".$email;
	echo $result;
?>