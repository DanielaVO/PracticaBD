<?php

    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    $mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

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
$timeStamp = strtotime("$year-$mes");
$mes += 1;
$nextTimeStamp = strtotime("$year-$mes");
$filterExpr = ['placa' => $placa, 
                'fecha' => [				
                    '$gte' => $timeStamp,
                    '$lt' => $nextTimeStamp
                ]
            ];

$filter = ['$and' => [$filterExpr]];
echo json_encode($filter, JSON_PRETTY_PRINT);
$q = new MongoDB\Driver\Query($filter);
         
$result = $mongo -> executeQuery('tecnicasBD.fotodetecciones', $q);

	foreach($result as $row){
        echo $row -> nomLugares." - ";
		echo $row -> placa."<br>";
	}
?>

<?php
$time_end = microtime(true); 
$time = $time_end - $time_start; 
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>