<?php
require_once '../Surface/database/fileHandler/registroContext.php';
require_once '../Surface/database/fileHandler/Ifile.php';
//que es una interface?
class Json implements Ifile
{

    public function __construct($directory,$fileName)
    {
        //para que se instancia las variables
        $this->directory = $directory;
        $this->filename = $fileName;
    }
    //public para que no tenga problemas con el scope
    public function ReadConfiguration()
    {
        //almacenamos la ruta de conexion para la base datos
       //declaramos donde esta almacenada esta conexion y el nombre del archivo que es un json
        $path= $this->directory."/".$this->filename .".json";

        if(file_exists($path)){
            $file = fopen($path,"r");
            $content=fread($file,filesize($path));
            fclose($file);
            return json_decode($content);
        }else{
            return false;
        }
    }
}
