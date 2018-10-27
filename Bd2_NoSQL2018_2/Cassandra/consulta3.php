<?php
    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    
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
	<h4>Q3- Dada una fecha y lugar se puede consultar las horas del día, vehículo(placas) y velocidad.</h4>

<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso
/*CREATE TABLE infracciones_by_lugar (id INT, fecha TIMESTAMP, hora INT, placa TEXT, velocidad INT, PRIMARY KEY (id,fecha)) WITH CLUSTERING ORDER BY (fecha ASC);
 */
$q = "SELECT placa, hora, velocidad 
        FROM infracciones_by_lugar 
        WHERE id = ${lugar} AND fecha >= ${fecha} AND fecha < ${f2};";
         
$statement = new Cassandra\SimpleStatement($rows);
$result    = $session->execute($statement);

	foreach($result as $row){

        echo $row['hora'] . "-";
        echo $row['placa']. "-";
        echo $row['velocidad']. "<br>";	 
	}
?>

<?php
$time_end = microtime(true); 
$time = $time_end - $time_start; 
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>