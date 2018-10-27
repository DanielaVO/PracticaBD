<?php
/*
	Creado por Sergio Alvarez
	Version 1.0 - 2018/10/04
	Tecnicas avanzadas de base de datos - UDEM
	
	Nota: En Archivo donde no hay que contabilizar los tiempos
*/

/*Se recuperan los argumentos*/
$lugar		= htmlspecialchars($_GET["lugar"]);
$placa		= htmlspecialchars($_GET["placa"]);
$tiempo		= htmlspecialchars($_GET["tiempo"]);
$velocidad	= htmlspecialchars($_GET["velocidad"]);
$fecha		= date($tiempo);
$mes		= date('m', $fecha);
$year		= date('Y', $fecha);
$hora 		= date('H', $fecha);
$nomLugares = htmlspecialchars($_GET["nomLugares"]);
$tiempo = $tiempo*1000;

echo $mes ."-";
echo $fecha. "-";
echo $year;

/*Validación de argumentos*/
/*
echo 'lugar='. 		$lugar .'</br>';
echo 'placa='. 		$placa .'</br>';
echo 'tiempo='. 	$tiempo .'</br>';
echo 'velocidad='. 	$velocidad;'</br>';
*/

/* ==--> Aqui ustede debe hacer la conexion a la base de datos*/

$cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
// Seleccionar la base de datos
$session   = $cluster->connect("fotodetecciones");

/* ==--> Se arma el Batch*/

$q = "BEGIN UNLOGGED BATCH
	INSERT INTO infracciones_by_fecha(id, fecha, hora, nombre, placa) VALUES (1, ${tiempo}, ${hora}, '${nomLugares}', '${placa}');
	INSERT INTO informefotodetecciones(id, fecha, placa, velocidad) VALUES(${lugar}, ${tiempo}, '${placa}', ${velocidad});
	INSERT INTO infracciones_by_placa(placa, fecha, nombre) VALUES('${placa}', ${tiempo}, '${nomLugares}');
	INSERT INTO infracciones_by_lugar(id, fecha, hora, placa, velocidad) VALUES(${lugar}, ${tiempo}, ${hora}, '${placa}', ${velocidad});
	APPLY BATCH;"; 
	
$q2 ="BEGIN COUNTER BATCH
	UPDATE numinfracciones_by_placa SET vehiculos_placa1 = vehiculos_placa1 + 1 WHERE vehiculos_placa = '${placa}' AND nombre = '${nomLugares}';
	UPDATE estadisticas SET id = id + 1 WHERE mes = ${mes} AND year = ${year} AND placa = '${placa}'  AND nombre = '${nomLugares}';
 	APPLY BATCH;";

/* ==--> insertar el o los registros*/

$statement = new Cassandra\SimpleStatement($q);
$statement2 = new Cassandra\SimpleStatement($q2);
$session->execute($statement2);
$session->execute($statement);
$session->close();

/*retornar el texto con resultado*/
echo "OK";
?>