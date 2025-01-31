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
        $data['configuracion'] = $this->model->getEmpresa('configuracion');
        $data['tasa'] = $this->model->getEmpresa('tasa');
        $this->views->getView("Configuración", $this, "index", $data);
    }

    public function home()
    {
        $data['usuarios'] = $this->model->getDatos('usuarios');
        $data['proveedores'] = $this->model->getDatos('proveedores');
        $data['repuestos'] = $this->model->getDatos('repuestos');
        // $data['compras'] = $this->model->getDatos('compras');
        // $data['ventas'] = $this->model->getDatos('ventas');
        $this->views->getView("Dashboard", $this, "home", $data);
    }

    public function modificar()
    {
        $rif = $_POST["rif"];
        $nombre = $_POST['nombre'];
        $tel = $_POST['telefono'];
        $dir = $_POST['direccion'];
        $id = $_POST['id'];
        $data = $this->model->modificar($rif, $nombre, $tel, $dir, $id);
        if ($data == "ok") {
            $msg = "ok";
        } else {
            $msg = "error";
        }
        echo json_encode($data);
        die();
    }

    public function getDolar()
    {
        $precio_dolar = $_POST['precio_dolar'];
        $id = $_POST['id'];

        $data = $this->model->tasaDolar($precio_dolar, $id);

        if ($data == "ok") {
            $msg = "ok";
        } else {
            $msg = "error";
        }

        echo json_encode($msg);
        die();
    }
}
