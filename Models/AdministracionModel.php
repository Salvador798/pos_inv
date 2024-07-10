<?php

class AdministracionModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }

    public function getDatos(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table";
        $data = $this->select($sql);
        return $data;
    }

    public function modificar(string $nombre, string $telefono, string $dir, string $mensaje, int $id)
    {

        $sql = "UPDATE configuracion SET nombre = ?, telefono = ?, direccion = ?, mensaje = ?, id = ?";
        $datos = array($nombre, $telefono, $dir, $mensaje, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
}
