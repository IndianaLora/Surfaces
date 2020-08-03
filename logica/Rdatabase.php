<?php
require_once '../Surface/database/fileHandler/registroContext.php';
require_once '../Surface/logica/metodos.php';
require_once '../Surface/logica/Iregistro.php';

class Rdatabase implements Iregistro
{
    private $metodos;
    private $context;
   
    public function __construct($directory)
    {
        
      $this->metodos = new Metodos();
      $this->context = new registroContext($directory);
        
    }
    public function GetList()
    {
        $List= array();
        
        $stmt = $this->context->db->prepare("Select * from Registro");
        $stmt->execute();
        $result= $stmt->get_result();

        if($result->num_rows === 0){
            return $List;

        }else{
            while($row = $result->fetch_object()){
              $usuario = new usuario();

              $usuario->id  = $row->id;
              $usuario->nombre  = $row->nombre;
              $usuario->apellido  = $row->apellido;
              $usuario->correo  = $row->correo;
              $usuario->usuario  = $row->usuario;
              $usuario->foto  = $row->foto;
              $usuario->contrasena  = $row->contrasena;
              array_push($List,$usuario);
              
            }
        }
        $stmt->close();
        return $List;
    }
    public function GetbyId($id)
    {
        $usuario = new usuario();
        $stmt = $this->context->db->prepare("Select * from Registro where id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        
        $result= $stmt->get_result();

        if($result->num_rows === 0){
            return null;

        }else{
            while($row = $result->fetch_object()){
             

                $usuario->id  = $row->id;
                $usuario->nombre  = $row->nombre;
                $usuario->apellido  = $row->apellido;
                $usuario->correo  = $row->correo;
                $usuario->usuario  = $row->usuario;
                $usuario->foto  = $row->foto;
                $usuario->contrasena  = $row->contrasena;

            }
        }
        $stmt->close();
        return $usuario;
    }
    
    public function Add($entity)
    {
        
        $stmt = $this->context->db->prepare("insert into Registro(nombre,apellido,correo,usuario,foto,contrasena) Values(?,?,?,?,?,?)");
        $stmt->bind_param("ssssss",$entity->nombre,$entity->apellido,$entity->correo,$entity->usuario,$entity->foto,$entity->contrasena);//nombre tipo region
        $stmt->execute();
        $stmt->close();
        //para retornar ultimo id
        $id=$this->context->db->insert_id;
       
        $photoFile = $_FILES['foto'];
        if (isset($photoFile)) {


            if ($photoFile['error'] == 4) {
                $entity->foto = "";
            } else {
                $typeReplace = str_replace("image/","", $photoFile['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $nombre = "./img/usuario/" . $id . '.' . $typeReplace;
                $tmpname = $photoFile['tmp_name'];

                $succes = $this->metodos->uploadImage('./img/usuario/', $nombre, $tmpname, $type, $size);

                if ($succes) {
                    $stmt = $this->context->db->prepare("Update Registro set foto =? where id =?");
                    $stmt->bind_param("si",$nombre,$id);//nombre tipo region
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
        
    }
    public function Update($id,$entity)
    
    {
          $element=$this->GetbyId($id);

        $stmt = $this->context->db->prepare("Update Registro set nombre=?,region=?,tipo=?,Stipo=?,color=? where id = ?");
        $stmt->bind_param("sssssi",$entity->nombre,$entity->apellido,$entity->correo,$entity->usuario,$entity->foto,$entity->contrasena,$id);
        $stmt->execute();
        $stmt->close();

        if (isset($_FILES['pokeFoto'])) {

            $photoFile = $_FILES['pokeFoto'];
            if ($photoFile['error'] == 4) {
                $entity->pokeFoto = $element->pokeFoto;
            }

            $typeReplace = str_replace("image/", "",$photoFile['type']);
            $type = $photoFile['type'];
            $size = $photoFile['size'];
            $nombre = "./img/usuario/" .$id . '.' . $typeReplace;
            $tmpname = $photoFile['tmp_name'];

            $succes = $this->pokeMetodos->uploadImage('./img/usuario/', $nombre, $tmpname, $type, $size);

            if ($succes) {
                $stmt = $this->context->db->prepare("Update Registro set pokeFoto =? where id =?");
                $stmt->bind_param("si",$nombre,$id);//nombre tipo region
                $stmt->execute();
                $stmt->close();
            }
        }
    }
    public function Delete($id)
    {
        $stmt = $this->context->db->prepare("Delete from Registro where id =?");
                $stmt->bind_param("i",$id);//nombre tipo region
                $stmt->execute();
                $stmt->close();
        
        
    }
    
}
?>
