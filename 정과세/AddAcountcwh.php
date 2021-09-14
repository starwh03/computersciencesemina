<?php
	$con = mysqli_connect("localhost","gghs20","rudrhkr20!","gghs20");

	$userId = $_POST["userId"];
	$userEmail = $_POST["userEmail"];
	$userPassword = $_POST["userPassword"];
	$userType = $_POST["userType"];
	$check_sql="SELECT * FROM {$userId} WHERE userEmail='$userEmail'";
	$result = mysqli_query($con,$check_sql);
	$count = mysqli_num_rows($result);

	$response = array();

	if($count==0)
	{
		mysqli_query($con, "INSERT INTO {$userId} VALUES('$userEmail','$userPassword','$userType')");
		$response["success"]= true;
	}
	else
	{
		$response["success"]= false;
	}
	echo json_encode($response);
?>