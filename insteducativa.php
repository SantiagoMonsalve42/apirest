<?php
include 'config.php';
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$objConf = new configuration;
$objConn = $objConf->getConection();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $sqlStatement= "SELECT * FROM institucion_educativa";
    $sql = $objConn -> prepare($sqlStatement);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode($sql->fetchAll());
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['name'])){
        $sqlStatement="INSERT INTO institucion_educativa
        (nombre) values (:n)";
        $sql = $objConn->prepare($sqlStatement);
        $sql->bindValue(':n',$_POST['name']);
        if($sql->execute()){
            header("HTTP/1.1 200 OK"); 
        }else{
            header( 'HTTP/1.1 400 BAD REQUEST' );
        }
    }else{
        header( 'HTTP/1.1 400 BAD REQUEST' );
    }
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'PATCH'){
    parse_str(file_get_contents("php://input"),$put_vars);
    if(sizeof($put_vars) == 2){
    $sqlStatement="UPDATE institucion_educativa SET nombre=:name 
            WHERE id_institucion_educativa=:id_ins";
    $sql = $objConn->prepare($sqlStatement);
    $sql->bindValue(':name',$put_vars['name']);    
    $sql->bindValue(':id_ins',$put_vars['id_ins']); 
        if($sql -> execute()){
            header("HTTP/1.1 200 OK"); 
        }else{
            header( 'HTTP/1.1 400 BAD REQUEST' ); 
        }
    }else{
        header( 'HTTP/1.1 400 BAD REQUEST' ); 
    }   
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    
    if(isset($_GET['id_ins'])){
        $sqlStatement="DELETE FROM institucion_educativa 
                        where id_institucion_educativa=:id_ins";
        $sql = $objConn->prepare($sqlStatement);
        $sql->bindValue(':id_ins',$_GET['id_ins']);
        if($sql->execute()){
            header("HTTP/1.1 200 OK"); 
        }else{
            header( 'HTTP/1.1 400 BAD REQUEST' ); 
        }
    }else{
        header( 'HTTP/1.1 400 BAD REQUEST' ); 
    }
    exit();

}


?>