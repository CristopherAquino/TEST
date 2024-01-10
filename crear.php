<?php
include 'funciones.php';

if (isset($_POST['submit'])) {
  $resultado = [
    'error' => false,
    'mensaje' => 'El/Los articulo(s) ' . escapar($_POST['articulo']) . ' ha(n) sido agregado con éxito' 
  ];
  $config = include 'configDB.php';

  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $venta = array(
      "articulo"   => $_POST['articulo'],
      "precio" => $_POST['precio'],
    );
    
    $consultaSQL = "INSERT INTO venta (articulo, precio)";
    $consultaSQL .= "values (:" . implode(", :", array_keys($venta)) . ")";
    
    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute($venta);

  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}
?>

<?php include "templates/header.php"; ?>

<?php
if (isset($resultado)) {
  ?>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
          <?= $resultado['mensaje'] ?>
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
      <h2 class="mt-4">Añadir venta</h2>
      <hr>
      <form method="post">
        <div class="form-group">
          <label for="articulo">Articulo(s)</label>
          <input type="text" name="articulo" id="articulo" class="form-control">
        </div>
        <div class="form-group">
          <label for="precio">Precio</label>
          <input type="number" name="precio" id="precio" class="form-control">
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
          <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include "templates/footer.php"; ?>

