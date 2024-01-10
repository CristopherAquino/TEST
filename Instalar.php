<?php
//DSN
$config = include 'configDB.php';
try {
  $conexion = new PDO('mysql:host=' . $config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);
  //Asignacion de variable de consulta y ejecucion
  $sql = file_get_contents("data/CreateDB.sql");
  
  $conexion->exec($sql);
  echo "La base de datos se ha creado con éxito.";
} catch(PDOException $error) {
  echo $error->getMessage();
}