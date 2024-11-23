<?php
function Conexion(){
    $server='localhost';
    $usuario="root";
    $clave="Juanpatitoracista1234.";
    try{
        $con=new PDO("mysql:host=".$server."; dbname=db_university",$usuario,$clave );
    }catch(PDOException $e){
    }
    return $con;
}
?>