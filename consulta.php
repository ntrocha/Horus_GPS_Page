<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Acces-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; chaser=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$conn=mysqli_connect("database-mysql-design.cpvucarfpwnw.us-east-1.rds.amazonaws.com","admin","Nd200117");
mysqli_select_db($conn,"GPS");

  $id=$_POST['Id'];
  $lat=$_POST['Lat'];
  $log=$_POST['Log'];
  $tim=$_POST['Time'];
  
  $qry="INSERT INTO `co_gps` (`Id`, `Lat`, `Log`, `Time`) VALUES ('$id', '$lat', '$log', '$tim')";
  
  mysqli_query($conn,$qry);
  
  echo "Inserted Successfully";
?>
