<?php

    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    $mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

	/*Se recuperan los argumentos*/
    $lugar = htmlspecialchars($_GET["lugar"]);
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
    <table table width="70%" border="1px" align="center">
        <tr align="center">
        <td colspan="3"><h4><font color="GRAY">Q6- Listar toda la información de las foto detecciones de un lugar determinado. Listando fecha, velocidad, 
                vehículo(placa).</font></h4></td>
        </tr>
        <tr>
            <td align="center"><b>Fecha</td>
            <td align="center"><b>Velocidad</td>
            <td align="center"><b>Placa</td>			
        </tr>
        
        <?php
        $time_start = microtime(true); // Tiempo Inicial Proceso
        /*Query a ejecutar*/
        $filter = ['lugar' => $lugar];

        $q = new MongoDB\Driver\Query($filter);
        /*Ejecuta el query */
        $result = $mongo -> executeQuery('tecnicasBD.fotodetecciones', $q);

        /*Ciclo que recupera los datos de la consulta */
        foreach($result as $row){
        ?>
            <tr>
                <td><?php echo date('Y/m/d', $row -> fecha); ?></td>
                <td><?php echo $row -> velocidad;?></td>
                <td><?php echo $row -> placa;?></td>
            </tr>
        <?php
        }
        ?>
        <?php
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