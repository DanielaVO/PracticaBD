<?php
$URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    
$cluster   = Cassandra::cluster()
     ->withContactPoints('127.0.0.1')
     ->build();
$session   = $cluster->connect("fotodetecciones");

/*Se recuperan los argumentos*/
$lugar = htmlspecialchars($_GET["lugar"]);
           
?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
        <table table width="70%" border="1px" align="center">
                <tr align="center">
                <td colspan="3"><h4><font color="Orange">Q6- Listar toda la información de las foto detecciones de un
                 lugar determinado. Listando fecha, velocidad, vehículo(placa).</font></h4></td>
                </tr>
                <tr>
                        <td align="center"><b>Fecha</td>
                        <td align="center"><b>Velocidad</td>
                        <td align="center"><b>Placa</td>			
                </tr>
                
                <?php
                $time_start = microtime(true); // Tiempo Inicial Proceso
                /*CREATE TABLE informeFotoDetecciones (hash VARCHAR, id INT, fecha TIMESTAMP, velocidad INT, placa TEXT, PRIMARY KEY (id,hash)) WITH CLUSTERING ORDER BY (hash ASC); */
                /*Query a ejecutar*/
                $q = "SELECT fecha, velocidad, placa 
                        FROM informefotodetecciones 
                        WHERE id = ${lugar};";

                /*Ejecuta el query */
                $statement = new Cassandra\SimpleStatement($q);
                $result    = $session->execute($statement);

                /*Ciclo que recupera los datos de la consulta */
                foreach($result as $row){
                        $fecha = $row['fecha'];
                        $f1 = date($fecha);
                        $f2 = date('Y/m/d', $f1/1000);	 
                ?>
                        <tr>
                                <td><?php echo $f2; ?></td>
                                <td><?php echo $row['velocidad'];?></td>
                                <td><?php echo $row['placa'];?></td>
                        </tr>
                <?php
                }
                ?>
                <?php
                /*Tiempo del proceso */
                $time_end = microtime(true); 
                $time = $time_end - $time_start; 
                ?>
                        <tr>
                                <td colspan="3" align="center"><b><h4>Tiempo del proceso: <?php echo $time; ?></h4></td>
                        </tr>
        </table>
</body>
</html>