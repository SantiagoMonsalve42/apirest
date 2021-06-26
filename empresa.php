<?php
include 'config.php';
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$objConf = new configuration;
$objConn = $objConf ->getConection();

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET['id']) && isset($_GET['type'])){
        // TYPE == 0 IS FOR GET ALL EMPLOYEES OF A BUSSINES BY ID
        if($_GET['type'] == "0"){
            $sqlStatement="SELECT * FROM tipo_documento td,persona p,cargo c, empresa e
                                    where td.id_tipo_documento=p.id_tipo_documento
                                    and p.id_cargo = c.id_cargo
                                    and p.id_empresa = e.id_empresa
                                    and e.id_empresa=:id";
            $sql = $objConn->prepare($sqlStatement);
            $sql->bindValue(':id',$_GET['id']);
            if($sql->execute()){
                $sql->setFetchMode(PDO::FETCH_ASSOC);
                
                header("HTTP/1.1 200 OK"); 
                $array = array(
                    "status" => "ok",
                    "code" => "200",
                    "resul" => $sql->fetchAll()
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
    }else
    if(isset($_GET['id'])){
        //GET ALL DATA FOR ONLY A BUSSINESS BY ID
            $sqlStatement="SELECT * FROM tipo_documento td, empresa e
                                    where td.id_tipo_documento=e.id_tipo_documento
                                    and e.id_empresa=:id";
            $sql = $objConn->prepare($sqlStatement);
            $sql->bindValue(':id',$_GET['id']);
            if($sql->execute()){
                header("HTTP/1.1 200 OK");
                $array = array(
                    "status" => "ok",
                    "code" => "200",
                    "resul" => $sql->fetch(PDO::FETCH_ASSOC)
                );
                echo json_encode( $array);
            }else{
                $array = array(
                    "status" => "bar request",
                    "code" => "400"
                );
                header( 'HTTP/1.1 400 BAD REQUEST' );
                echo json_encode($array);
            }
    }else{
        //GET ALL DATA FOR ONLY A BUSSINESS BY ID
        $sqlStatement="SELECT * FROM tipo_documento td, empresa e
        where td.id_tipo_documento=e.id_tipo_documento";
        $sql = $objConn->prepare($sqlStatement);
        if($sql->execute()){
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        $array = array(
            "status" => "ok",
            "code" => "200",
            "resul" => $sql->fetchAll()
        );
        echo json_encode($array);
        }else{
        header( 'HTTP/1.1 400 BAD REQUEST' );
        }
    }
    exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    if(count($_POST)){
        $parametros = $_POST;
        $sqlStatement="INSERT INTO 
                        empresa(id_tipo_documento,numero_documento,nombre,correo,telefono_empresa)
                        VALUES 
                        (:id_td,:ndoc,:n,:c,:t)";
        $sql = $objConn->prepare($sqlStatement);
        $objConf->getParams($sql,$parametros);
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
}

if($_SERVER['REQUEST_METHOD'] == "PUT" || $_SERVER['REQUEST_METHOD'] == "PATCH"){
    parse_str(file_get_contents("php://input"),$put_vars);

    if(sizeof($put_vars) == 3){
        $sqlStatement="UPDATE empresa 
                            SET correo=:c, telefono_empresa=:t
                            WHERE id_empresa=:id_e";
        $sql = $objConn->prepare($sqlStatement);
        $sql->bindValue(':c',$put_vars['c']);    
        $sql->bindValue(':t',$put_vars['t']); 
        $sql->bindValue(':id_e',$put_vars['id_e']);  
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
}

if($_SERVER['REQUEST_METHOD'] == "DELETE"){
    
    if(isset($_GET['id_e'])){
        $sqlStatement="DELETE FROM  empresa 
                            WHERE id_empresa=:id_e";
        $sql = $objConn->prepare($sqlStatement);
        $sql->bindValue(':id_e',$_GET['id_e']);       
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
}
?>