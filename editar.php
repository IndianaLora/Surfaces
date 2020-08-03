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
 
  $services = new Pdatabase("../database");
  $listPublicaciones = $services->GetList();
  $newPensamiento = new pensamiento();
 
  $idUsuario=$_SESSION['usuario']->id;
  $nombre = $_SESSION['usuario']->usuario;
  $foto = $_SESSION['usuario']->foto;
  $tiempo = "porfin";

  foreach ($listPublicaciones as $value) {
      if ($idUsuario == $value->idUsuario) {
          $titulo = $value->titulo;
          $pensamiento = $value->pensamiento;
          $idUsuario = $value->idUsuario;
      }


      if (isset($_POST['titulo']) && isset($_POST['pensamiento'])) {
          $newPensamiento->initialize($idUsuario,$_POST['titulo'], $_POST['pensamiento'],$tiempo);
          $services->Update($idUsuario, $newPensamiento);
          header('Location:surPage.php');
          exit();
      }
  }
  var_dump($newPensamiento);
  ?>
  
  <form method="POST" action="editar.php">
    
    <div class="form-group">
     Titulo <input name="titulo" value="<?php echo $value->titulo;?>">
      <h2>Comparte lo que piensas<h2>
          <textarea class="form-control" name="pensamiento" rows="5"><?php echo $value->pensamiento;?></textarea>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
    </table>

  </form>

  <br>
  <br>
 
    
  </div>
  </div>

</body>
<?php
include('../Surface/boots/footer.php');
?>

</html>
