<?php
require_once '../Surface/user/usuario.php';
require_once '../Surface/database/fileHandler/registroContext.php';
require_once '../Surface/logica/metodos.php';
require_once '../Surface/logica/Rdatabase.php';
require_once '../Surface/publicaciones/Pdatabase.php';
require_once '../Surface/publicaciones/pensamiento.php';

$pensamiento = new pensamiento();
$service = new Pdatabase("./database");
$isContaintId= isset($_GET['eliminarId']);

if($isContaintId){
    $Id=$_GET['eliminarId'];
    $service->Delete($Id);
   }

header("Location:surPage.php");
exit();

?>
