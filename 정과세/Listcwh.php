<?php
    $con = mysqli_connect("localhost","gghs20","rudrhkr20!","gghs20");

	$userID = $_POST["userID"];
	$result = mysqli_query($con, "SELECT * FROM $userID;");
	$response = array();

    while($row = mysqli_fetch_array($result)){
        array_push($response, array("userEmail"=>$row[0],"userPassword"=>$row[1],"userType"=>$row[2]));
    }
    echo json_encode(array("response"=>$response));
    mysqli_close($con);
?>