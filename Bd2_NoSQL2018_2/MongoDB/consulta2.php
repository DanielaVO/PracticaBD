<?php

$URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

/*Se recuperan los argumentos*/
$year = htmlspecialchars($_GET["anio"]);
$mes = htmlspecialchars($_GET["mes"]);
$placa = htmlspecialchars($_GET["placa"]);

?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
    <table table width="70%" border="1px" align="center">
        <tr align="center">
        <td colspan="2"><h4><font color="GRAY">Q2- Dada el año, mes y el vehículo(placas), se puede consultar las estadísticas de total de pasos por cada
            lugar. Listando lugar y número de pasadas.</font></h4></td>
        </tr>
        <tr>
                <td align="center"><b>Lugar</td>
                <td align="center"><b>Número de pasadas</td>
        </tr>
        
        <?php
        $time_start = microtime(true); // Tiempo Inicial Proceso
        $timeStamp = strtotime("$year-$mes");
        $mes += 1;
        $nextTimeStamp = strtotime("$year-$mes");

        /*Se crea el query de consulta*/
        $q = new MongoDB\Driver\Command([
            'aggregate' => 'fotodetecciones',
            'pipeline' =>[
                [
                    '$match' =>[
                        'placa' => $placa, 
                        'fecha' => [				
                                    '$gte' => $timeStamp,
                                    '$lt' => $nextTimeStamp
                                    ]
                    ]
                ],
                [
                '$group' => [
                            '_id' => [         
                                'nomLugares' => '$nomLugares'
                            ],
                            'numPasos' => ['$sum' => 1]  
                        ]
                    ]
                ],
                'cursor' => new stdClass,
        ]);
        /*Ejecuta el query */
        $result = $mongo -> executeCommand('tecnicasBD', $q);

        /*Ciclo que recupera los datos de la consulta */
        foreach($result as $row){       
        ?>
            <tr>
                <td><?php echo $row -> _id-> nomLugares; ?></td>
                <td><?php echo $row -> numPasos;?></td>
            </tr>
        <?php
        }
        /*Tiempo del proceso */
        $time_end = microtime(true); 
        $time = $time_end - $time_start; 
        ?>
            <tr>
                <td colspan="2" align="center"><b><h4>Tiempo del proceso: <?php echo $time; ?></h4></td>
            </tr>
    </table>
</body>
</html>