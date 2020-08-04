<?php

class metodos
{

    public function activarUsuario()
    {
            
        $service = new Rdatabase("./database");
        if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["correo"]) && !empty($_POST["usuario"]) && !empty($_POST["contrasena"])) { //Verificamos que todos los elementos esten
            
            $usuarioStatus="Activado";
            $to = $_POST["correo"];
            $subject = "Activa tu cuenta de surface";
            $message = "Su cuenta ha sido activada ";
       
            $usuario = new usuario();

            $usuario->InicializeData(0, $_POST["nombre"], $_POST["apellido"], $_POST["correo"], $_POST["usuario"], $_FILES["foto"], $_POST["contrasena"],$usuarioStatus);
            
            if (filter_var($to,FILTER_VALIDATE_EMAIL)) {
                $service->Add($usuario);
                mail($to,$subject,$message);
            header("location:/surface/index.php");
            }
            else{
                echo "Email incorrecto intenta de nuevo";
            }
            
        }
    }



    public function ultimaPosicion($lista)
    {
        $cuentaElementos = count($lista); //Haces una lista que cuente todos los elementos
        $ultimaPosicion = $lista[$cuentaElementos - 1]; //A ese ultimo elemento le restas uno ya que los arrays comienzan en [0]
        return $ultimaPosicion; //retornas el resultado

    }
    public function GetCookieTime()
    {
        return time() + 60 * 60 * 24 * 30;
    }
    //Analizar esto 

    //Para obtener la ultima posicion en un array


    //GetIndexElement
    public function delete($lista, $propiedad, $valor)
    {

        $index = 0;
        foreach ($lista as $key  => $elemento) {
            if ($elemento->$propiedad == $valor) {
                $index = $key;
            }
        }
        return $index;
    }
    //searchProperty
    public function edit($array, $atributo, $value)
    {

        $edit = [];
        foreach ($array as $objeto) {
            if ($objeto->$atributo == $value) {
                array_push($edit, $objeto);
            }
        }
        return $edit;
    }
    public function uploadImage($directory, $nombre, $tmpFile, $type, $size)
    {
        $isSucces = false;
        if (($type == "image/gif")
            || ($type == "image/jpeg")
            || ($type == "image/png")
            || ($type == "image/jpg")
            || ($type == "image/JPG")
            || ($type == "image/pjpeg") && ($size < 1000000)
        ) {
            if (!file_exists($directory)) {

                mkdir($directory, 0777, true);
                if (file_exists($directory)) {
                    if (file_exists($nombre)) {
                        unlink($nombre);
                    }
                    $this->uploadFile($directory, $nombre, $tmpFile);
                    $isSucces = true;
                }
            } else {
                if (file_exists($nombre)) {
                    unlink($nombre);
                }
                move_uploaded_file($tmpFile, $nombre);
                $isSucces = true;
            }
        } else {
            $isSucces = false;
        }
        return $isSucces;
    }
    private function uploadFile($nombre, $tmpFile)
    {
        if (file_exists($nombre)) {
            unlink($nombre);
        }
        move_uploaded_file($tmpFile, $nombre);
    }
}
