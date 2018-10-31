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

/* ==--> Aqui ustede debe hacer la conexion a la base de datos*/

// Create connection (Puerto, Usuario, Clave y base datos)
$conn = new mysqli('127.0.0.1:3306', 'root', '','fotoDeteccionesBD');

$date = date('Y/m/d H:i:s', $tiempo);

/*Se arma el Insert*/
$sql = "INSERT INTO fotodetecciones(fecha, velocidad, vehiculos_placa, Lugares_id) VALUES('${date}', ${velocidad}, '${placa}', ${lugar});";

/* ==--> insertar el o los registros*/
$conn->query($sql);
$conn->close();
/*retornar el texto con resultado*/
echo "OK";
?>