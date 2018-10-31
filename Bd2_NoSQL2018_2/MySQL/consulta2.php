<?php

    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';

	/*Se recuperan los argumentos*/
    $year = htmlspecialchars($_GET["anio"]);
    $mes = htmlspecialchars($_GET["mes"]);
    $placa = htmlspecialchars($_GET["placa"]);

    $conn = new mysqli('127.0.0.1:3306', 'root', '','fotodeteccionesbd');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
    <table table width="70%" border="1px" align="center">
        <tr align="center">
        <td colspan="2"><h4><font color="PINK">Q2- Dada el año, mes y el vehículo(placas), se puede consultar las estadísticas de total de pasos por cada
            lugar. Listando lugar y número de pasadas.</font></h4></td>
        </tr>
        <tr>
            <td align="center"><b>Lugar</td>
            <td align="center"><b>Número de pasadas</td>
        </tr>
        
        <?php
        $time_start = microtime(true); // Tiempo Inicial Proceso

        $timeStamp = strtotime("$year-$mes");
        $mesF = $mes + 1;
        $nextTimeStamp = strtotime("$year-$mes");

        /*Query a ejecutar*/
        $q = "SELECT l.nombre nombre, COUNT(*) numPasos
            FROM fotodetecciones f INNER JOIN lugares l ON f.Lugares_id = l.id
            WHERE fecha BETWEEN '$year-$mes-01' AND DATE_ADD('$year-$mes-01', INTERVAL 1 MONTH)
            AND vehiculos_placa = '${placa}'
            GROUP BY Lugares_id";

        /*Ejecuta el query */         
        $result = $conn -> query($q);

        foreach($result as $row){

        ?>
            <tr>
                <td><?php echo $row['nombre'];?></td>
                <td><?php echo $row['numPasos'];?></td>
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