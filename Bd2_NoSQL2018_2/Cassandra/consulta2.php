<?php
$URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';

/*  Aqui ustede debe hacer la conexion a la base de datos*/    
$cluster   = Cassandra::cluster()
     ->withContactPoints('127.0.0.1')
     ->build();
$session   = $cluster->connect("fotodetecciones");

/*Se recuperan los argumentos*/
$year = htmlspecialchars($_GET["anio"]);
$mes = htmlspecialchars($_GET["mes"]);
$placa = htmlspecialchars($_GET["placa"]);
         
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
<table table width="70%" border="1px" align="center">
<tr align="center">
  <td colspan="2"><h4><font color="Orange">Q2- Dada el año, mes y el vehículo(placas), se puede consultar las estadísticas de total de pasos por cada
      lugar. Listando lugar y número de pasadas.</font></h4></td>
</tr>
<tr>
		<td align="center"><b>Lugar</td>
		<td align="center"><b>Número de pasadas</td>
	</tr>
 
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso
/*Query a ejecutar*/
$q = "SELECT nombre, id 
        FROM estadisticas 
        WHERE mes= ${mes} AND year = ${year} AND placa = '${placa}';";

/*Ejecuta el query */
$statement = new Cassandra\SimpleStatement($q);
$result    = $session->execute($statement);

/*Ciclo que recupera los datos de la consulta */
foreach($result as $row){			
?>
	<tr>
		<td><?php echo $row['nombre']; ?></td>
		<td><?php echo $row['id']. "<br>";?></td>
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