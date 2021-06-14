<?php
include 'config.php';

$objConf = new configuration;
$objConn = $objConf ->getConection();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id_c'])){
        $sqlStatement = "select * from cargo where id_cargo=:id_c";
        $sql = $objConn->prepare($sqlStatement);
        $sql->bindValue(':id_c',$_GET['id_c']);
        if($sql -> execute()){
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode( $sql->fetchAll()  );
        }else{
            header( 'HTTP/1.1 400 BAD REQUEST' );
        }
    }else{
        $sqlStatement = "select * from cargo ";
        $sql = $objConn->prepare($sqlStatement);
        if($sql -> execute()){
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode( $sql->fetchAll()  );
        }else{
            header( 'HTTP/1.1 400 BAD REQUEST' );
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
        }else{
            header( 'HTTP/1.1 400 BAD REQUEST' );
        }
    }else{
        header( 'HTTP/1.1 400 BAD REQUEST' );
    }
    exit();
}
?>