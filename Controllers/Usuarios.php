<?php

class Usuarios extends Controller
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
        $data = $this->model->getUsuarios();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="bagde-active">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="primary" type="button" onclick="btnEditarUser(' . $data[$i]['id'] . ');"><span type="button" class="primary material-symbols-outlined">edit</span></button>
                <button class="warning" type="button" onclick="btnEliminarUser(' . $data[$i]['id'] . ');"><span type="button" class="warning material-symbols-outlined">lock</span></button>
                </div>';
            } else {
                $data[$i]['estado'] = '<span class="bagde-inactive">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="warning" type="button" onclick="btnIngresarUser(' . $data[$i]['id'] . ');"><span class="success material-symbols-outlined">lock_open</span></button>
                </div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function validar()
    {
        if (empty($_POST['usuario']) || empty('clave')) {
            $msg = "Los campos están vacios";
        } else {
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256", $clave);
            $data = $this->model->getUsuario($usuario, $hash);
            if ($data) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['active'] = true;
                $msg = "ok";
            } else {
                $msg = "Usuario o Contraseña incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $confirmar = $_POST['confirmar'];
        $id = $_POST['id'];
        $hash = hash("SHA256", $clave);
        if (empty($usuario) || empty($nombre)) {
            $msg = array('msg' => 'Todos los campos son obligatorios', 'icono' => 'warning');
        } else {
            if ($id == "") {
                if ($clave != $confirmar) {
                    $msg = array('msg' => 'Las Contraseñas no coinciden', 'icono' => 'warning');
                } else {
                    $data = $this->model->registrarUsuario($usuario, $nombre, $hash);
                    if ($data == "ok") {
                        $msg = array('msg' => 'Usuario Registrado', 'icono' => 'success');
                    } else if ($data == "existe") {
                        $msg = array('msg' => 'El Usuario ya está registrado', 'icono' => 'warning');
                    } else {
                        $msg = array('msg' => 'Error al registrar el Usuario', 'icono' => 'error');
                    }
                }
            } else {
                $data = $this->model->modificarUsuario($usuario, $nombre, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Usuario modificado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar el Usuario', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id)
    {
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionUser(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Usuario desactivado', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al desactivar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionUser(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Usuario activado', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al activar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function salir()
    {
        session_destroy();
        header("location: " . APP_URL);
    }
}
