CREATE KEYSPACE fotodetecciones WITH replication = {'class':'SimpleStrategy', 'replication_factor':1};
USE fotodetecciones;

// Q1:
CREATE TABLE infracciones_by_placa (placa TEXT, fecha TIMESTAMP, nombre TEXT, PRIMARY KEY (placa,fecha)) WITH CLUSTERING ORDER BY (fecha ASC);

/* SELECT fecha, nombre FROM infracciones_by_placa WHERE placa=? and fecha>=? AND fecha <?; */

// Q2:
CREATE TABLE estadisticas (mes INT, year INT, placa TEXT, nombre TEXT, id COUNTER, PRIMARY KEY ((mes, year,placa),nombre)) WITH CLUSTERING ORDER BY (nombre ASC);

/* SELECT nombre, id FROM estadisticas WHERE fecha=? and placa=?; */

// Q3:
CREATE TABLE infracciones_by_lugar (id INT, fecha TIMESTAMP,hora INT, placa TEXT, velocidad INT, PRIMARY KEY ((id,fecha)));

/* SELECT fecha, placa, velocidad FROM infracciones_by_lugar WHERE id=? and fecha=?; */

// Q4:
CREATE TABLE infracciones_by_fecha (id INT, fecha TIMESTAMP, hora INT, nombre TEXT, placa TEXT, PRIMARY KEY (id,fecha));

/* SELECT fecha, nombre, placa FROM infracciones_by_fecha WHERE id = 1 AND fecha>=? AND fecha <?; */

// Q5:
CREATE TABLE numInfracciones_by_placa (vehiculos_placa TEXT, nombre TEXT, vehiculos_placa1 COUNTER, PRIMARY KEY (vehiculos_placa,nombre)) WITH CLUSTERING ORDER BY (nombre ASC);

/* SELECT vehiculos_placa, nombre, vehiculos_placa1 FROM numInfracciones_by_placa WHERE vehiculos_placa=?; */

// Q6:
CREATE TABLE informeFotoDetecciones (hash VARCHAR, id INT, fecha TIMESTAMP, velocidad INT, placa TEXT, PRIMARY KEY (id,hash)) WITH CLUSTERING ORDER BY (hash ASC);

/* SELECT fecha, velocidad, placa FROM informeFotoDetecciones WHERE id=?; */

