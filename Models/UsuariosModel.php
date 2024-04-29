<?php
class UsuariosModel extends Query{
    public function __construct()
    {
       parent::__construct();
    }
    public Function getUsuario(string $usuario, string $clave)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
        $data = $this->select($sql);
        return $data;


    }
    public Function getUsuarios()
    {
        $sql = "SELECT u.*, d.id, d.dominio FROM usuarios u INNER JOIN dominio d where u.id_dominio = d.id";
        $data = $this->selectAll($sql);
        return $data;


    }
        
    }




?>