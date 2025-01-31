<?php
class UsuariosModel extends Query
{
    private $ci, $usuario, $nombre, $apellido, $clave, $rol, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario(string $usuario, string $clave)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
        $data = $this->select($sql);
        return $data;
    }
    public function getUsuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarUsuario(string $ci, string $usuario, string $nombre, string $apellido, string $clave, string $rol)
    {
        $this->ci = $ci;
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->clave = $clave;
        $this->rol = $rol;
        $verificar = "SELECT * FROM usuarios WHERE usuario = '$this->usuario'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO usuarios (ci, usuario, nombre, apellido, clave, rol) VALUES (?, ?, ?, ?, ?, ?)";
            $datos = array($this->ci, $this->usuario, $this->nombre, $this->apellido, $this->clave, $this->rol);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $lastId = $this->getLastInsertId();
                $res = ["status" => "ok", "id" => $lastId];
            } else {
                $res = ["status" => "error"];
            }
        } else {
            $res = ["status" => "existe"];
        }

        return $res;
    }

    public function modificarUsuario(string $ci, string $usuario, string $nombre, string $apellido, string $rol, int $id)
    {
        $this->ci = $ci;
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->rol = $rol;
        $this->id = $id;
        $sql = "UPDATE usuarios SET ci = ?, usuario = ?, nombre = ?, apellido = ?, rol = ? WHERE id = ?";
        $datos = array($this->ci, $this->usuario, $this->nombre, $this->apellido, $this->rol, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarUser(int $id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = '$id'";
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

    public function getBitacora($moduloId, $modulo)
    {
        $sql = "SELECT u.usuario, b.modulo, b.accion, ";
        if (isset($modulo['tabla']) && isset($modulo['campo']) && !empty($modulo['tabla']) && !empty($modulo['campo'])) {
            $sql .= "{$modulo['tabla']}.{$modulo['campo']} AS detalle, ";
            $sql .= "b.fecha FROM bitacora b ";
            $sql .= "INNER JOIN usuarios u ON u.id = b.id_usuario ";
            $sql .= "LEFT JOIN {$modulo['tabla']} ON b.detalle = {$modulo['tabla']}.id ";
        } else {
            $sql .= "b.detalle, b.fecha FROM bitacora b ";
            $sql .= "INNER JOIN usuarios u ON u.id = b.id_usuario ";
        }
        $sql .= "WHERE b.modulo = ?";
        return $this->selectAllParameters($sql, [$moduloId]);
    }
}
