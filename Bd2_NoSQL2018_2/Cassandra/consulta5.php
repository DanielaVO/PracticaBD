<?php
    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    
    $cluster   = Cassandra::cluster()
     ->withContactPoints('127.0.0.1')
     ->build();
    $session   = $cluster->connect("fotodetecciones");

	/*Se recuperan los argumentos*/
    $placa = htmlspecialchars($_GET["placa"]);
         
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<h4>Q5- Dada una placa consultar el numero de foto detecciones que posee y el lugar donde fue capturada.</h4>

<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso

$q = "SELECT vehiculos_placa, nombre, vehiculos_placa1 FROM numInfracciones_by_placa WHERE vehiculos_placa= '${placa}';";
         
$statement = new Cassandra\SimpleStatement($q);
$result    = $session->execute($statement);

	foreach($result as $row){

        echo $row['vehiculos_placa'] . "-";
        echo $row['nombre']. "-";
        echo $row['vehiculos_placa1']. "<br>";	 
	}
?>

<?php
$time_end = microtime(true); 
$time = $time_end - $time_start; 
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>