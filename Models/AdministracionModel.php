<?php

class AdministracionModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getEmpresa(string $table)
    {
        $sql = "SELECT * FROM $table";
        $data = $this->select($sql);
        return $data;
    }

    public function getDatos(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table WHERE estado = 1";
        $data = $this->select($sql);
        return $data;
    }

    public function modificar(string $rif, string $nombre, string $telefono, string $dir, int $id)
    {
        $sql = "UPDATE configuracion SET rif = ?, nombre = ?, telefono = ?, direccion = ?, id = ?";
        $datos = array($rif, $nombre, $telefono, $dir, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function dolar()
    {
        $sql = "SELECT * FROM tasa";
        $data = $this->select($sql);
        return $data;
    }

    public function tasaDolar(string $precio_dolar, int $id)
    {
        $sql = "UPDATE tasa SET precio_dolar = ? WHERE id = ?";
        $datos = array($precio_dolar, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
}
