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
        $sqlStatement="select * from estudios 
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
        $sqlStatement="select * from estudios ";
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
                      estudios(id_persona,id_institucion_educativa,descripcion,fecha_inicio,fecha_final)
                      VALUES
                      (:id_p,:id_ins,:d,:fi,:ff)";
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
    parse_str(file_get_contents("php://input"),$put_vars);

    if(sizeof($put_vars) == 4){
        $sqlStatement="UPDATE estudios 
                            SET  descripcion=:d, fecha_inicio=:fi, fecha_final=:ff
                            WHERE id_estudios = :id_est";
         $sql = $objConn->prepare($sqlStatement);
         
        $sql->bindValue(':d',$put_vars['d']);    
        $sql->bindValue(':fi',$put_vars['fi']); 
        $sql->bindValue(':ff',$put_vars['ff']);  
        $sql->bindValue(':id_est',$put_vars['id_est']); 
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
    if(isset($_GET['id_est'])){
        $sqlStatement="DELETE FROM estudios
                        WHERE id_estudios = :id_est";
        $sql = $objConn->prepare($sqlStatement);
        $sql->bindValue(':id_est',$_GET['id_est']);
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