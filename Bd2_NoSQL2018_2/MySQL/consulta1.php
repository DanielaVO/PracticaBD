<?php

    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
  
	/*Se recuperan los argumentos*/
	 $placa = htmlspecialchars($_GET["placa"]);
	 $fedesde = htmlspecialchars($_GET["fedesde"]);
	 $fehasta = htmlspecialchars($_GET["fehasta"]);
     $desde =  strtotime($fedesde)*1000;
     $hasta =  strtotime($fehasta)*1000;

     $conn = new mysqli('127.0.0.1:3306', 'root', '','fotodeteccionesbd');
         
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<h4>Q1- Dado el vehículo(placas) y rango de fechas, se puede consultar las infracciones (mas de 80km).
        Listando fecha, hora, lugar.</h4>

<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso
$q = "SELECT date_format(fecha, '%Y/%m/%d') fecha, date_format(fecha, '%H:%i:%s') hora, Lugares_id 
      FROM fotodetecciones
      WHERE fecha BETWEEN '${fedesde}' AND '${fehasta}'
      AND vehiculos_placa = '${placa}'";
         
$result = $conn -> query($q);

	foreach($result as $row){
        echo $row['fecha']. "-";
        echo $row['hora']. "-";
		echo $row['Lugares_id']. "<br>";
		 
	}
?>

<?php
$time_end = microtime(true); 
$time = $time_end - $time_start; 
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>