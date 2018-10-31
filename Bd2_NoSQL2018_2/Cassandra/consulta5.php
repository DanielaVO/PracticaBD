<?php
$URL_HOME = 'http://localhost:9090/Bd2_NoSQL2018_2/';
    
/*  Aqui ustede debe hacer la conexion a la base de datos*/
$cluster   = Cassandra::cluster()
     ->withContactPoints('127.0.0.1')
     ->build();
$session   = $cluster->connect("fotodetecciones");

/*Se recuperan los argumentos*/
$placa = htmlspecialchars($_GET["placa"]);
         
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
      <table table width="70%" border="1px" align="center">
            <tr align="center">
            <td colspan="2"><h4><font color="Orange">Q5- Dada una placa consultar el numero de 
            foto detecciones que posee y el lugar donde fue capturada.</font></h4></td>
            </tr>
            <tr>
                  <td align="center"><b>Lugar</td>
                  <td align="center"><b>Número fotodetecciones</td>		
            </tr>
            
            <?php
            $time_start = microtime(true); // Tiempo Inicial Proceso
            /*Query a ejecutar*/
            $q = "SELECT nombre, vehiculos_placa1 
                  FROM numInfracciones_by_placa 
                  WHERE vehiculos_placa= '${placa}';";
                  
            $statement = new Cassandra\SimpleStatement($q);
            $result    = $session->execute($statement);

            /*Ciclo que recupera los datos de la consulta */
            foreach($result as $row){
            ?>
                  <tr>
                        <td><?php echo $row['nombre'];?></td>
                        <td><?php echo $row['vehiculos_placa1'];?></td>
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