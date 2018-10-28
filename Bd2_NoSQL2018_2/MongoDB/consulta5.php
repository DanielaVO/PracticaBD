<?php
    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    
    $mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

	/*Se recuperan los argumentos*/
    $placa = htmlspecialchars($_GET["placa"]);
    
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <h4>Q5- Dada una placa consultar el numero de foto detecciones que posee y el lugar donde fue capturada.</h4>
<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso

$q = new MongoDB\Driver\Command([
    'aggregate' => 'fotodetecciones',
    'pipeline' =>[
        [
            '$match' =>[
                'placa' => $placa
            ]
        ],
        [
          '$group' => [
                      '_id' => [         
                         'nomLugares' => '$nomLugares'
                      ],
                      'numFoto' => ['$sum' => 1]  
                ]
            ]
          ],
          'cursor' => new stdClass,
]);

$result = $mongo -> executeCommand('tecnicasBD', $q);

	foreach($result as $row){
        echo $row -> _id-> nomLugares. "-";
        echo $row -> numFoto."<br>";
    }
?>

<?php
$time_end = microtime(true); 
$time = $time_end - $time_start; 
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>