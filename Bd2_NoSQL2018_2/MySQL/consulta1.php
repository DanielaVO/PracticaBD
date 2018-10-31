<?php

    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
  
	/*Se recuperan los argumentos*/
	 $placa = htmlspecialchars($_GET["placa"]);
	 $fedesde = htmlspecialchars($_GET["fedesde"]);
	 $fehasta = htmlspecialchars($_GET["fehasta"]);
     $desde =  strtotime($fedesde)*1000;
     $hasta =  strtotime($fehasta)*1000;

     /*Se establece conexión a bd */
     $conn = new mysqli('127.0.0.1:3306', 'root', '','fotodeteccionesbd');
         
?>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
    <table table width="70%" border="1px" align="center">
    <tr align="center">
    <td colspan="3"><h4><font color="PINK">Q1- Dado el vehículo(placas) y rango de fechas, se puede consultar las infracciones (mas de 80km).
            Listando fecha, hora, lugar.</font></h4></td>
    </tr>
    <tr>
            <td align="center"><b>Fecha</td>
            <td align="center"><b>Hora</td>
            <td align="center"><b>Lugar</td>
        </tr>
    
    <?php
    $time_start = microtime(true); // Tiempo Inicial Proceso
    /*Query a ejecutar*/
    $q = "SELECT date_format(fecha, '%Y/%m/%d') fecha, date_format(fecha, '%H:%i:%s') hora, l.nombre nombre 
        FROM fotodetecciones f INNER JOIN lugares l ON f.Lugares_id = l.id
        WHERE fecha BETWEEN '${fedesde}' AND '${fehasta}'
        AND vehiculos_placa = '${placa}'";

    /*Ejecuta el query */    
    $result = $conn -> query($q);

    /*Ciclo que recupera los datos de la consulta */
    foreach($result as $row){	 
    ?>
        <tr>
            <td><?php echo $row['fecha'];?></td>
            <td><?php echo $row['hora'];?></td>
            <td><?php echo $row['nombre'];?></td>
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