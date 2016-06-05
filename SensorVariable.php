<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include("Conexion.php");
$link = Connection();
$idArduino = $_POST['idArduino'];
$query = "SELECT sen.idSensor,sen.NombreSensor,var.NombreVariable
FROM Estaciones.Sensor sen INNER JOIN Estaciones.Variable var ON sen.idVariable = var.idVariable
where sen.idArduino=" . $idArduino . ";";
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
       $html .= '<option value="'.$line['idSensor'].'">'.$line['NombreSensor']." | ".$line['NombreVariable'].'</option>';
}
echo $html;
