<?php
    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    
    $mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

	/*Se recuperan los argumentos*/
    $date = htmlspecialchars($_GET["fecha"]);
    
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<h4>Q4- Dado una fecha se puede consultar los vehículos(placas) que sobrepasaron 80km, listando hora del
        día, lugar y placa.</h4>
<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso

$fecha = strtotime($date);
$fechaEnd = strtotime($date . ' +1 day');

$filterExp = ['fecha' => [				
                    '$gte' => $fecha,
                    '$lt' => $fechaEnd
                ]
];

$q = new MongoDB\Driver\Query($filterExp);
         
$result = $mongo -> executeQuery('tecnicasBD.fotodetecciones', $q);

	foreach($result as $row){
        echo date('H:i:s', $row -> fecha) ." - ";
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