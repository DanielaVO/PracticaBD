<?php
    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    
    $cluster   = Cassandra::cluster()
     ->withContactPoints('127.0.0.1')
     ->build();
    $session   = $cluster->connect("fotodetecciones");

	/*Se recuperan los argumentos*/
    $lugar = htmlspecialchars($_GET["lugar"]);
         
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<h4>Q6- Listar toda la información de las foto detecciones de un lugar determinado. Listando fecha, velocidad, 
        vehículo(placa).</h4>

<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso
/*CREATE TABLE informeFotoDetecciones(id INT, fecha TIMESTAMP,velocidad INT, placa TEXT, PRIMARY KEY (id)); */
$q = "SELECT fecha, velocidad, placa FROM informefotodetecciones WHERE id = ${lugar};";
         
$statement = new Cassandra\SimpleStatement($q);
$result    = $session->execute($statement);

	foreach($result as $row){

        $fecha = $row['fecha'];
        $f1 = date($fecha);
        $f2 = date('Y/m/d', $f1/1000);
        echo $f2 . "-";
        echo $row['velocidad']. "-";
        echo $row['placa']. "<br>";	 
	}
?>

<?php
$time_end = microtime(true); 
$time = $time_end - $time_start; 
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>