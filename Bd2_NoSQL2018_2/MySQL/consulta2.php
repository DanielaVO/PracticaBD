<?php

    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';

	/*Se recuperan los argumentos*/
    $year = htmlspecialchars($_GET["anio"]);
    $mes = htmlspecialchars($_GET["mes"]);
    $placa = htmlspecialchars($_GET["placa"]);

    $conn = new mysqli('127.0.0.1:3306', 'root', '','fotodeteccionesbd');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<h4>Q2- Dada el año, mes y el vehículo(placas), se puede consultar las estadísticas de total de pasos por cada
        lugar. Listando lugar y número de pasadas.</h4>

<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso

$timeStamp = strtotime("$year-$mes");
$mesF = $mes + 1;
$nextTimeStamp = strtotime("$year-$mes");

$q = "SELECT Lugares_id, COUNT(*) numPasos
      FROM fotodetecciones
      WHERE fecha BETWEEN '$year-$mes-01' AND DATE_ADD('$year-$mes-01', INTERVAL 1 MONTH)
      AND vehiculos_placa = '${placa}'
      GROUP BY Lugares_id";
         
$result = $conn -> query($q);

	foreach($result as $row){
        echo $row['Lugares_id']. "-";
		echo $row['numPasos']. "<br>";
    }
?>

<?php
$time_end = microtime(true); 
$time = $time_end - $time_start; 
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>