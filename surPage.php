<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>

<body class="pokelist">
  <?php
  //////////////////si reinicio la pagina se repite el ultimo array en la lista de arrays
  include('../Surface/boots/sheader.php');

  require_once '../Surface/database/fileHandler/registroContext.php';
  require_once '../Surface/logica/metodos.php';
  require_once '../Surface/logica/Rdatabase.php';
  require_once '../Surface/publicaciones/Pdatabase.php';
  require_once '../Surface/user/uService.php';
  require_once '../Surface/user/usuario.php';
  require_once '../Surface/publicaciones/pensamiento.php';

  session_start();
  $service = new uService("database");
  $services = new Pdatabase("../database");
  $listPublicaciones = $services->GetList();
  $pensamiento = new pensamiento();

  $idUsuario = $_SESSION['usuario']->id;
  $nombre = $_SESSION['usuario']->usuario;
  $apellido = $_SESSION['usuario']->apellido;
  $correo = $_SESSION['usuario']->correo;
  $foto = $_SESSION['usuario']->foto;
  $tiempo = "porfin";
  if (isset($_POST['titulo']) && isset($_POST['pensamiento'])) {
    $pensamiento->initialize($idUsuario, $_POST['titulo'], $_POST['pensamiento'], $tiempo);
    $services->Add($pensamiento);
    header('Location:surPage.php');
    exit();
  }
  ?>
  <!-- esto no funciona -->
  <?php if ($foto == "" || $foto == 'Array' || $foto == null) : ?>
    <img style="border: 5px solid grey;" src="<?php echo "../surface/img/usuario/default.jpg" ?>" width="160px" height="200px" aria-label="placeholder:Thumbnail">
  <?php else : ?>
    <img style="border: 5px solid grey;" src="<?php echo $foto; ?>" width="160px" height="200px" aria-label="placeholder:Thumbnail">
  <?php endif ?>
  <h4><?php echo $nombre; ?> <?php echo $apellido; ?></h4>
  <h5> <?php echo $correo; ?></h5>
  <form method="POST" action="surPage.php">

    <div class="form-group">
      Titulo <input name="titulo">
      <h2>Comparte lo que piensas<h2>
          <textarea class="form-control" name="pensamiento" rows="5"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Nueva publicacion</button>
    </table>

  </form>

  <br>
  <br>

  <nav class="navbar navbar-expand-lg navbar-dark " id="header">
    <a class="navbar-brand">Blog de publicaciones</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    </li>
    </ul>

  </nav>
  <!-- esto no funciona -->
  <?php if ($foto == "" || $foto == 'Array' || $foto == null) : ?>
    <img style="border: 5px solid grey;" src="<?php echo "../surface/img/usuario/default.jpg" ?>" width="160px" height="200px" aria-label="placeholder:Thumbnail">
  <?php else : ?>
    <img style="border: 5px solid grey;" src="<?php echo $foto; ?>" width="160px" height="200px" aria-label="placeholder:Thumbnail">
  <?php endif ?>
  <h4><?php echo $nombre; ?></h4>
  <?php foreach ($listPublicaciones as $value) : ?>
    <?php if ($value->idUsuario == $idUsuario) : ?>
      <div class="card-body">
        <h3 class="card-text"><?php echo $value->titulo; ?></h3>
        <p class="card-text"><?php echo $value->pensamiento; ?></p>

        <td><a href="editar.php?id=<?php echo $value->idUsuario; ?>" class="btn btn-info">editar</a></td>
        <td><a href="delete.php?eliminarId=<?php echo $value->idUsuario; ?>" class="btn btn-danger">Borrar</a></td>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>

  </div>
  </div>

</body>
<?php
include('../Surface/boots/footer.php');
?>

</html>
