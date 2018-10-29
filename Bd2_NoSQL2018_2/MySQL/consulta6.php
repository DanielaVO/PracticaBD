<?php

    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
  
	/*Se recuperan los argumentos*/
    $lugar = htmlspecialchars($_GET["lugar"]);

    $conn = new mysqli('127.0.0.1:3306', 'root', '','fotodeteccionesbd');
         
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <h4>Q6- Listar toda la información de las foto detecciones de un lugar determinado. Listando fecha, velocidad, 
        vehículo(placa).</h4>
<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso
$q = "SELECT date_format(fecha, '%Y/%m/%d') fecha, velocidad, vehiculos_placa
      FROM fotodetecciones
      WHERE Lugares_id = '${lugar}'";
         
$result = $conn -> query($q);

	foreach($result as $row){
        echo $row['fecha']. "-";
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