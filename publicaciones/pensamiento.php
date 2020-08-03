<?php 
    class pensamiento{
        public $id;
        public $idUsuario;
        public $titulo;
        public $pensamiento;
        public $hora;

        public function initialize($idUsuario,$titulo,$pensamiento,$hora){
           
            $this->idUsuario = $idUsuario;
            $this->titulo = $titulo;
            $this->pensamiento = $pensamiento;
            $this->hora = $hora;
    
        }
        public function set($data){
            foreach($data as $key => $value) $this->{$key} = $value;
        }
    }

?>