<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>

<body>
  <?php
  include('../Surface/boots/header.php');
  require_once '../Surface/database/fileHandler/registroContext.php';
   require_once '../Surface/logica/metodos.php';
   require_once '../Surface/logica/Rdatabase.php';
   require_once '../Surface/user/usuario.php';
   
   
   $metodos = new metodos();
   
   if($_SERVER['REQUEST_METHOD']==='POST')
  {
    $metodos->getUsuario();
    
  }
  ?>
    <div id="container">
        <div class="formulario center" id="form">
          <h1>Registrate</h1>
          <div class="form-group">
            <!--Get Post redirect-->
            <form action="formulario.php" enctype="multipart/form-data" method="POST" name="formularios">
              <!--POST se utiliza para los form siempre -->
              </br>
              <table >
                <th><label for="">Nombre</label>
                  <input type="text" name="nombre" class="form-control" placeholder="nombre">
                  <tr>
                    <th><label for="">Apellido</label>
                      <input type="text" name="apellido" class="form-control" placeholder="apellido">
                  <tr>
                    <th><label for="">Correo</label>
                      <input type="text" name="correo" class="form-control" placeholder="correo">
                  <tr>
                  <tr>
                    <th><label for="">Nombre de Usuario</label>
                      <input type="text" name="usuario"class="form-control" placeholder="usuario">
                  <tr>
                  <tr>
                      <th><label for="">Foto de perfil</label>
                      <input type="file" class="form-control" name="foto" placeholder="foto">
                      <tr>
                  <tr>
                      <th><label for="">Contrasena</label>
                      <input type="text"  name="contrasena" class="form-control" placeholder="contrasena">
                      
                        
                      <button type="submit" name="submit"class="btn btn-success float-right"onclick="surPage.php">Guardar</button>
              
              </table>

            </form>
            
            </div>

          </div>
      
      </div>
    
</body>
<?php
include('../Surface/boots/footer.php');
?>

</html>