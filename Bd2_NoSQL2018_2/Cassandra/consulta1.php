<?php

    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    
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
	<h4>Q1- Dado el vehículo(placas) y rango de fechas, se puede consultar las infracciones (mas de 80km).
        Listando fecha, hora, lugar.</h4>

<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso
$rows = "SELECT fecha, nombre 
		 FROM infracciones_by_placa 
         WHERE placa = '${placa}' AND fecha > ${desde} AND fecha < ${hasta};";
         
$statement = new Cassandra\SimpleStatement($rows);
$result    = $session->execute($statement);

	foreach($result as $row){
		$fecha = $row['fecha'];
		$tiempo = date($fecha);
		$date = date('Y/m/d', $tiempo/1000);
		$hora = date('H:i:s', $tiempo/1000);
		
	    echo $date . "-"; 
		echo $hora;
		echo $row['nombre']. "<br>";
		 
	}
?>

<?php
$time_end = microtime(true); 
$time = $time_end - $time_start; 
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>