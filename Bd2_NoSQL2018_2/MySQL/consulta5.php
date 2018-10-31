<?php

    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
  
	/*Se recuperan los argumentos*/
	 $placa = htmlspecialchars($_GET["placa"]);

     $conn = new mysqli('127.0.0.1:3306', 'root', '','fotodeteccionesbd');
         
?>
	 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
	<table table width="70%" border="1px" align="center">
		<tr align="center">
			<td colspan="2"><h4><font color="PINK">Q5- Dada una placa consultar el numero de 
				foto detecciones que posee y el lugar donde fue capturada.</font></h4></td>
		</tr>
		<tr>
			<td align="center"><b>Lugar</td>
			<td align="center"><b>Número fotodetecciones</td>		
		</tr>
				
	<?php
	$time_start = microtime(true); // Tiempo Inicial Proceso
	/*Query a ejecutar*/
	$q = "SELECT l.nombre nombre, COUNT(*) numFoto 
			FROM fotodetecciones f INNER JOIN lugares l ON f.Lugares_id = l.id
			WHERE Vehiculos_placa = '${placa}'
			GROUP BY l.nombre";
			
	$result = $conn -> query($q);

	/*Ciclo que recupera los datos de la consulta */
	foreach($result as $row){	 
	?>
	<tr>
		<td><?php echo $row['nombre'];?></td>
		<td><?php echo $row['numFoto'];?></td>
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