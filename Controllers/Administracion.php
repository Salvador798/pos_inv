<?php

class Administracion extends Controller
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
        $data = $this->model->getEmpresa();
        $this->views->getView($this, "index", $data);
    }

    public function home()
    {
        $data['usuarios'] = $this->model->getDatos('usuarios');
        $data['proveedores'] = $this->model->getDatos('proveedores');
        $data['productos'] = $this->model->getDatos('productos');
        $data['compras'] = $this->model->getDatos('compras');
        $data['ventas'] = $this->model->getDatos('ventas');
        $this->views->getView($this, "home", $data);
    }

    public function modificar()
    {
        $nombre = $_POST['nombre'];
        $tel = $_POST['telefono'];
        $dir = $_POST['direccion'];
        $mensaje = $_POST['mensaje'];
        $id = $_POST['id'];
        $data = $this->model->modificar($nombre, $tel, $dir, $mensaje, $id);
        if ($data == "ok") {
            $msg = "ok";
        } else {
            $msg = "error";
        }
        echo json_encode($data);
        die();
    }
}
