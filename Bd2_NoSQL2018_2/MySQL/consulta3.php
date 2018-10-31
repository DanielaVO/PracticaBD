<?php

$URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';

/*Se recuperan los argumentos*/
$lugar = htmlspecialchars($_GET["lugar"]);
$date = htmlspecialchars($_GET["fecha"]);

$conn = new mysqli('127.0.0.1:3306', 'root', '','fotodeteccionesbd');
     
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
<table table width="70%" border="1px" align="center">
<tr align="center">
  <td colspan="3"><h4><font color="PINK">Q3- Dada una fecha y lugar se puede consultar las horas del día, vehículo(placas) y velocidad.</font></h4></td>
</tr>
<tr>
		<td align="center"><b>Hora</td>
		<td align="center"><b>Vehículo</td>
		<td align="center"><b>Velocidad</td>
</tr>
 
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso

$fechaEnd = strtotime($date . ' +1 day');
$fechaEnd = date('Y/m/d', $fechaEnd);

/*Query a ejecutar*/
$q = "SELECT date_format(fecha, '%H:%i:%s') hora, vehiculos_placa, velocidad 
      FROM fotodetecciones
      WHERE fecha BETWEEN '${date}' AND DATE_ADD('${date}', INTERVAL 1 DAY)
      AND Lugares_id = '${lugar}'";

/*Ejecuta el query */    
$result = $conn -> query($q);

/*Ciclo que recupera los datos de la consulta */
foreach($result as $row){     
?>
<tr>
	<td><?php echo $row['hora']; ?></td>
	<td><?php echo $row['vehiculos_placa'];?></td>
	<td><?php echo $row['velocidad'];?></td>
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