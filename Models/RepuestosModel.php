<?php
class RepuestosModel extends Query
{
    private $codigo, $nombre, $precio_compra, $precio_venta, $c_minimo, $id_marca, $id_categoria, $id, $estado;
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
        $sql = "SELECT 
                    r.*, 
                    m.id AS id_marca, 
                    m.nombre AS marca, 
                    c.id AS id_categoria, 
                    c.nombre AS categoria,
                    t.id AS id_tasa,
                    t.precio_dolar AS precio_dolar,
                    r.precio_venta * t.precio_dolar AS precio_venta_dolar,
                    r.precio_compra * t.precio_dolar AS precio_compra_dolar
                FROM 
                    repuestos r
                INNER JOIN 
                    marcas m ON r.id_marca = m.id
                INNER JOIN 
                    categorias c ON r.id_categoria = c.id
                INNER JOIN 
                    tasa t ON r.id_tasa = t.id;";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getRepReposicion()
    {
        $sql = "SELECT r.id, r.codigo, r.nombre,r.cantidad, r.c_minimo, m.id AS id_marca, m.nombre AS marca, c.id AS id_categoria, c.nombre AS categoria FROM repuestos r INNER JOIN marcas m ON r.id_marca = m.id INNER JOIN categorias c ON r.id_categoria = c.id WHERE r.cantidad <= r.c_minimo AND r.estado=1;";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarRepuesto(string $codigo, string $nombre, string $precio_compra, string $precio_venta, int $c_minimo, int $id_marca, int $id_categoria)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio_compra = $precio_compra;
        $this->precio_venta = $precio_venta;
        $this->c_minimo = $c_minimo;
        $this->id_marca = $id_marca;
        $this->id_categoria = $id_categoria;
        $verificar = "SELECT * FROM repuestos WHERE codigo = '$this->codigo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO repuestos (codigo, nombre, precio_compra, precio_venta, c_minimo, id_marca, id_categoria) VALUES (?,?,?,?,?,?,?)";
            $datos = array($this->codigo, $this->nombre, $this->precio_compra, $this->precio_venta, $this->c_minimo, $this->id_marca, $this->id_categoria);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $lastId = $this->getLastInsertId();
                $res = ['status' => "ok", 'id' => $lastId];
            } else {
                $res = ['status' => "error"];
            }
        } else {
            $res = ['status' => "existe"];
        }

        return $res;
    }
    public function modificarRepuesto(string $codigo, string $nombre, string $precio_venta, int $c_minimo, int $id_marca, int $id_categoria, int $id)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio_venta = $precio_venta;
        $this->c_minimo = $c_minimo;
        $this->id_marca = $id_marca;
        $this->id_categoria = $id_categoria;
        $this->id = $id;
        $sql = "UPDATE repuestos SET codigo = ?, nombre = ?, precio_venta = ?, c_minimo = ?, id_marca = ?, id_categoria = ? WHERE id = ?";
        $datos = array($this->codigo, $this->nombre, $this->precio_venta, $this->c_minimo, $this->id_marca, $this->id_categoria, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarRep(int $id)
    {
        $sql = "SELECT * FROM repuestos WHERE id = '$id'";
        $data = $this->select($sql);
        return $data;
    }
    public function accionRep(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE repuestos SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function getNumbers($codBase)
    {
        $sql = "SELECT codigo FROM repuestos WHERE codigo LIKE '$codBase%' ORDER BY CAST(SUBSTRING(codigo, LENGTH('$codBase') + 1) AS UNSIGNED) DESC LIMIT 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getRepCod($id)
    {
        $sql = "SELECT id, codigo, nombre FROM repuestos WHERE id = '$id';";
        $data = $this->select($sql);
        return $data;
    }
}
