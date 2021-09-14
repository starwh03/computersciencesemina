<?php
	$con = mysqli_connect("localhost","gghs20","rudrhkr20!","gghs20");

	$userId = $_POST["userId"];
	$userEmail = $_POST["userEmail"];
	$userPassword = $_POST["userPassword"];
	$userType = $_POST["userType"];
	$sql="DELETE FROM $userId WHERE userEmail='$userEmail' AND userPassword='$userPassword' AND userType='$userType'";
	mysqli_query($con,$sql);
	echo json_encode($response);
?>