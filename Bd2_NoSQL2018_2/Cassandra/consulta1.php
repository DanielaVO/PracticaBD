<?php

$URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
	
/*  Aqui ustede debe hacer la conexion a la base de datos*/
$cluster   = Cassandra::cluster()
     ->withContactPoints('127.0.0.1')
     ->build();
$session   = $cluster->connect("fotodetecciones");

/*Se recuperan los argumentos*/
$placa = htmlspecialchars($_GET["placa"]);
$fedesde = htmlspecialchars($_GET["fedesde"]);
$fehasta = htmlspecialchars($_GET["fehasta"]);
$desde =  strtotime($fedesde)*1000;
$hasta =  strtotime($fehasta)*1000;

         
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
<table table width="70%" border="1px" align="center">
<tr align="center">
  <td colspan="3"><h4><font color="Orange">Q1- Dado el vehículo(placas) y rango de fechas, se puede consultar las infracciones (mas de 80km).
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
$q = "SELECT fecha, nombre 
		 FROM infracciones_by_placa 
         WHERE placa = '${placa}' AND fecha > ${desde} AND fecha < ${hasta};";

/*Ejecuta el query */
$statement = new Cassandra\SimpleStatement($q);
$result    = $session->execute($statement);

/*Ciclo que recupera los datos de la consulta */
foreach($result as $row){
	$fecha = $row['fecha'];
	$tiempo = date($fecha);
	$date = date('Y/m/d', $tiempo/1000);
	$hora = date('H:i:s', $tiempo/1000);
?>
	<tr>
		<td><?php echo $date; ?></td>
		<td><?php echo $hora;?></td>
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