<?php

    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    $mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

	/*Se recuperan los argumentos*/
	 $placa = htmlspecialchars($_GET["placa"]);
	 $fedesde = htmlspecialchars($_GET["fedesde"]);
	 $fehasta = htmlspecialchars($_GET["fehasta"]);
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<h4>Q1- Dado el vehículo(placas) y rango de fechas, se puede consultar las infracciones (mas de 80km).
        Listando fecha, hora, lugar.</h4>

<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso

$filter = ['placa' => $placa];
$options = ['fecha' => [
                        '$gte' => strtotime($fedesde),
                        '$lt' => strtotime($fehasta),]
            ];
$q = new MongoDB\Driver\Query($filter, $options);
         
$result = $mongo -> executeQuery('tecnicasBD.fotodetecciones', $q);

	foreach($result as $row){
		$fecha = date['fecha'];
		$tiempo = date($fecha);
		$date = date('Y/m/d', $tiempo/1000);
    
        echo date('Y/m/d', $row -> fecha);
        echo date('H:i:s', $row -> fecha);
		echo $row -> lugar "<br>";
		 
	}
?>

<?php
$time_end = microtime(true); 
$time = $time_end - $time_start; 
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>