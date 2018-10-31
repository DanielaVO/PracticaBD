<?php
$URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';    
$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

/*Se recuperan los argumentos*/
$lugar = htmlspecialchars($_GET["lugar"]);
$date = htmlspecialchars($_GET["fecha"]);

?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
    <table table width="70%" border="1px" align="center">
        <tr align="center">
        <td colspan="3"><h4><font color="GRAY">Q3- Dada una fecha y lugar se puede consultar las horas del día, vehículo(placas) y velocidad.</font></h4></td>
        </tr>
        <tr>
            <td align="center"><b>Hora</td>
            <td align="center"><b>Vehículo</td>
            <td align="center"><b>Velocidad</td>
        </tr>
        
        <?php
        $time_start = microtime(true); // Tiempo Inicial Proceso
        /*Se convierte la fecha en unix */
        $fecha = strtotime($date);
        $fechaEnd = strtotime($date . ' +1 day');

        /*Se crea el query de consulta*/
        $filterExp = ['fecha' => [				
                            '$gte' => $fecha,
                            '$lt' => $fechaEnd
                        ],
            'lugar' => $lugar
        ];
        $filter = ['$and' => [$filterExp]];
        $q = new MongoDB\Driver\Query($filter);
        /*Ejecuta el query */
        $result = $mongo -> executeQuery('tecnicasBD.fotodetecciones', $q);
        
        /*Ciclo que recupera los datos de la consulta */
        foreach($result as $row){
        ?>
            <tr>
                <td><?php echo date('H:i:s', $row -> fecha); ?></td>
                <td><?php echo $row -> placa;?></td>
                <td><?php echo $row -> velocidad;?></td>
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