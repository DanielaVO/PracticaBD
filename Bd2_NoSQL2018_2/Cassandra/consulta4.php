<?php
    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    
    $cluster   = Cassandra::cluster()
     ->withContactPoints('127.0.0.1')
     ->build();
    $session   = $cluster->connect("fotodetecciones");

	/*Se recuperan los argumentos*/
    $date = htmlspecialchars($_GET["fecha"]);
    $fecha =  strtotime($date)*1000;
    $fehasta = strtotime($date . "+1 days");
    $f2 = $fehasta *1000;
         
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<h4>Q4- Dado una fecha se puede consultar los vehículos(placas) que sobrepasaron 80km, listando hora del
        día, lugar y placa.</h4>

<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso
/*CREATE TABLE infracciones_by_fecha(id INT, fecha TIMESTAMP, hora INT, nombre TEXT, placa TEXT, PRIMARY KEY (id,fecha)) WITH CLUSTERING ORDER BY (fecha ASC); */
$q = "SELECT nombre, placa, hora FROM infracciones_by_fecha WHERE id = 1 AND fecha >= ${fecha} AND fecha < ${f2};";
         
$statement = new Cassandra\SimpleStatement($q);
$result    = $session->execute($statement);

	foreach($result as $row){

        echo $row['nombre'] . "-";
        echo $row['placa']. "-";
        echo $row['hora']. "<br>";	 
	}
?>

<?php
$time_end = microtime(true); 
$time = $time_end - $time_start; 
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>