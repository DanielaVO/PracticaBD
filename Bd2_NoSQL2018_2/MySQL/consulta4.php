<?php
    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    

	/*Se recuperan los argumentos*/
    $date = htmlspecialchars($_GET["fecha"]);
    $conn = new mysqli('127.0.0.1:3306', 'root', '','fotodeteccionesbd');
    
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<h4>Q4- Dado una fecha se puede consultar los vehículos(placas) que sobrepasaron 80km, listando hora del
        día, lugar y placa.</h4>
<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso

$q = "SELECT date_format(fecha, '%H:%i:%s') hora, Lugares_id, vehiculos_placa
      FROM fotodetecciones
      WHERE fecha BETWEEN '${date}' AND DATE_ADD('${date}', INTERVAL 1 DAY)";
         
$result = $conn -> query($q);

	foreach($result as $row){
        echo $row['hora']. "-";
        echo $row['Lugares_id']. "-";
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