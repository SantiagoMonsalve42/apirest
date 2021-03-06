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
    if(isset($_GET['id_e'])){
        $sqlStatement= "SELECT * FROM institucion_educativa 
                            where id_institucion_educativa=:id_e ";
        $sql = $objConn -> prepare($sqlStatement);
        $sql->bindValue('id_e',$_GET['id_e']);
        $sql->execute();
        header("HTTP/1.1 200 OK");
            $array = array(
                "status" => "ok",
                "code" => "200",
                "resul" => $sql->fetch(PDO::FETCH_ASSOC)
            );
        echo json_encode( $array);
    }else{
    $sqlStatement= "SELECT * FROM institucion_educativa order by id_institucion_educativa desc";
    $sql = $objConn -> prepare($sqlStatement);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
            $array = array(
                "status" => "ok",
                "code" => "200",
                "resul" => $sql->fetchAll()
            );
    echo json_encode($array);
    }
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
            $array = array(
                "status" => "ok",
                "code" => "200",
                
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
            $array = array(
                "status" => "ok",
                "code" => "200",
                
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

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    
    if(isset($_GET['id_ins'])){
        $sqlStatement="DELETE FROM institucion_educativa 
                        where id_institucion_educativa=:id_ins";
        $sql = $objConn->prepare($sqlStatement);
        $sql->bindValue(':id_ins',$_GET['id_ins']);
        if($sql->execute()){
            header("HTTP/1.1 200 OK");
            $array = array(
                "status" => "ok",
                "code" => "200",
                
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