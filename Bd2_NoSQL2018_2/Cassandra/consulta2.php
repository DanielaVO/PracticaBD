<?php
    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    
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
	<h4>Q2- Dada el año, mes y el vehículo(placas), se puede consultar las estadísticas de total de pasos por cada
        lugar. Listando lugar y número de pasadas.</h4>

<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso
$q = "SELECT nombre, id 
        FROM estadisticas 
        WHERE mes= ${mes} AND year = ${year} AND placa = '${placa}';";
         
$statement = new Cassandra\SimpleStatement($q);
$result    = $session->execute($statement);

	foreach($result as $row){
				
        echo $row['nombre'];
        echo $row['id']. "<br>";	 
	}
?>

<?php
$time_end = microtime(true); 
$time = $time_end - $time_start; 
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>