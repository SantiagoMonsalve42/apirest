<?php
include 'config.php';
error_reporting(0);
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
            echo json_encode( $sql->fetchAll()  );
        }else{
            header( 'HTTP/1.1 400 BAD REQUEST' );
        }
    }else{
        $sqlStatement="select * from experiencia_laboral ";
        $sql = $objConn ->prepare($sqlStatement);
        if($sql -> execute()){
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll()  );
        }else{
        header( 'HTTP/1.1 400 BAD REQUEST' );
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
        }else{
            header( 'HTTP/1.1 400 BAD REQUEST' );
        }
    }else{
        header( 'HTTP/1.1 400 BAD REQUEST' ); 
    }
}

if($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'PATCH'){

    if(count($_GET)){
        $parametros=$_GET; 
        $sqlStatement="UPDATE experiencia_laboral 
                            SET  descripcion=:d, fecha_inicio=:fi, fecha_final=:ff
                            WHERE id_experiencia_laboral = :id_exp";
         $sql = $objConn->prepare($sqlStatement);
         $objConf->getParams($sql,$parametros);
         if($sql -> execute()){
             header("HTTP/1.1 200 OK");
         }else{
             header( 'HTTP/1.1 400 BAD REQUEST' );
         }
     }else{
         header( 'HTTP/1.1 400 BAD REQUEST' ); 
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
        }else{
            header( 'HTTP/1.1 400 BAD REQUEST' ); 
        }
    }else{
        header( 'HTTP/1.1 400 BAD REQUEST' );  
    }
}
?>