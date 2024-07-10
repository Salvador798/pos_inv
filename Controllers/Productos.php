<?php

class Productos extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['active'])) {
            header("location: " . APP_URL);
        }
        parent::__construct();
    }
    public function index()
    {
        $data['marcas'] = $this->model->getMarcas();
        $data['categorias'] = $this->model->getCategorias();
        $this->views->getView($this, "index", $data);
    }
    public function listar()
    {
        $data = $this->model->getProductos();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="bagde-active">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="primary" type="button" onclick="btnEditarPro(' . $data[$i]['id'] . ');"><span type="button" class="primary material-symbols-outlined">edit</span></button>
                <button class="warning" type="button" onclick="btnEliminarPro(' . $data[$i]['id'] . ');"><span type="button" class="delete material-symbols-outlined">lock</span></button>
                </div>';
            } else {
                $data[$i]['estado'] = '<span class="bagde-inactive">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="warning" type="button" onclick="btnIngresarPro(' . $data[$i]['id'] . ');"><span class="success material-symbols-outlined">lock_open</span></button>
                </div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $precio_compra = $_POST['precio_compra'];
        $precio_venta = $_POST['precio_venta'];
        $marca = $_POST['marca'];
        $categoria = $_POST['categoria'];
        $id = $_POST['id'];
        if (empty($codigo) || empty($nombre) || empty($precio_compra) || empty($precio_venta)) {
            $msg = array("msg" => "Todos los campos son obligatorios", "icono" => "warning");
        } else {
            if ($id == "") {
                $data = $this->model->registrarProducto($codigo, $nombre, $precio_compra, $precio_venta, $marca, $categoria);
                if ($data == "ok") {
                    $msg = array("msg" => "Producto registrado", "icono" => "success");
                } else if ($data == "existe") {
                    $msg = array("msg" => "El Producto ya está registrado", "icono" => "warning");
                } else {
                    $msg = array("msg" => "Error al registrar", "icono" => "error");
                }
            } else {
                $data = $this->model->modificarProducto($codigo, $nombre, $precio_compra, $precio_venta, $marca, $categoria, $id);
                if ($data == "modificado") {
                    $msg = array("msg" => "Producto modificado", "icono" => "success");
                } else {
                    $msg = array("msg" => "Error al modificar", "icono" => "error");
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id)
    {
        $data = $this->model->editarPro($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionPro(0, $id);
        if ($data == 1) {
            $msg = array("msg" => "Producto desactivado", "icono" => "success");
        } else {
            $msg = array("msg" => "Error al desactivar", "icono" => "error");
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionPro(1, $id);
        if ($data == 1) {
            $msg = array("msg" => "Producto activado", "icono" => "success");
        } else {
            $msg = array("msg" => "Error al activar", "icono" => "warning");
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
