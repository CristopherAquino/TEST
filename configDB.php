<?php

//Parametros de conexion
return [
  'db' => [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => 'root',
    'name' => 'ventas',
    'options' => [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
  ]
];