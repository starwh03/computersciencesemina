<?php
    $con = mysqli_connect("localhost","gghs20","rudrhkr20!","gghs20");

	$userEmail = $_POST["userEmail"];
	$userPassword = $_POST["userPassword"];
	$statement = mysqli_prepare($con, "SELECT * FROM USER19114 WHERE userEmail='$userEmail' AND userPassword='$userPassword'");
	mysqli_stmt_bind_param($statement, "ss", $userEmail, $userPassword);
	mysqli_stmt_execute($statement);
	mysqli_stmt_store_result($statement);
	mysqli_stmt_bind_result($statement, $userEmail, $userPassword);

	$response = array();
	$response["success"]= false;

	while(mysqli_stmt_fetch($statement)){
		$response["success"]=true;
		$response["userEmail"]=$userEmail;
		$response["userPassword"]=$userPassword;
	}
	echo json_encode($response);
?>
