<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <title>Surfaces</title>
</head>

<body>
    <?php
    include('../Surface/boots/header.php');
    require_once '../Surface/database/fileHandler/Ifile.php';
    require_once '../Surface/database/fileHandler/Json.php';
    require_once '../Surface/user/uService.php';
    require_once '../Surface/user/usuario.php';

    $result = null;
    $message = "";

    

    $service = new uService("database");

    if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {

        $result = $service->Login($_POST['usuario'], ($_POST['contrasena']));
        if ($result != null) {

            $_SESSION['usuario'] = $result;
            header("Location:../surface/surPage.php");
            exit();
        } else {
            $message = "Usuario o contrasena incorrecta";
        }
    }
    ?>
    <div class="container text-center">
        <h1 id="surface">Surface</h1>
    </div>
    <?php if($message !=""):?>
    <div class="alert alert-danger" role="alert">
        <?php echo $message?>
    </div>
    <?php endif;?>
    <div class="inicio-session">
        <form action="index.php" method="POST">
            <label >Usuario</label>
            <input class="form-control" placeholder="Introduzca su usuario" name="usuario">

            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" placeholder="Password" name="contrasena">
            <br>
            <div class="text-center">
                <a href="formulario.php" class="btn btn-default float-right btn-warning">Registrarse</a>
            </div>
            <div class="text-center">
            <button class="btn btn-default btn-success" type="submit">Iniciar seccion</button>
        </div>
        </form>
        
    </div>
</body>
<?php
include('../Surface/boots/footer.php');
?>

</html>