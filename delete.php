<?php
require_once '../Surface/user/usuario.php';
require_once '../Surface/database/fileHandler/registroContext.php';
require_once '../Surface/logica/metodos.php';
require_once '../Surface/logica/Rdatabase.php';


$service = new Rdatabase("./database");
$isContaintId= isset($_GET['id']);

if($isContaintId){
    $Id=$_GET['id'];
    $service->Delete($Id);
   }

header("Location:surPage.php");
exit();

?>