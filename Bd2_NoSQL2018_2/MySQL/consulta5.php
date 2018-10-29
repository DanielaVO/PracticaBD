<?php

    $URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
  
	/*Se recuperan los argumentos*/
	 $placa = htmlspecialchars($_GET["placa"]);

     $conn = new mysqli('127.0.0.1:3306', 'root', '','fotodeteccionesbd');
         
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<h4>Q5- Dada una placa consultar el numero de foto detecciones que posee y el lugar donde fue capturada.</h4>
<body>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso
$q = "SELECT Lugares_id, COUNT(*) numFoto 
      FROM fotodetecciones
      WHERE vehiculos_placa = '${placa}'";
         
$result = $conn -> query($q);

	foreach($result as $row){
        echo $row['numFoto']. "-";
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