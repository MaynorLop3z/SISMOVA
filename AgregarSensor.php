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
        <title>Agregar Sensor | Sistema de Mediciones</title>

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
                            <form class="form-horizontal" name="formulario1" action="InsertarSensor.php" method="POST">
                                <fieldset>
                                    <legend>Datos de la estacion Arduino</legend>
                                    <label for="arduino">Arduino:</label>
                                    <br>
                                    <select class="form-control" name="arduino" id="arduino">
                                        <?php
                                        include("Conexion.php");
                                        //SELECT Arduino.idArduino,Arduino.NombreArduino FROM Estaciones.Arduino;
                                        $link = Connection();

                                        $query = "SELECT Arduino.idArduino,Arduino.NombreArduino FROM Estaciones.Arduino;";

                                        $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
                                        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

                                            echo '<option value="' . $line['idArduino'] . '">' . $line['NombreArduino'] . '</option>';
                                        }
                                        // Liberar resultados
                                        mysql_free_result($result);
                                        ?>    
                                    </select>
                                    <br>
                                    <label for="variable">Variable a medir:</label>
                                    <br>
                                    <select  class="form-control" name="variable" id="variable">
                                        <?php
                                        //SELECT Variable.idVariable,Variable.NombreVariable FROM Estaciones.Variable;
                                        $query2 = "SELECT Variable.idVariable,Variable.NombreVariable FROM Estaciones.Variable;";
                                        $result2 = mysql_query($query2) or die('Consulta fallida: ' . mysql_error());
                                        while ($line = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                                            echo '<option value="' . $line['idVariable'] . '">' . $line['NombreVariable'] . '</option>';
                                        }
                                        // Liberar resultados
                                        mysql_free_result($result2);
                                        // Cerrar la conexión
                                        mysql_close($link);
                                        ?>    
                                    </select>
                                    <br>
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" value="" maxlength="100" placeholder="Escriba el nombre clave del sensor" required/>
                                    <br>
                                    <label for="descripcion">Descripcion:</label>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion" value="" maxlength="200" placeholder="Escriba una descripcion del sensor" required/>
                                    <br>
                                    <button type="submit" class="btn btn-primary" name="envio"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Agregar Sensor</button>
                                </fieldset>
                            </form>
                        </div>

                    </div>

                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </body>
</html>
