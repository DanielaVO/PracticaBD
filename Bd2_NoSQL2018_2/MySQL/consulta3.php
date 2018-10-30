<?php

$URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';

/*Se recuperan los argumentos*/
$lugar = htmlspecialchars($_GET["lugar"]);
$date = htmlspecialchars($_GET["fecha"]);

$conn = new mysqli('127.0.0.1:3306', 'root', '','fotodeteccionesbd');
     
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<h4>Q3- Dada una fecha y lugar se puede consultar las horas del día, vehículo(placas) y velocidad.</h4>

<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso

$fechaEnd = strtotime($date . ' +1 day');
$fechaEnd = date('Y/m/d', $fechaEnd);

$q = "SELECT date_format(fecha, '%H:%i:%s') hora, vehiculos_placa, velocidad 
      FROM fotodetecciones
      WHERE fecha BETWEEN '${date}' AND DATE_ADD('${date}', INTERVAL 1 DAY)
      AND Lugares_id = '${lugar}'";
     
$result = $conn -> query($q);

foreach($result as $row){
    echo $row['hora']. "-";
    echo $row['velocidad']. "-";
    echo $row['vehiculos_placa']. "<br>";
     
}
?>

<?php
$time_end = microtime(true); 
$time = $time_end - $time_start; 
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>