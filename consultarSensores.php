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
        <title>Consulta Sensores | Sistema de Mediciones</title>

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
        <script language="javascript">
            $(document).ready(function() {
                $("#arduino").change(function() {
                    $("#arduino option:selected").each(function() {
                        idArduino = $(this).val();
                        $.post("Sensores.php", {idArduino: idArduino}, function(data) {
                            $("#cuerpoTabla").html(data);
                        });
                    });
                });
            });
        </script>
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
                    <h3>Sensores</h3>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Sensores | Variables</h3>
                        </div>
                        <div class="panel-body">
                            <select  class="form-control" name="arduino" id="arduino">
                                <?php
                                include("Conexion.php");
                                $link = Connection();
                                $query = "SELECT Arduino.idArduino, Arduino.NombreArduino FROM Estaciones.Arduino;";

                                $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
                                while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

                                    echo '<option value="' . $line['idArduino'] . '">' . $line['NombreArduino'] . '</option>';
                                }
                                mysql_free_result($result);
                                mysql_close($link);
                                ?>
                            </select>
                            <br>
                            <br>
                            <table class="table table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Variable</th>
                                        <th>Descripcion</th>
                                    </tr>
                                </thead>
                                <tbody id="cuerpoTabla">
                                </tbody>
                            </table>
                        </div>

                    </div>


                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </body>
</html>
