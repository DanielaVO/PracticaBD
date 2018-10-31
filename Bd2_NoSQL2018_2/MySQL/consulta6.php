<?php

    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
  
	/*Se recuperan los argumentos*/
    $lugar = htmlspecialchars($_GET["lugar"]);

    $conn = new mysqli('127.0.0.1:3306', 'root', '','fotodeteccionesbd');
         
?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
    <table table width="70%" border="1px" align="center">
        <tr align="center">
                <td colspan="3"><h4><font color="PINK">Q6- Listar toda la información de las foto detecciones de un
                lugar determinado. Listando fecha, velocidad, vehículo(placa).</font></h4></td>
        </tr>
        <tr>
                <td align="center"><b>Fecha</td>
                <td align="center"><b>Velocidad</td>
                <td align="center"><b>Placa</td>			
        </tr>
                
    <?php
    $time_start = microtime(true); // Tiempo Inicial Proceso
    /*Query a ejecutar*/
    $q = "SELECT date_format(fecha, '%Y/%m/%d') fecha, velocidad, vehiculos_placa
        FROM fotodetecciones
        WHERE Lugares_id = '${lugar}'";
            
    $result = $conn -> query($q);

    /*Ciclo que recupera los datos de la consulta */
    foreach($result as $row){	 
    ?>
    <tr>
        <td><?php echo $row['fecha'];?></td>
        <td><?php echo $row['velocidad'];?></td>
        <td><?php echo $row['vehiculos_placa'];?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    $time_end = microtime(true); 
    $time = $time_end - $time_start; 
    ?>
        <tr>
            <td colspan="3" align="center"><b><h4>Tiempo del proceso: <?php echo $time; ?></h4></td>
        </tr>
    </table>
</body>
</html>