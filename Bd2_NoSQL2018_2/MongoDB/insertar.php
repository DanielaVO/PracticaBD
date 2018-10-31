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
$nomLugares = htmlspecialchars($_GET["nomLugares"]);

/* ==--> Aqui ustede debe hacer la conexion a la base de datos*/
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");


// Armar el JSon Para insertar
$documento = ['placa' => $placa, 'fecha' => intval($tiempo), 'lugar' => $lugar, 'nomLugares' => $nomLugares, 'velocidad' => intval($velocidad)];


/* ==--> insertar el o los registros*/
$bulk = new MongoDB\Driver\BulkWrite;
$id_documento = $bulk->insert($documento);
//var_dump($id_documento);
$result = $manager->executeBulkWrite('tecnicasBD.fotodetecciones', $bulk);

/*retornar el texto con resultado*/
echo "OK";
?>