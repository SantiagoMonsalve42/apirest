<?php

include 'config.php';
error_reporting(0);  
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$objConfig = new configuration;
$dbConn=$objConfig->getConection();

    //read
if($_SERVER['REQUEST_METHOD'] == 'GET'){

        $sqlStatement="SELECT * FROM tipo_documento";
        $sql = $dbConn->prepare($sqlStatement);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
            $array = array(
                "status" => "ok",
                "code" => "200",
                "resul" => $sql->fetchAll()
            );
            echo json_encode($array);

        exit();

}
?>