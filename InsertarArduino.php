<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Insercion Arduino | Sistema de Mediciones</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <h1>Sistema de Mediciones con Arduino Beta 0.1</h1>
                    <?php
                    include("Conexion.php");
                    $nombre = $_REQUEST['nombre'];
                    $latitud = $_REQUEST['latitud'];
                    $longitud = $_REQUEST['longitud'];
                    $descripcion = $_REQUEST['descripcion'];
                    //INSERT INTO `Estaciones`.`Arduino` (`NombreArduino`, `Latitud`, `Longitud`, `Descripcion`) VALUES ('ArduinoCO2Test', , , 'Algo');
                    //INSERT INTO `Estaciones`.`Arduino` (`NombreArduino`, `Latitud`, `Longitud`, `Descripcion`) VALUES ('asdasda', 14.4, 13, 'asdasda');
                    $link = Connection();
                    echo "Se insertara el arduino con los siguientes datos:<br>Nombre: " . $nombre . "<br>Latitud: " . $latitud . "<br>Longitud: " . $longitud."<br>Descripcion: " . $descripcion."<br>";
                    $query = "INSERT INTO `Estaciones`.`Arduino` (`NombreArduino`, `Latitud`, `Longitud`, `Descripcion`) VALUES ('".$nombre."', ".$latitud.", ". $longitud.", '".$descripcion."');";
                    $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
                    $tuplas = mysql_affected_rows();
                    if ($tuplas >= 1) {
                        echo '<div class="alert alert-success" role="alert"><strong>Exito! </strong>Arduino Ingresado</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert"><strong>Error! </strong>Vuelva a intentar</div>';
                    }
                    echo '<a href="AgregarArduino.php">Regresar</a>';
                    mysql_free_result($result);
                    mysql_close($link);
                    ?>      
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </body>
</html>
