<?php

$dbHost = 'localhost';
$dbName = 'etl';
$dbUser = 'root';
$dbPass = '';

class Conectar{
    public static function conexion(){
        $conexion=new mysqli('localhost', 'root', '', 'etl');
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}

