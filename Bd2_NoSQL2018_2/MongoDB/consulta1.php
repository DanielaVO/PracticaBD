<?php

    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    $mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

	/*Se recuperan los argumentos*/
	 $placa = htmlspecialchars($_GET["placa"]);
	 $fedesde = htmlspecialchars($_GET["fedesde"]);
	 $fehasta = htmlspecialchars($_GET["fehasta"]);
       
?>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
	<table table width="70%" border="1px" align="center">
		<tr align="center">
			<td colspan="3"><h4><font color="GRAY">Q1- Dado el vehículo(placas) y rango de fechas, se puede consultar las infracciones (mas de 80km).
				Listando fecha, hora, lugar.</font></h4></td>
		</tr>
		<tr>
			<td align="center"><b>Fecha</td>
			<td align="center"><b>Hora</td>
			<td align="center"><b>Lugar</td>
		</tr>
		<?php
		$time_start = microtime(true); // Tiempo Inicial Proceso
		/*Se crea el query de consulta*/
		$filter = ['placa' => $placa];
		$options = ['fecha' => [
						'$gte' => strtotime($fedesde),
						'$lt' => strtotime($fehasta),]
					];
		$q = new MongoDB\Driver\Query($filter, $options);

		/*Ejecuta el query */
		$result = $mongo -> executeQuery('tecnicasBD.fotodetecciones', $q);

		/*Ciclo que recupera los datos de la consulta */
		foreach($result as $row){
		?>
			<tr>
				<td><?php echo date('Y/m/d', $row -> fecha); ?></td>
				<td><?php echo date('H:i:s', $row -> fecha);?></td>
				<td><?php echo $row -> nomLugares;?></td>
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