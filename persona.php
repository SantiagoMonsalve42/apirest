<?php

include 'config.php';
    
$objConfig = new configuration;
$dbConn=$objConfig->getConection();

    //read
if($_SERVER['REQUEST_METHOD'] == 'GET'){

    if( isset($_GET['id']) ){
        $sqlStatement="SELECT * FROM tipo_documento td,persona p,cargo c
                        where td.id_tipo_documento=p.id_tipo_documento
                                and p.id_cargo = c.id_cargo
                                and id_persona=:id";
        $sql = $dbConn->prepare($sqlStatement);
        $sql->bindValue(':id',$_GET['id']);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetch(PDO::FETCH_ASSOC));

        exit();


    }//read All
    else{
        $sqlStatement="SELECT * FROM tipo_documento td,persona p,cargo c
                        where td.id_tipo_documento=p.id_tipo_documento
                                and p.id_cargo = c.id_cargo";
        $sql = $dbConn->prepare($sqlStatement);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll()  );

        exit();
    }
}
    //create        
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $parametros=$_POST;
    $sql = "INSERT INTO persona
          (id_tipo_documento,id_cargo,id_empresa,numero_documento,nombre1,nombre2,
          apellido1,apellido2,correo,fecha_nacimiento)
          VALUES
          (:id_td,:id_car,:id_emp,:ndoc,:n1,:n2,:a1,:a2,:mail,:fnac)";
    $statement = $dbConn->prepare($sql);     
    $objConfig->getParams($statement,$parametros);

    if($statement->execute()){
        header("HTTP/1.1 200 OK"); 
    }else{
        header( 'HTTP/1.1 400 BAD REQUEST' );
    }
    exit();

}
    //update
if($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'PATCH'){
    $parametros = $_GET;
    $sql="UPDATE persona SET correo=:correo 
            WHERE id_persona=:id";
    $statement = $dbConn->prepare($sql);
    $objConfig->getParams($statement,$parametros);
    if($statement->execute()){
        header("HTTP/1.1 200 OK"); 
    }else{
        header( 'HTTP/1.1 400 BAD REQUEST' );
    }
    exit();
}
    //delete
if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    
    if(isset($_GET['id'])){
        $sql = $dbConn->prepare("delete from persona where id_persona=:id");
        $sql->bindValue(':id',$_GET['id']);
        $sql->execute();
        header("HTTP/1.1 200 OK");
    }else{
        header( 'HTTP/1.1 400 BAD REQUEST' );
    }
    exit();
   
}
?>