<?php
require_once '../Surface/user/usuario.php';
require_once '../Surface/database/fileHandler/registroContext.php';
class uService
{
    private $context;
    private $db;

    public function __construct($directory)
    {
        $this->context = new registroContext($directory);
    }

    public function Login($usuario,$contrasena)
    {
      $stmt= $this->context->db->prepare("Select * from registro where usuario =? and contrasena=?");
      $stmt->bind_param("ss",$usuario,$contrasena);
      $stmt->execute();
      $result = $stmt->get_result();
    
      if($result->num_rows===0){
          return null;
      }else{
        
        $entity= $result->fetch_object();
        $usuario = new usuario();

        $usuario->id=$entity->id;
        $usuario->nombre=$entity->nombre;
        $usuario->apellido=$entity->apellido;
        $usuario->correo=$entity->correo;
        $usuario->usuario=$entity->usuario;
        $usuario->foto=$entity->foto;
        $usuario->contrasena=$entity->contrasena;
        $usuario->pensamiento=$entity->pensamiento;

        return $usuario;
      }
    }
}
    ?>