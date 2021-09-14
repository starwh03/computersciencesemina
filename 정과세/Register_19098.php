<?php
    $con = mysqli_connect("localhost","gghs20","rudrhkr20!","gghs20");


	$userID = $_POST["userID"];
	$userPassword = $_POST["userPassword"];
  $userName = $_POST["userName"];

  $check_sql="SELECT * FROM USER19098 WHERE userID='$userID'";
  $result = mysqli_query($con,$check_sql);
  $count=mysqli_num_rows($result);

  $response = array();
  if($count==0)
  {
    mysqli_query($con, "INSERT INTO USER19098 VALUES('$userID','$userPassword','$userName',NULL)");
    $response["success"]= true;
  }
  else
  {
    $response["success"]= false;
  }


  echo json_encode($response);

?>
