<?php

class Usuarios extends Controller
{
    public function __construct()
    {
        session_start();
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
        $segments = explode('/', trim(parse_url($url, PHP_URL_PATH), '/'));
        
        if(empty($segments[2]) || $segments[2]!="validar") {
            if (empty($_SESSION['active'])) {
                header("location: " . APP_URL);
            }
        }

        parent::__construct();
    }
    
    public function index()
    {
        $this->views->getView("Usuarios", $this, "index");
    }
    public function listar()
    {
        $data = $this->model->getUsuarios();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="bagde-active">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="primary" type="button" title="Actualizar" onclick="btnEditarUser(' . $data[$i]['id'] . ');"><span type="button" class="primary material-symbols-outlined">edit</span></button>
                <button class="warning" type="button" title="Desactivar" onclick="btnEliminarUser(' . $data[$i]['id'] . ');"><span type="button" class="warning material-symbols-outlined">lock</span></button>
                </div>';
            } else {
                $data[$i]['estado'] = '<span class="bagde-inactive">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="success" type="button" title="Activar" onclick="btnIngresarUser(' . $data[$i]['id'] . ');"><span class="success material-symbols-outlined">lock_open</span></button>
                </div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function validar()
    {
        if (empty($_POST['usuario'])) {
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
                $_SESSION['apellido'] = $data['apellido'];
                $_SESSION['rol'] = $data['rol'];
                $_SESSION['active'] = true;
                $this->model->saveBitacora($_SESSION['id_usuario'], '7', '4', $_SESSION['id_usuario']);
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
        $ci = $_POST["ci"];
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $clave = $_POST['clave'];
        $confirmar = $_POST['confirmar'];
        $rol = $_POST['rol'];
        $id = $_POST['id'];
        $hash = hash("SHA256", $clave);
        // ID del usuario actual, obtenido de la sesión
        $id_usuario_actual = $_SESSION['id_usuario'];

        if (empty($ci || $usuario) || empty($nombre || $apellido)) {
            $msg = array('msg' => 'Todos los campos son obligatorios', 'icono' => 'warning');
        } else {
            if ($id == "") {
                // Registro de nuevo usuario
                if (strlen($clave) < 8) {
                    $msg = array('msg' => 'La Contraseña tiene que tener mínimo 8 dígitos', 'icono' => 'warning');
                } else if ($clave != $confirmar) {
                    $msg = array('msg' => 'Las Contraseñas no coinciden', 'icono' => 'warning');
                } else {
                    $data = $this->model->registrarUsuario($ci, $usuario, $nombre, $apellido, $hash, $rol);
                    if ($data['status'] == "ok") {
                        // Registrar en bitácora con el ID generado como detalle
                        $detalle = $data['id'];
                        $this->model->saveBitacora($id_usuario_actual, '6', '0', $detalle);
                        $msg = array('msg' => 'Usuario Registrado', 'icono' => 'success');
                    } else if ($data['status'] == "existe") {
                        $msg = array('msg' => 'El Usuario ya está registrado', 'icono' => 'warning');
                    } else {
                        $msg = array('msg' => 'Error al registrar el Usuario', 'icono' => 'error');
                    }
                }
            } else {
                // Modificación de un usuario existente
                $data = $this->model->modificarUsuario($ci, $usuario, $nombre, $apellido, $rol, $id);
                if ($data == "modificado") {
                    // Registrar en bitácora
                    $this->model->saveBitacora($id_usuario_actual, '6', '1', $id); // Módulo 6 (Usuarios), Acción 1 (Modificar)
                    $msg = array('msg' => 'Usuario actualizado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al actualizar el Usuario', 'icono' => 'error');
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
            $this->model->saveBitacora($_SESSION['id_usuario'], '6', '3', $id);
            $msg = array('msg' => 'Usuario desactivado', 'icono' => 'success',);
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
            $this->model->saveBitacora($_SESSION['id_usuario'], '6', '2', $id);
            $msg = array('msg' => 'Usuario activado', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al activar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function salir()
    {
        $this->model->saveBitacora($_SESSION['id_usuario'], '7', '5', $_SESSION['id_usuario']);
        session_destroy();
        header("location: " . APP_URL);
    }

    public function generarPDF()
    {
        if ($_SESSION['rol']!="Administrador") {
            header("location: " . APP_URL);
            die();
        }

        ob_start();
        $json =  $_POST['tableData'];
        $tableData = json_decode($json, true);
        date_default_timezone_set('America/Caracas');
        $fechaHora = date("d/m/Y H:i A");

        require('Libraries/fpdf/fpdf.php');
        $pdf = new class('P', 'mm', 'letter') extends FPDF {
            function Footer()
            {
                $this->SetY(-15);
                $this->SetFont('Arial', 'I', 8);
                $this->Cell(0, 10, mb_convert_encoding("Página ", 'ISO-8859-1', 'UTF-8') . $this->PageNo() . ' de {nb}', 0, 0, 'C');
            }

            public function getProperties()
            {
                return [
                    'CurrentFont' => $this->CurrentFont,
                    'FontSize' => $this->FontSize,
                    'cMargin' => $this->cMargin,
                    'rMargin' => $this->rMargin,
                    'x' => $this->x,
                    'w' => $this->w
                ];
            }
        };
        
        $pdf->SetTitle(mb_convert_encoding('Listado de Usuarios ', 'ISO-8859-1', 'UTF-8').$fechaHora);        
        $this->pdfHeader($pdf, $fechaHora);

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(140, 10, mb_convert_encoding('LISTADO DE USUARIOS', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');

        $pdf->Ln(10);


        $headers = ['USUARIO', 'NOMBRE', 'APELLIDO', 'ROL'];
        $col_widths = [40, 50, 50, 31];
        $total_width = array_sum($col_widths);
        $margin_left = 20;
        $line_height = 7;
        $inner_line_height = 4;
        $font_table = [
            'header' => ['Arial', 'B', 12],  // Fuente para el encabezado
            'body'   => ['Arial', '', 10]    // Fuente para el cuerpo
        ];

        $pdf->SetX($margin_left);
        $this->pdfTableHeader($pdf, $col_widths, $headers, $font_table);
        $this->pdfTableBody($pdf, $font_table);

        foreach ($tableData as $row) {
            $pdf->SetX($margin_left);
            $row_height = $line_height * $this->NbLines($pdf, $total_width, implode(' ', $row), $inner_line_height);
            $this->CheckPageBreak($pdf, $row_height, $col_widths, $headers, $margin_left, $font_table);
            $this->MultiCellRow($pdf, $col_widths, [
                mb_convert_encoding($row['usuario'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['nombre'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['apellido'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['rol'], 'ISO-8859-1', 'UTF-8')
            ], $margin_left, $line_height, $inner_line_height);
        }

        // Enviar el PDF al navegador
        $pdf->Output('I', 'Listado_de_Usuarios '.$fechaHora.'.pdf');
    }

    public function bitacora()
    {
        $this->views->getView("Bitacora", $this, "bitacora");
    }

    public function listar_bitacora() {
        $modulos = [
            '0' => ['tabla' => 'repuestos', 'campo' => 'nombre', 'titulo' => 'REPUESTO', 'nombre_modulo' => 'REPUESTOS'],
            '1' => ['tabla' => 'entradas', 'campo' => 'id', 'titulo' => 'REF', 'nombre_modulo' => 'ENTRADAS'],
            '2' => ['tabla' => 'salidas', 'campo' => 'id', 'titulo' => 'REF', 'nombre_modulo' => 'SALIDAS'],
            '3' => ['tabla' => 'proveedores', 'campo' => 'nombre', 'titulo' => 'PROVEEDOR', 'nombre_modulo' => 'PROVEEDORES'],
            '4' => ['tabla' => 'marcas', 'campo' => 'nombre', 'titulo' => 'MARCA', 'nombre_modulo' => 'MARCAS'],
            '5' => ['tabla' => 'categorias', 'campo' => 'nombre', 'titulo' => 'CATEGORIA', 'nombre_modulo' => 'CATEGORIAS'],
            '6' => ['tabla' => 'usuarios', 'campo' => 'usuario', 'titulo' => 'USUARIO', 'nombre_modulo' => 'USUARIO'],
            '7' => ['nombre_modulo' => 'SISTEMA', 'titulo' => 'CIERRE DE SESIÓN'],
        ];
    
        $acciones = [
            '0' => 'REGISTRAR',
            '1' => 'MODIFICAR',
            '2' => 'ACTIVAR',
            '3' => 'DESACTIVAR',
            '4' => 'INICIAR SESIÓN',
            '5' => 'CERRAR SESION',
        ];
    
        $bitacoraCompleta = [];
    
        foreach ($modulos as $moduloId => $modulo) {
            $data = $this->model->getBitacora($moduloId, $modulo);
    
            // Formatear los datos obtenidos
            foreach ($data as &$reg) {
                $reg['accion'] = $acciones[$reg['accion']] ?? 'N/A';
                $reg['modulo'] = $modulo['nombre_modulo'] ?? 'N/A';
                
                if (isset($modulo['titulo']) && isset($reg['detalle'])) {
                    if ($reg['accion']=='INICIAR SESIÓN' || $reg['accion']=='CERRAR SESION') {
                        $reg['detalle']= "{$modulo['titulo']}";
                    } else{
                        $reg['detalle'] = "{$modulo['titulo']}: {$reg['detalle']}";
                    }
                } else {
                    $reg['detalle'] = "{$modulo['titulo']} No encontrado";
                }
            }
    
            // Combinar los resultados del módulo actual con el total
            $bitacoraCompleta = array_merge($bitacoraCompleta, $data);
        }
    
        // Retornar la bitácora completa
        echo json_encode($bitacoraCompleta, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function generarPDFBitacora()
    {
        if ($_SESSION['rol']!="Administrador") {
            header("location: " . APP_URL);
            die();
        }
        
        ob_start();
        $json =  $_POST['tableData'];
        $tableData = json_decode($json, true);
        date_default_timezone_set('America/Caracas');
        $fechaHora = date("d/m/Y H:i A");

        require('Libraries/fpdf/fpdf.php');
        $pdf = new class('P', 'mm', 'letter') extends FPDF {
            function Footer()
            {
                $this->SetY(-15);
                $this->SetFont('Arial', 'I', 8);
                $this->Cell(0, 10, mb_convert_encoding("Página ", 'ISO-8859-1', 'UTF-8') . $this->PageNo() . ' de {nb}', 0, 0, 'C');
            }

            public function getProperties()
            {
                return [
                    'CurrentFont' => $this->CurrentFont,
                    'FontSize' => $this->FontSize,
                    'cMargin' => $this->cMargin,
                    'rMargin' => $this->rMargin,
                    'x' => $this->x,
                    'w' => $this->w
                ];
            }
        };

        $pdf->SetTitle(mb_convert_encoding('Bitácora de Usuarios ', 'ISO-8859-1', 'UTF-8').$fechaHora);        
        $this->pdfHeader($pdf, $fechaHora);

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(140, 10, mb_convert_encoding('BITÁCORA DE USUARIO', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');

        $pdf->Ln(10);

        $headers = ['Usuario', 'Módulo', 'Acción', 'Afectado', 'Fecha'];
        $col_widths = [30, 30, 35, 50, 45];
        $total_width = array_sum($col_widths);
        $margin_left = 13;
        $line_height = 7;
        $inner_line_height = 4;
        $font_table = [
            'header' => ['Arial', 'B', 12],  // Fuente para el encabezado
            'body'   => ['Arial', '', 10]    // Fuente para el cuerpo
        ];

        $pdf->SetX($margin_left);
        $this->pdfTableHeader($pdf, $col_widths, $headers, $font_table);
        $this->pdfTableBody($pdf, $font_table);

        foreach ($tableData as $row) {
            $pdf->SetX($margin_left);
            $row_height = $line_height * $this->NbLines($pdf, $total_width, implode(' ', $row), $inner_line_height);
            $this->CheckPageBreak($pdf, $row_height, $col_widths, $headers, $margin_left, $font_table);
            $this->MultiCellRow($pdf, $col_widths, [
                mb_convert_encoding($row['usuario'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['modulo'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['accion'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['detalle'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['fecha'], 'ISO-8859-1', 'UTF-8')
            ], $margin_left, $line_height, $inner_line_height);
        }

        ob_end_clean();
        $pdf->Output('I', 'Bitacora_de_Usuarios ' . $fechaHora . '.pdf');
    }










}
