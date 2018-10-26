CREATE KEYSPACE FotoDetecciones WITH replication = {'class':'SimpleStrategy', 'replication_factor':1};
USE FotoDetecciones;

// Q1:
CREATE TABLE infracciones_by_placa (placa TEXT, fecha TIMESTAMP, nombre TEXT, PRIMARY KEY (placa,fecha)) WITH CLUSTERING ORDER BY (fecha ASC);

/* SELECT fecha, nombre FROM infracciones_by_placa WHERE placa=? and fecha>? and fecha<?; */

// Q2:
CREATE TABLE estadisticas (mes INT, year INT, placa TEXT, nombre TEXT, id COUNTER, PRIMARY KEY ((mes,year,placa),nombre)) WITH CLUSTERING ORDER BY (nombre ASC);

/* SELECT nombre, id FROM estadisticas WHERE mes=? and year=? and placa=?; */

// Q3:
CREATE TABLE infracciones_by_lugar (id INT, fecha TIMESTAMP,hora INT, placa TEXT, velocidad INT, PRIMARY KEY ((id,fecha)));

/* SELECT fecha, placa, hora, velocidad FROM infracciones_by_lugar WHERE id=? and fecha=?; */

// Q4:
CREATE TABLE infracciones_by_fecha (fecha TIMESTAMP, hora INT, nombre TEXT, placa TEXT, PRIMARY KEY (fecha));

/* SELECT nombre, placa, hora FROM infracciones_by_fecha WHERE fecha=?; */

// Q5:
CREATE TABLE numInfracciones_by_placa (vehiculos_placa TEXT, fecha TIMESTAMP, nombre TEXT, vehiculos_placa1 COUNTER, PRIMARY KEY (vehiculos_placa,fecha,nombre)) WITH CLUSTERING ORDER BY (fecha ASC, nombre ASC);

/* SELECT vehiculos_placa, nombre, vehiculos_placa FROM numInfracciones_by_placa WHERE vehiculos_placa=?; */

// Q6:
CREATE TABLE informeFotoDetecciones (id INT, fecha TIMESTAMP, velocidad INT, placa TEXT, PRIMARY KEY (id)) WITH CLUSTERING ORDER BY (fecha ASC);

/* SELECT fecha, velocidad, placa FROM informeFotoDetecciones WHERE id=?; */

