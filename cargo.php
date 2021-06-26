<?php
include 'config.php';
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$objConf = new configuration;
$objConn = $objConf ->getConection();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id_c'])){
        $sqlStatement = "select * from cargo where id_cargo=:id_c";
        $sql = $objConn->prepare($sqlStatement);
        $sql->bindValue(':id_c',$_GET['id_c']);
        if($sql -> execute()){
            header("HTTP/1.1 200 OK");
            header("HTTP/1.1 200 OK"); 
            $array = array(
                "status" => "ok",
                "code" => "200",
                "resul" => $sql->fetch(PDO::FETCH_ASSOC)
            );
            echo json_encode($array);
        }else{
            $array = array(
                "status" => "bar request",
                "code" => "400"
            );
            header( 'HTTP/1.1 400 BAD REQUEST' );
            echo json_encode($array);
        }
    }else{
        $sqlStatement = "select * from cargo ";
        $sql = $objConn->prepare($sqlStatement);
        if($sql -> execute()){
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            
            header("HTTP/1.1 200 OK"); 
            $array = array(
                "status" => "ok",
                "code" => "200",
                "resul" =>  $sql->fetchAll()  
            );
            echo json_encode($array);
        }else{
            $array = array(
                "status" => "bar request",
                "code" => "400"
            );
            header( 'HTTP/1.1 400 BAD REQUEST' );
            echo json_encode($array);
        }
    }
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['desc']){
        $sqlStatement = "insert into cargo(descripcion_cargo) values (:desc)"; 
        $sql= $objConn->prepare($sqlStatement);
        $sql->bindValue(':desc',$_POST['desc']);
        if($sql->execute()){
            header("HTTP/1.1 200 OK"); 
            $array = array(
                "status" => "ok",
                "code" => "200"
            );
            echo json_encode($array);
        }else{
            $array = array(
                "status" => "bar request",
                "code" => "400"
            );
            header( 'HTTP/1.1 400 BAD REQUEST' );
            echo json_encode($array);
        }
    }else{
        $array = array(
            "status" => "bar request",
            "code" => "400"
        );
        header( 'HTTP/1.1 400 BAD REQUEST' );
        echo json_encode($array);
    }
    exit();
}
?>