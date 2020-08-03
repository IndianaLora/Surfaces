<?php
require_once '../Surface/logica/metodos.php';
class usuario
{
public $id;
public $nombre;
public $apellido;
public $correo;
public $usuario;
public $foto;
public $contrasena;
public $pensamiento;

private $metodos;

public function __construct()
{
    $this->metodos = new metodos();
   
}
public function InicializeData($id,$nombre,$apellido,$correo,$usuario,$foto,$contrasena)
{
    $this->id=$id;
    $this->nombre=$nombre;
    $this->apellido=$apellido;
    $this->correo=$correo;
    $this->usuario=$usuario;
    $this->foto=$foto;
    $this->contrasena=$contrasena;
}

public function set($data)
{
    foreach ($data as $key => $value) $this->{$key} = $value;
}
}

?>