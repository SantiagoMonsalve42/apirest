<?php
include 'config.php';

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
                echo json_encode( $sql->fetchAll()  );
            }else{
                header( 'HTTP/1.1 400 BAD REQUEST' );
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
                $sql->setFetchMode(PDO::FETCH_ASSOC);
                header("HTTP/1.1 200 OK");
                echo json_encode( $sql->fetchAll()  );
            }else{
                header( 'HTTP/1.1 400 BAD REQUEST' );
            }
    }else{
        //GET ALL DATA FOR ONLY A BUSSINESS BY ID
        $sqlStatement="SELECT * FROM tipo_documento td, empresa e
        where td.id_tipo_documento=e.id_tipo_documento";
        $sql = $objConn->prepare($sqlStatement);
        if($sql->execute()){
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll()  );
        }else{
        header( 'HTTP/1.1 400 BAD REQUEST' );
        }
    }
    exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    if(isset($_POST)){
        $parametros = $_POST;
        $sqlStatement="INSERT INTO 
                        empresa(id_tipo_documento,numero_documento,nombre,correo,telefono_empresa)
                        VALUES 
                        (:id_td,:ndoc,:n,:c,:t)";
        $sql = $objConn->prepare($sqlStatement);
        $objConf->getParams($sql,$parametros);
        if($sql->execute()){
            header("HTTP/1.1 200 OK");
        }else{
            header( 'HTTP/1.1 400 BAD REQUEST' );
        }
    }else{
        header( 'HTTP/1.1 400 BAD REQUEST' );
    }
}

if($_SERVER['REQUEST_METHOD'] == "PUT" || $_SERVER['REQUEST_METHOD'] == "PATCH"){

    if(isset($_GET)){
        $parametros = $_GET;
        $sqlStatement="UPDATE empresa 
                            SET correo=:c, telefono_empresa=:t
                            WHERE id_empresa=:id_e";
        $sql = $objConn->prepare($sqlStatement);
        $objConf->getParams($sql,$parametros);         
        if($sql->execute()){
            header("HTTP/1.1 200 OK");
        }else{
            header( 'HTTP/1.1 400 BAD REQUEST' );
        }         
    }else{
        header( 'HTTP/1.1 400 BAD REQUEST' );
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
        }else{
            header( 'HTTP/1.1 400 BAD REQUEST' );
        }         
    }else{
        header( 'HTTP/1.1 400 BAD REQUEST' );
    }
}
?>