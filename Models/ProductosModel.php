<?php
class ProductosModel extends Query
{
    private $codigo, $nombre, $precio_compra, $precio_venta, $id_marca, $id_categoria, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getMarcas()
    {
        $sql = "SELECT * FROM marcas WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProductos()
    {
        $sql = "SELECT p.*, m.id AS marca, m.nombre AS marca, c.id AS categoria, c.nombre AS categoria FROM productos p INNER JOIN marcas m ON p.id_marca = m.id INNER JOIN categorias c ON p.id_categoria = c.id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarProducto(string $codigo, string $nombre, string $precio_compra, string $precio_venta, int $id_marca, int $id_categoria)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio_compra = $precio_compra;
        $this->precio_venta = $precio_venta;
        $this->id_marca = $id_marca;
        $this->id_categoria = $id_categoria;
        $verificar = "SELECT * FROM productos WHERE codigo = '$this->codigo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO productos (codigo, nombre, precio_compra, precio_venta, id_marca, id_categoria) VALUES (?,?,?,?,?,?)";
            $datos = array($this->codigo, $this->nombre, $this->precio_compra, $this->precio_venta, $this->id_marca, $this->id_categoria);
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
    public function modificarProducto(string $codigo, string $nombre, string $precio_compra, string $precio_venta, int $id_marca, int $id_categoria, int $id)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio_compra = $precio_compra;
        $this->precio_venta = $precio_venta;
        $this->id_marca = $id_marca;
        $this->id_categoria = $id_categoria;
        $this->id = $id;
        $sql = "UPDATE productos SET codigo = ?, nombre = ?, precio_compra = ?, precio_venta = ?, id_marca = ?, id_categoria = ? WHERE id = ?";
        $datos = array($this->codigo, $this->nombre, $this->precio_compra, $this->precio_venta, $this->id_marca, $this->id_categoria, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarPro(int $id)
    {
        $sql = "SELECT * FROM productos WHERE id = '$id'";
        $data = $this->select($sql);
        return $data;
    }
    public function accionPro(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE productos SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}
