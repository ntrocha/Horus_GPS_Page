<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Acces-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; chaser=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include 'consulta.php';
$Id=$_POST['Id'];
$Lat=$_POST['Lat'];
$Log=$_POST['Log'];
$Time=$_POST['Time'];

//$cons = "insert into co_gps ('".$Id."','".$Lat."','".$Log."','".$Time"')";
$query = "INSERT INTO co_gps(Id,Lat,Log,Time) values('$Id', '$Lat', '$Log', '$Time')";
mysqli_query($consulta,$query) or die (mysqli_error());
mysqli_close($consulta);

?>
