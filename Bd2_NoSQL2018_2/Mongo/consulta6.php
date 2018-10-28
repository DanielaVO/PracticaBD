<?php

    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    $mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

	/*Se recuperan los argumentos*/
    $lugar = htmlspecialchars($_GET["lugar"]);

?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<h4>Q6- Listar toda la información de las foto detecciones de un lugar determinado. Listando fecha, velocidad, 
        vehículo(placa).</h4>

<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso

$filter = ['lugar' => (string) $lugar];

$q = new MongoDB\Driver\Query($filter);
         
$result = $mongo -> executeQuery('tecnicasBD.fotodetecciones', $q);

	foreach($result as $row){
   
        echo date('Y/m/d', $row -> fecha) ." - ";
        echo date('H:i:s', $row -> fecha) ." - ";
        echo $row -> placa." - ";
		echo $row -> velocidad."<br>";
	}
?>

<?php
$time_end = microtime(true); 
$time = $time_end - $time_start; 
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>