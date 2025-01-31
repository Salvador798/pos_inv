<?php
class EntradasModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRepCod(string $cod)
    {
        $sql = "SELECT 
                    r.*,
                    t.id AS tasa,
                    t.precio_dolar AS precio_dolar,
                    ROUND(r.precio_venta * t.precio_dolar, 2) AS precio_venta_dolar
                FROM repuestos r 
                INNER JOIN tasa t ON r.id_tasa = t.id
                WHERE codigo = '$cod' AND estado = 1";
        $data = $this->select($sql);
        return $data;
    }

    public function getProveedor()
    {
        $sql = "SELECT * FROM proveedores WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getRepuestos(int $id)
    {
        $sql = "SELECT * FROM repuestos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function registrarDetalle(string $table, int $id_repuesto, int $id_usuario, string $precio, int $cantidad, string $sub_total)
    {
        $sql = "INSERT INTO $table (id_repuesto, id_usuario, precio, cantidad, sub_total) VALUE (?,?,?,?,?)";
        $datos = array($id_repuesto, $id_usuario, $precio, $cantidad, $sub_total);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getDetalle(string $table, int $id)
    {
        $sql = "SELECT 
                    d.*, 
                    r.id AS id_rep, 
                    r.codigo, 
                    r.nombre,
                    t.id AS id_tasa,
                    t.precio_dolar AS precio_dolar
                FROM $table d 
                INNER JOIN repuestos r ON d.id_repuesto = r.id
                INNER JOIN tasa t ON r.id_tasa = t.id
                WHERE d.id_usuario = $id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function calcularEntrada(string $table, int $id_usuario)
    {
        $sql = "SELECT 
    d.*, 
    r.id AS id_rep, 
    r.codigo, 
    r.nombre,
    t.id AS id_tasa,
    t.precio_dolar AS precio_dolar,
    COALESCE(SUM(sub_total * precio_dolar), 0.00) AS total,
    COALESCE(SUM(sub_total), 0.00) AS total_sub_total  -- New sum for sub_total
FROM 
    $table d 
INNER JOIN 
    repuestos r ON d.id_repuesto = r.id
INNER JOIN 
    tasa t ON r.id_tasa = t.id
WHERE 
    d.id_usuario = $id_usuario
";
        $data = $this->select($sql);
        return $data;
    }

    public function deleteDetalle(string $table, int $id)
    {
        $sql = "DELETE FROM $table WHERE id = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $data;
    }

    public function consultarDetalle(string $table, int $id_repuesto, int $id_usuario)
    {
        $sql = "SELECT * FROM $table WHERE id_repuesto = $id_repuesto AND id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }

    public function consultarDetalle2(string $table, int $id_usuario)
    {
        $sql = "SELECT * FROM $table WHERE id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }

    public function actualizarDetalle(string $table, string $precio, int $cantidad, string $sub_total, int $id_repuesto, int $id_usuario)
    {
        $sql = "UPDATE $table SET precio = ?, cantidad = ?, sub_total = ? WHERE id_repuesto = ? AND id_usuario = ?";
        $datos = array($precio, $cantidad, $sub_total, $id_repuesto, $id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function registrarEntrada(int $id_proveedor, string $total)
    {
        $sql = "INSERT INTO entradas (id_proveedor, total) VALUES (?, ?)";
        $datos = array($id_proveedor, $total);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $lastId = $this->getLastInsertId();
            $res = ["status" => "ok", "id" => $lastId];
        } else {
            $res = ["status" => "error"];
        }
        return $res;
    }

    public function registrarSalida(string $total)
    {
        $sql = "INSERT INTO salidas (total) VALUES (?)";
        $datos = array($total);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $lastId = $this->getLastInsertId();
            $res = ["status" => "ok", "id" => $lastId];
        } else {
            $res = ["status" => "error"];
        }
        return $res;
    }

    public function getId(string $table)
    {
        $sql = "SELECT MAX(id) AS id FROM $table";
        $data = $this->select($sql);
        return $data;
    }

    public function registrarDetalleEntrada(int $id_entrada, int $id_rep, int $cantidad, string $precio, string $sub_total)
    {
        $sql = "INSERT INTO detalle_entradas (id_entrada, id_repuesto, cantidad, precio, sub_total) VALUES (?,?,?,?,?)";
        $datos = array($id_entrada, $id_rep, $cantidad, $precio, $sub_total);
        $data = $this->save($sql, $datos);

        $sql2 = "UPDATE repuestos SET precio_compra = ? WHERE id = ?";
        $datos2 = array($precio, $id_rep);
        $data2 = $this->save($sql2, $datos2);
        if ($data == 1 && $data2 == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function registrarDetalleSalida(int $id_salida, int $id_rep, int $cantidad, string $precio, string $sub_total)
    {
        $sql = "INSERT INTO detalle_salidas (id_salida, id_repuesto, cantidad, precio, sub_total) VALUES (?,?,?,?,?)";
        $datos = array($id_salida, $id_rep, $cantidad, $precio, $sub_total);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }

    public function vaciarDetalle(string $table, int $id_usuario)
    {
        $sql = "DELETE FROM $table WHERE id_usuario = ?";
        $datos = array($id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getRepEntrada(int $id_entrada)
    {
        $sql = "SELECT c.*, d.*, r.id, r.nombre FROM entradas c INNER JOIN detalle_entradas d ON c.id = d.id_entrada INNER JOIN repuestos r ON r.id = d.id_repuesto WHERE c.id = $id_entrada;";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getRepSalida(int $id_salida)
    {
        $sql = "SELECT c.*, d.*, r.id, r.nombre, t.id, t.precio_dolar 
FROM salidas c 
INNER JOIN detalle_salidas d ON c.id = d.id_salida 
INNER JOIN repuestos r ON r.id = d.id_repuesto 
INNER JOIN tasa t ON r.id_tasa = t.id 
WHERE c.id = $id_salida";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getHistorialEntradas()
    {
        $sql = "SELECT p.id, p.nombre, e.* FROM proveedores p INNER JOIN entradas e ON e.id_proveedor = p.id";
        // $sql = "SELECT * FROM entradas";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getHistorialEntradas_g()
    {
        $sql = "SELECT de.id_entrada AS ref, r.nombre AS repuesto, m.nombre AS marca, c.nombre AS categoria, de.precio, de.cantidad, de.sub_total, e.fecha AS fecha_entrada, p.nombre AS proveedor FROM detalle_entradas de INNER JOIN repuestos r ON de.id_repuesto = r.id INNER JOIN marcas m ON r.id_marca = m.id INNER JOIN categorias c ON r.id_categoria = c.id INNER JOIN entradas e ON de.id_entrada = e.id INNER JOIN proveedores p ON e.id_proveedor = p.id;";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getHistorialSalida()
    {
        $sql = "SELECT * FROM salidas";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getHistorialSalida_g()
    {
        $sql = "SELECT 
    da.id_salida AS ref, 
    r.nombre AS repuesto, 
    m.nombre AS marca, 
    c.nombre AS categoria, 
    da.precio, 
    da.cantidad, 
    da.sub_total, 
    a.fecha, 
    (r.precio_venta * t.precio_dolar) AS precio_venta_dolar,
    (da.sub_total * t.precio_dolar) AS sub_total_dolar
FROM 
    detalle_salidas da 
INNER JOIN 
    repuestos r ON da.id_repuesto = r.id 
INNER JOIN 
    marcas m ON r.id_marca = m.id 
INNER JOIN 
    categorias c ON r.id_categoria = c.id 
INNER JOIN 
    salidas a ON da.id_salida = a.id 
INNER JOIN 
    tasa t ON r.id_tasa = t.id;  -- Asegúrate de que la relación sea correcta

";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function actualizarStock(int $cantidad, int $id_rep)
    {
        $sql = "UPDATE repuestos SET cantidad = ? WHERE id = ?";
        $datos = array($cantidad, $id_rep);
        $data = $this->save($sql, $datos);
        return $data;
    }
}
