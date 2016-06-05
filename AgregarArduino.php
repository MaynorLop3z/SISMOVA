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
        <title>Agregar Arduino | Sistema de Mediciones</title>

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
                <div class="col-md-1">
                    <br>
                    <a href="index.php" class="btn btn-success" role="button"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
                </div>
                <div class="col-md-10">
                    <h1>Sistema de Mediciones con Arduino Beta 0.1</h1>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Agregar Arduino</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="formulario1" action="InsertarArduino.php" method="POST">
                                <fieldset>
                                    <legend>Datos de la estacion Arduino</legend>
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" value="" maxlength="150" placeholder="Escriba el nombre clave de la estacion" required/>
                                    <br>
                                    <label for="latitud">Latitud:</label>
                                    <input type="text" class="form-control" name="latitud" id="latitud" value="" placeholder="Defina la latitud de la estacion"/>
                                    <br>
                                    <label for="longitud">Longitud:</label>
                                    <input type="text" class="form-control" name="longitud" id="longitud" value="" placeholder="Defina la longitud de la estacion"/>
                                    <br>
                                    <label for="descripcion">Descripcion:</label>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion" value="" maxlength="200" placeholder="Defina la longitud de la estacion"/>
                                    <br>
                                    <button type="submit" class="btn btn-primary" name="envio"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Agregar Arduino</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Lista de Estaciones</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            include("Conexion.php");
                            $link = Connection();

                            $query = "SELECT Arduino.NombreArduino,Arduino.Latitud,Arduino.Longitud,Arduino.Descripcion FROM Estaciones.Arduino;";

                            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

// Imprimir los resultados en HTML
                            echo "<table class='table table-hover table-bordered table-responsive'>\n";
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>Nombre</th>';
                            echo '<th>Latitud</th>';
                            echo '<th>Longitud</th>';
                            echo '<th>Descripcion</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                echo "\t<tr>\n";
                                foreach ($line as $col_value) {
                                    echo "\t\t<td>$col_value</td>\n";
                                }
                                echo "\t</tr>\n";
                            }
                            echo '</tbody>';
                            echo "</table>\n";

                            mysql_free_result($result);
                            mysql_close($link);
                            ?>
                        </div>

                    </div>

                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </body>
</html>
