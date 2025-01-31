<?php
class Query extends Conexion
{
    private $pdo, $con, $sql, $datos;
    public function __construct()
    {
        $this->pdo = new Conexion();
        $this->con = $this->pdo->conect();
    }
    public function select(string $sql, array $params = [])
    {
        $this->sql = $sql;
        $resul = $this->con->prepare($this->sql);
        if (!empty($params)) {
            $resul->execute($params); // Ejecuta la consulta con parámetros
        } else {
            $resul->execute(); // Si no hay parámetros, solo ejecuta la consulta
        }
            $data = $resul->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function selectAll(string $sql)
    {
        $this->sql = $sql;
        $resul = $this->con->prepare($this->sql);
        $resul->execute();
        $data = $resul->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function selectAllParameters(string $sql, array $params = [])
    {
        $this->sql = $sql;
        $resul = $this->con->prepare($this->sql);

        // Ejecutar la consulta con los parámetros proporcionados
        $resul->execute($params);

        // Obtener los resultados como un arreglo asociativo
        $data = $resul->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function save(string $sql, array $datos)
    {
        $this->sql = $sql;
        $this->datos = $datos;
        $insert = $this->con->prepare($this->sql);
        $data = $insert->execute($this->datos);
        if ($datos) {
            $res = 1;
        } else {
            $res = 0;
        }
        return $res;
    }
    public function getLastInsertId()
    {
        return $this->con->lastInsertId();
    }

    public function saveBitacora($id_usuario, $modulo, $accion, $detalle)
    {
        $sql = "INSERT INTO bitacora (id_usuario, modulo, accion, detalle, fecha) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)";
        $datos = array($id_usuario, $modulo, $accion, $detalle);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
    
        return $res;
    }

     /* public function selectAllF(string $sql, array $params = [])
    {
        $resul = $this->con->prepare($sql);

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $resul->bindValue($key, $value);
            }
        }

        // Ejecutar la consulta
        $resul->execute();

        // Obtener los resultados
        $data = $resul->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    } */
}
