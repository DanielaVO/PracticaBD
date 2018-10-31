<?php
$URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/'; 
$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

/*Se recuperan los argumentos*/
$placa = htmlspecialchars($_GET["placa"]);
    
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
    <table table width="70%" border="1px" align="center">
        <tr align="center">
        <td colspan="2"><h4><font color="GRAY">Q5- Dada una placa consultar el numero de foto detecciones que posee y el lugar donde fue capturada.</font></h4></td>
        </tr>
        <tr>
            <td align="center"><b>Lugar</td>
            <td align="center"><b>Número fotodetecciones</td>		
        </tr>
        
        <?php
        $time_start = microtime(true); // Tiempo Inicial Proceso
        
        /*Query a ejecutar*/
        $q = new MongoDB\Driver\Command([
            'aggregate' => 'fotodetecciones',
            'pipeline' =>[
                [
                    '$match' =>[
                        'placa' => $placa
                    ]
                ],
                [
                '$group' => [
                            '_id' => [         
                                'nomLugares' => '$nomLugares'
                            ],
                            'numFoto' => ['$sum' => 1]  
                        ]
                    ]
                ],
                'cursor' => new stdClass,
        ]);

        /*Ejecutar comando*/
        $result = $mongo -> executeCommand('tecnicasBD', $q);

        /*Ciclo que recupera los datos de la consulta */
        foreach($result as $row){
        ?>
            <tr>
                <td><?php echo $row -> _id-> nomLugares; ?></td>
                <td><?php echo $row -> numFoto;?></td>
            </tr>
        <?php
        }
        /*Tiempo del proceso */
        $time_end = microtime(true); 
        $time = $time_end - $time_start; 
        ?>
            <tr>
                <td colspan="3" align="center"><b><h4>Tiempo del proceso: <?php echo $time; ?></h4></td>

            </tr>
    </table>
</body>
</html>