<?php

class Categorias extends Controller
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
        $this->views->getView($this, "index");
    }

    public function listar()
    {
        $data = $this->model->getCategorias();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="bagde-active">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="primary" type="button" onclick="btnEditarCat(' . $data[$i]['id'] . ');"><span type="button" class="primary material-symbols-outlined">edit</span></button>
                <button class="warning" type="button" onclick="btnEliminarCat(' . $data[$i]['id'] . ');"><span type="button" class="delete material-symbols-outlined">lock</span></button>
                </div>';
            } else {
                $data[$i]['estado'] = '<span class="bagde-inactive">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="warning" type="button" onclick="btnIngresarCat(' . $data[$i]['id'] . ');"><span class="success material-symbols-outlined">lock_open</span></button>
                </div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $nombre = $_POST['nombre'];
        $id = $_POST['id'];
        if (empty($nombre)) {
            $msg = array("msg" => "El campo Nombre es obligatorio", "icono" => "warning");
        } else {
            if ($id == "") {
                $data = $this->model->registrarCategoria($nombre);
                if ($data == "ok") {
                    $msg = array("msg" => "Categoria registrada", "icono" => "success");
                } else if ($data == "existe") {
                    $msg = array("msg" => "La Categoria ya está registrada", "icono" => "warning");
                } else {
                    $msg = array("msg" => "Error al registrar", "icono" => "error");
                }
            } else {
                $data = $this->model->modificarCategoria($nombre, $id);
                if ($data == "modificado") {
                    $msg = array("msg" => "Categoria modificada", "icono" => "success");
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
        $data = $this->model->editarCat($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionCat(0, $id);
        if ($data == 1) {
            $msg = array("msg" => "Categoria desactivada", "icono" => "success");
        } else {
            $msg = array("msg" => "Error al desactivar", "icono" => "error");
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionCat(1, $id);
        if ($data == 1) {
            $msg = array("msg" => "Categoria activada", "icono" => "success");
        } else {
            $msg = array("msg" => "Error al activar", "icono" => "error");
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
