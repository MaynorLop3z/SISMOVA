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
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <h1>Sistema de Mediciones con Arduino Beta 0.1</h1>
                                    <div class="panel panel-primary">
                                        <?php
                                        include("Conexion.php");
                                        $link = Connection();
                                        $idArduino = $_REQUEST['arduino'];
                                        $idSensor = $_REQUEST['sensor'];
                                        $titulo = 'Arduino: ';
                                        $query = "SELECT Arduino.NombreArduino "
                                                . "FROM Estaciones.Arduino "
                                                . "WHERE Arduino.idArduino = " . $idArduino . ";";
                                        $query2 = "SELECT var.NombreVariable "
                                                . "FROM Estaciones.Sensor sen INNER JOIN Estaciones.Variable var ON sen.idVariable = var.idVariable "
                                                . "WHERE sen.idSensor=" . $idSensor . ";";
                                        $query3 = "SELECT Sensor.NombreSensor "
                                                . "FROM Estaciones.Sensor "
                                                . "WHERE Sensor.idSensor = " . $idSensor . ";";
                                        $consultaDatos = "SELECT Medicion.Fecha,Medicion.Hora,Medicion.ValorMedido,Medicion.ValorModelado "
                                                . "FROM Estaciones.Medicion "
                                                . "WHERE Medicion.idSensor = " . $idSensor . " "
                                                . "ORDER BY Medicion.Fecha DESC,Medicion.Hora DESC "
                                                . "LIMIT 20;";

                                        $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
                                        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                            $titulo .= $line['NombreArduino'];
                                        }

                                        $titulo .=' | Sensor: ';
                                        $result = mysql_query($query3) or die('Consulta fallida: ' . mysql_error());
                                        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                            $titulo .= $line['NombreSensor'];
                                        }

                                        $titulo .=' | Variable: ';
                                        $result = mysql_query($query2) or die('Consulta fallida: ' . mysql_error());
                                        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                            $titulo .= $line['NombreVariable'];
                                        }
                                        echo '<div class="panel-heading">';
                                        echo '<h3 class="panel-title">' . $titulo . '</h3>';
                                        echo '</div>';
                                        echo '<div class="panel-body">';
                                        echo '<table class="table table-bordered table-hover table-responsive">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th>Fecha</th>';
                                        echo '<th>Hora</th>';
                                        echo '<th>Valor Medido</th>';
                                        echo '<th>Valor Modelado</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                        $result = mysql_query($consultaDatos) or die('Consulta fallida: ' . mysql_error());
                                        $arregloDatos = array();
                                        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                            array_unshift($arregloDatos, $line);
                                        }

                                        foreach ($arregloDatos as $linea) {
                                            echo "\t<tr>\n";
                                            foreach ($linea as $valor) {
                                                echo"\t\t<td>$valor</td>\n";
                                            }
                                            echo "\t</tr>\n";
                                        }
                                        echo '</tbody>';
                                        echo '</table>';
                                        echo ' <div id="chart_div" style="width: 950px; height: 700px"></div>';
                                        echo '</div>';
                                        ?>

                                    </div>
                                    <script type="text/javascript">
                                        // Load the Visualization API and the piechart package.
                                        google.load('visualization', '1.0', {'packages': ['corechart']});
                                        // Set a callback to run when the Google Visualization API is loaded.
                                        google.setOnLoadCallback(drawChart);

                                        // Callback that creates and populates a data table,
                                        // instantiates the pie chart, passes in the data and
                                        // draws it.
                                        function drawChart() {
                                            // Create the data table.
                                            var data = new google.visualization.DataTable();
                                            data.addColumn('string', 'Fecha y Hora');
                                            data.addColumn('number', 'Medicion');
                                            data.addColumn('number', 'Modelo');
                                            data.addRows([
<?php
$cont = 0;
foreach ($arregloDatos as $linea) {
    if ($cont == 0) {
        echo "['" . $linea['Fecha'] ." ". $linea['Hora'] . "'," . $linea['ValorMedido'] . "," . $linea['ValorModelado'] . "]";
    } else {
        echo ",\n";
        echo "['" . $linea['Fecha'] ." ".  $linea['Hora'] . "'," . $linea['ValorMedido'] . "," . $linea['ValorModelado'] . "]";
    }
    $cont++;
}
mysql_free_result($result);
mysql_close($link);
?>
                                            ]);

                                            // Set chart options
                                            var options = {'title': 'Grafico de Datos',
                                                'pointShape': 'circle',
                                                'pointSize': 3,
                                                'series': {
                                                    0: {color: '#2EFE9A'}
                                                },
                                                'titleTextStyle': {color: '3d3d3d', fontSize: 14},
                                                'tooltip': {textStyle: {color: '#81DAF5'}},
                                                'hAxis': {
                                                    title: 'Fecha y Hora',
                                                    textStyle: {color: '#0489B1'}
                                                },
                                                'vAxis': {
                                                    title: 'Variable Medida',
                                                    textStyle: {color: '#0489B1'}
                                                },
                                                curveType: 'function'
                                            };

                                            // Instantiate and draw our chart, passing in some options.
                                            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                                            chart.draw(data, options);
                                        }
                                    </script>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </body>
</html>
