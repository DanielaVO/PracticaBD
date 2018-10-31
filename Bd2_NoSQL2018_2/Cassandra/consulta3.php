<?php
$URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    
/*  Aqui ustede debe hacer la conexion a la base de datos*/    
$cluster   = Cassandra::cluster()
     ->withContactPoints('127.0.0.1')
     ->build();
$session   = $cluster->connect("fotodetecciones");

/*Se recuperan los argumentos*/
$lugar = htmlspecialchars($_GET["lugar"]);
$date = htmlspecialchars($_GET["fecha"]);
$fecha =  strtotime($date)*1000;
$fehasta = strtotime($date . "+1 days");
$f2 = $fehasta *1000;

?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
<table table width="70%" border="1px" align="center">
<tr align="center">
  <td colspan="3"><h4><font color="Orange">Q3- Dada una fecha y lugar se puede consultar las horas del día, vehículo(placas) y velocidad.</font></h4></td>
</tr>
<tr>
		<td align="center"><b>Hora</td>
		<td align="center"><b>Vehículo</td>
		<td align="center"><b>Velocidad</td>
</tr>
 
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso
/*CREATE TABLE infracciones_by_lugar (id INT, fecha TIMESTAMP, hora INT, placa TEXT, velocidad INT, PRIMARY KEY (id,fecha)) WITH CLUSTERING ORDER BY (fecha ASC);
 */
/*Query a ejecutar*/
$q = "SELECT placa, fecha, velocidad 
        FROM infracciones_by_lugar 
        WHERE id = ${lugar} AND fecha >= ${fecha} AND fecha < ${f2};";
         
/*Ejecuta el query */
$statement = new Cassandra\SimpleStatement($q);
$result    = $session->execute($statement);

/*Ciclo que recupera los datos de la consulta */
foreach($result as $row){
        $fecha = $row['fecha'];
		$tiempo = date($fecha);
        $hora = date('H:i:s', $tiempo/1000);
?>
	<tr>
		<td><?php echo $hora; ?></td>
		<td><?php echo $row['placa'];?></td>
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