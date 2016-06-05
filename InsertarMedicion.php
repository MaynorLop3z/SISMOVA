<?php

include("Conexion.php");
$idSensor = $_REQUEST['idSensor'];
$fecha = $_REQUEST['fecha'];
$hora = $_REQUEST['hora'];
$valorMedido = $_REQUEST['valorMedido'];
$valorModelado = $_REQUEST['valorModelado'];

//INSERT INTO `Estaciones`.`Medicion` (`idSensor`, `Fecha`, `Hora`, `ValorMedido`, `ValorModelado`) VALUES (1, '2015-06-04', '14:19:00', 22.1, 0);
$sql="INSERT INTO `Estaciones`.`Medicion` (`idSensor`, `Fecha`, `Hora`, `ValorMedido`, `ValorModelado`) VALUES (".$idSensor.", '".$fecha."', '".$hora."', ".$valorMedido.", ".$valorModelado.");";
$link = Connection();
$result = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
$tuplas = mysql_affected_rows();
mysql_free_result($result);
mysql_close($link);
?>