<?php

function Connection() {
    $server = 'localhost';
    $user = 'mex135';
    $pass = 'mex135';
    $db = 'Estaciones';

    $connection = mysql_connect($server, $user, $pass)
            or die('No se pudo conectar: ' . mysql_error());

    mysql_select_db($db) or die('No se pudo seleccionar la base de datos: ' . mysql_error());

    return $connection;
}

?>