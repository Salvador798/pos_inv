<?php

class MaterialesModel extends Query
{
    private $codigo, $nombre, $precio, $cantidad, $marca, $id_categoria, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getMateriales()
    {
        $sql = "SELECT * FROM materiales";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarMaterial(string $codigo, string $nombre, string $precio, string $cantidad, string $marca, int $id_categoria)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->marca = $marca;
        $this->id_categoria = $id_categoria;
        $verificar = "SELECT * FROM materiales WHERE codigo = '$this->codigo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO materiales (codigo, nombre, precio, cantidad, marca, id_categoria) VALUES (?,?,?,?,?,?)";
            $datos = array($this->codigo, $this->nombre, $this->precio, $this->cantidad, $this->marca, $this->id_categoria);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }

        return $res;
    }

    public function modificarMaterial(string $codigo, string $nombre, string $precio, string $cantidad, string $marca, int $id_categoria, int $id)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->marca = $marca;
        $this->id_categoria = $id_categoria;
        $this->id = $id;
        $sql = "UPDATE materiales SET codigo =?, nombre = ?, precio = ?, cantidad = ?, marca = ?, id_categoria = ? WHERE id = ?";
        $datos = array($this->codigo, $this->nombre, $this->precio, $this->cantidad, $this->marca, $this->id_categoria, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function editarMat(int $id)
    {
        $sql = "SELECT * FROM materiales WHERE id = '$id'";
        $data = $this->select($sql);
        return $data;
    }

    public function accionMat(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE materiales SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}
