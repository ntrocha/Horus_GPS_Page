<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Acces-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; chaser=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$servidor = "database-mysql-design.cpvucarfpwnw.us-east-1.rds.amazonaws.com"; $usuario = "admin"; $contrasena = "Nd200117"; $dbnombre = "GPS";
$conexionBD = new mysqli($servidor, $usuario, $contrasena, $dbnombre);

//Consulta de datos teniendo en cuenta un parametro
if (isset($_GET["consultar"])){

    $sqlEmpleados = mysqli_query($conexionBD,"SELECT * FROM co_gps WHERE id=".$_GET["consultar"]);

    if (mysqli_num_rows($sqlEmpleados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleados,MYSQLI_ASSOC);
        $cc = count($empleaados);
        for ($i = 0; $i < $cc; ++$i){
            if ($i == $cc-1){
                echo json_encode($empleaados[$i]);
            } 
        }
        
        exit();
    }
    else{ echo json_encode(["success"=>0]); }
}

//
if (isset($_GET["borrar"])){
    $sqlEmpleados = mysqli_query($conexionBD,"DELETE FROM co_gps WHERE id=".$_GET["borrar"]);
    if($sqlEmpleados){
        echo json_encode(["success"=>1]);
        exit();
    }else {
        echo json_encode(["success"=>0]);
    }
}
//Ingresa un nuevo registro
if(isset($_GET["insertar"])){

    $data = json_decode(file_get_contents("php://input"));
    $nombre = $data->nombre;
    $correo = $data->correo;

    if(($correo!="")&&($nombre!="")){
        $sqlEmpleados = mysqli_query($conexionBD,"INSERT INTO co_gps(Lat,Log) VALUES('$nombre','$correo')");
        echo json_encode(["success"=>1]);
    }
    exit();
}

//Actualizar datos 
if(isset($_GET["actualizar"])){
    $data = json_decode(file_get_contents("php://input"));

    $id = (isset($data->id)?data->id:$_GET["actualizar"]);
    $nombre = $data->nombre;
    $correo = $data->correo;

    $sqlEmpleados = mysqli_query($conexionBD, "UPDATE co_gps SET Lat = '$nombre', Log = '$correo' WHERE id = '$id'");
    echo json_encode(["success"=>1]);
    exit();
}
//Consultar toda la base de datos
$sqlEmpleados = mysqli_query($conexionBD,"SELECT * FROM co_gps");
if (mysqli_num_rows($sqlEmpleados) > 0){
    $empleaados = mysqli_fetch_all($sqlEmpleados,MYSQLI_ASSOC);
    $cc = count($empleaados);
    for ($i = 0; $i < $cc; ++$i){
        if ($i == $cc-1){
            echo json_encode([$empleaados[$i]]);
        } 
        //else{ echo json_encode([["success"=>0]]); }
    }
}

?>

