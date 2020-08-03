<?php

class Pdatabase implements Iregistro{
        
    private $metodos;
    private $context;

    public function __construct($directory)
    {
        $this->metodos = new Metodos();
       $this->context = new registroContext($directory);
    }

    function GetList()
    {
       $listpublicaciones = array();

       $stmt = $this->context->db->prepare("select * from publicaciones");
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return $listpublicaciones ;
        }else{
            while($row = $result->fetch_object()){
                    $publicaciones = new pensamiento();
                    
                    $publicaciones->idUsuario = $row->idUsuario;
                    $publicaciones->titulo = $row->titulo;
                    $publicaciones->pensamiento = $row->pensamiento;
                    $publicaciones->hora = $row->hora;
                    array_push($listpublicaciones,$publicaciones);
            }
        }
        $stmt->close();
        return $listpublicaciones;
    }

    function Add($entity)
    {
       
        $stmt = $this->context->db->prepare("insert into publicaciones (idUsuario,titulo,pensamiento,hora) Values (?,?,?,?)");
        $stmt->bind_param("isss",$entity->idUsuario,$entity->titulo,$entity->pensamiento,$entity->hora);
        $stmt->execute();
        $stmt->close();
        
    }

    function Delete($id)
    {
        $stmt = $this->context->db->prepare("Delete from publicaciones where id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
    }

    function GetbyId($id)
    {
        $publicaciones = new pensamiento();
        $stmt = $this->context->db->prepare("select * from publicaciones where id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return null;
        }else{
            while($row = $result->fetch_object()){

                $publicaciones->id = $row->id;
                $publicaciones->idUsuario = $row->idUsuario;
                $publicaciones->titulo = $row->titulo;
                $publicaciones->pensamiento = $row->pensamiento;
                $publicaciones->hora = $row->hora;
               
            }
        }
        $stmt->close();
        return $publicaciones;
    }
    
    function Update($id, $entity)
    {   
        //$element = $this->GetbyId($id);

        $stmt = $this->context->db->prepare("Update publicaciones set  idUsuario = ? ,titulo = ?,pensamiento = ?,hora = ? where id = ?");
        $stmt->bind_param("isssi",$entity->idUsuario,$entity->titulo,$entity->pensamiento,$entity->hora,$id);
        $stmt->execute();
        $stmt->close();
        
    }

 }
