<?php
include 'config.php';
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$objConf = new configuration;
$objConn = $objConf -> getConection();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id_p'])){
        $sqlStatement="select * from experiencia_laboral 
                        where id_persona=:id_p";
        $sql = $objConn ->prepare($sqlStatement);
        $sql->bindValue(':id_p',$_GET['id_p']);
        if($sql -> execute()){
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
        $array = array(
            "status" => "ok",
            "code" => "200",
            "resul" =>$sql->fetchAll()
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
        $sqlStatement="select * from experiencia_laboral ";
        $sql = $objConn ->prepare($sqlStatement);
        if($sql -> execute()){
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        $array = array(
            "status" => "ok",
            "code" => "200",
            "resul" =>$sql->fetchAll()
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
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(count($_POST)){
       $parametros=$_POST; 
       $sqlStatement="INSERT INTO 
                      experiencia_laboral(id_persona,descripcion,fecha_inicio,fecha_final)
                      VALUES
                      (:id_p,:d,:fi,:ff)";
        $sql = $objConn->prepare($sqlStatement);
        $objConf->getParams($sql,$parametros);
        if($sql -> execute()){
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
}

if($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'PATCH'){
    parse_str(file_get_contents("php://input"),$put_vars);
    if(sizeof($put_vars) == 4){
        $sqlStatement="UPDATE experiencia_laboral 
                            SET  descripcion=:d, fecha_inicio=:fi, fecha_final=:ff
                            WHERE id_experiencia_laboral = :id_exp";
         $sql = $objConn->prepare($sqlStatement);
         $sql->bindValue(':d',$put_vars['d']);    
         $sql->bindValue(':fi',$put_vars['fi']); 
         $sql->bindValue(':ff',$put_vars['ff']);  
         $sql->bindValue(':id_exp',$put_vars['id_exp']);
         if($sql -> execute()){
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
}

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    if(isset($_GET['id_exp'])){
        $sqlStatement="DELETE FROM experiencia_laboral
                        WHERE id_experiencia_laboral = :id_exp";
        $sql = $objConn->prepare($sqlStatement);
        $sql->bindValue(':id_exp',$_GET['id_exp']);
        if($sql -> execute()){
            header("HTTP/1.1 200 OK");
        $array = array(
            "status" => "ok",
            "code" => "200",
            "resul" =>$sql->fetchAll()
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
}
?>