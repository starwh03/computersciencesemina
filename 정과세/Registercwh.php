<?php
	$con = mysqli_connect("localhost","gghs20","rudrhkr20!","gghs20");

	$userEmail = $_POST["userEmail"];
	$userPassword = $_POST["userPassword"];
	$check_sql="SELECT * FROM USER19114 WHERE userEmail='{$userEmail}'";
	$result = mysqli_query($con,$check_sql);
	$count=mysqli_num_rows($result);

	$response = array();

	if($count==0)
	{
		mysqli_query($con, "INSERT INTO USER19114 VALUES('{$userEmail}','{$userPassword}')");
		$response["success"]= true;
		$sql = "CREATE TABLE {$userEmail} (userEmail VARCHAR(30) NOT NULL,userPassword VARCHAR(30) NOT NULL,userType VARCHAR(30) NOT NULL)";
		mysqli_query($con, $sql);
	}
	else
	{
		$response["success"]= false;
	}
	echo json_encode($response);
?>