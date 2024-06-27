<?php
class UsuariosModel extends Query{
    private $usuario, $nombre, $clave, $id_dominio, $id, $estado;
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
    public Function getDominios()
    {
        $sql = "SELECT * FROM dominio WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;


    }
    public Function getUsuarios()
    {
        $sql = "SELECT u.*, d.id as id_dominio, d.dominio FROM usuarios u INNER JOIN dominio d where u.id_dominio = d.id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public Function registrarUsuario(string $usuario, string $nombre, string $clave, int $id_dominio)
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->id_dominio = $id_dominio;
        $verificar = "SELECT * FROM usuarios WHERE usuario = '$this->usuario'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO usuarios(usuario, nombre, clave, id_dominio) VALUES (?,?,?,?)";
            $datos = array($this->usuario, $this->nombre, $this->clave, $this->id_dominio);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
            $res = "ok";
            }else {
            $res = "error";
            }
        }else {
            $res = "existe";
        }
        
        return $res;
    } 
    public Function modificarUsuario(string $usuario, string $nombre, int $id_dominio, int $id)
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->id = $id;
        $this->id_dominio = $id_dominio;
        $sql = "UPDATE usuarios SET usuario = ?, nombre = ?, id_dominio = ? WHERE id = ?";
        $datos = array($this->usuario, $this->nombre, $this->id_dominio, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
        $res = "modificado";
        }else {
              $res = "error";
        }
        return $res;
    } 
    public function editarUser(int $id) 
    {
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionUser(int $estado, int $id) 
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;

    }
    
}




?>

    





