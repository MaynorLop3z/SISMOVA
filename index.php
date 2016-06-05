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
        <title>Sistema de Mediciones</title>

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
                        $.post("SensorVariable.php", {idArduino: idArduino}, function(data) {
                            $("#sensor").html(data);
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

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Acerca">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="Acerca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Acerca de...</h4>
                                </div>
                                <div class="modal-body">
                                    <p>One fine body&hellip;</p>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                                        Aenean commodo ligula eget dolor. Aenean massa. Cum sociis 
                                        natoque penatibus et magnis dis parturient montes, nascetur
                                        ridiculus mus. Donec quam felis, ultricies nec, pellentesque
                                        eu, pretium quis, sem. Nulla consequat massa quis enim. Donec
                                        pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt. 
                                        Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate 
                                        eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, 
                                        eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, 
                                        feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. 
                                        Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. 
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. 
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper 
                                        libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, 
                                        blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec 
                                        odio et ante tincidunt tempus. Donec vitae sapien ut libero 
                                        venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget 
                                        eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet 
                                        nibh. Donec sodales sagittis magna.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <h1>Sistema de Mediciones con Arduino Beta 0.1</h1>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Consultar Datos</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="formulario1" action="Datos.php" method="POST">
                                <fieldset>
                                    <legend>Arduino | Variable</legend>
                                    <label for="arduino">Arduino:</label>
                                    <select class="form-control" name="arduino" id="arduino">
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
                                    <label for="sensor">Sensor:</label>
                                    <select class="form-control" name="sensor" id="sensor">
                                    </select>

                                    <br>
                                    <button type="submit" class="btn btn-primary" name="envio"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Enviar</button>

                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <a href="consultarSensores.php" class="btn btn-success" role="button"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Listar Sensores</a>
                    <a href="AgregarSensor.php" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Sensor</a>
                    <a href="AgregarArduino.php" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Arduino</a>
                </div>
                <div class="col-md-1">
                </div>
            </div>
        </div>
    </body>
</html>
