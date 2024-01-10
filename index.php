<?php
include 'funciones.php';

$error = false;
$config = include 'configDB.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

  //Código que obtendrá la lista de alumnos
  $consultaSQL = "SELECT * FROM venta";
  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $mostrarventas = $sentencia->fetchAll();

} catch(PDOException $error) {
  $error = $error->getMessage();
}
?>

<?php 
//Agregado de plantillas
include "templates/header.php"; ?>

<?php
if ($error) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <a href="crear.php"  class="btn btn-primary mt-4">Añadir venta</a>
      <hr>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-3">Ventas</h2>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Articulos(s)</th>
            <th>Precio</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($mostrarventas && $sentencia->rowCount() > 0) {
            foreach ($mostrarventas as $fila) {
              ?>
              <tr>
                <td><?php echo escapar($fila["id"]); ?></td>
                <td><?php echo escapar($fila["articulo"]); ?></td>
                <td><?php echo escapar($fila["precio"]); ?></td>
              </tr>
              <?php
            }
          }
          ?>
        <tbody>
      </table>
    </div>
  </div>
</div>

<?php include "templates/footer.php"; ?>