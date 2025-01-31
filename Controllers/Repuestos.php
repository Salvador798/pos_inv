<?php

class Repuestos extends Controller
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
        $this->views->getView("Repuestos", $this, "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getProductos();
        for ($i = 0; $i < count($data); $i++) {
            if ($_SESSION['rol'] <> 'Vendedor') {
                if ($data[$i]['estado'] == 1) {
                    $data[$i]['estado'] = '<span class="bagde-active">Activo</span>';
                    $data[$i]['acciones'] = '<div>
                    <button class="primary" type="button" title="Actualizar" onclick="btnEditarRep(' . $data[$i]['id'] . ');"><span type="button" class="primary material-symbols-outlined">edit</span></button>
                    <button class="warning" type="button" title="Desactivar" onclick="btnEliminarRep(' . $data[$i]['id'] . ');"><span type="button" class="delete material-symbols-outlined">lock</span></button>
                    </div>';
                } else {
                    $data[$i]['estado'] = '<span class="bagde-inactive">Inactivo</span>';
                    $data[$i]['acciones'] = '<div>
                    <button class="success" type="button" title="Activar" onclick="btnIngresarRep(' . $data[$i]['id'] . ');"><span class="success material-symbols-outlined">lock_open</span></button>
                    </div>';
                }
            } else {
                if ($data[$i]['estado'] == 1) {
                    $data[$i]['estado'] = '<span class="bagde-inactive">Activo</span>';
                } else {
                    $data[$i]['estado'] = '<span class="bagde-inactive">Inactivo</span>';
                }

                $data[$i]['acciones'] = '<div>
                    <span class="warning material-symbols-outlined">Edit_off</span>
                </div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reposicion()
    {
        $data = $this->model->getRepReposicion();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $precio_venta = $_POST['precio_venta'];
        $c_minimo = $_POST['stock_minimo'];
        $marca = $_POST['marca'];
        $categoria = $_POST['categoria'];
        $id = $_POST['id'];
        if (empty($codigo) || empty($nombre)) {
            $msg = array("msg" => "Todos los campos son obligatorios", "icono" => "warning");
        } else {
            if ($id == "") {
                $data = $this->model->registrarRepuesto($codigo, $nombre, '0', '0', $c_minimo, $marca, $categoria);
                if ($data['status'] == "ok") {
                    $this->model->saveBitacora($_SESSION['id_usuario'], '0', '0', $data['id']);
                    $msg = array("msg" => "Repuesto registrado", "icono" => "success");
                } else if ($data == "existe") {
                    $msg = array("msg" => "El Repuesto ya está registrado", "icono" => "warning");
                } else {
                    $msg = array("msg" => "Error al registrar", "icono" => "error");
                }
            } else {
                if (empty($precio_venta)) {
                    $msg = array("msg" => "Todos los campos son obligatorios", "icono" => "warning");
                } else {
                    $data = $this->model->modificarRepuesto($codigo, $nombre, $precio_venta, $c_minimo, $marca, $categoria, $id);
                    if ($data == "modificado") {
                        $this->model->saveBitacora($_SESSION['id_usuario'], '0', '1', $id);
                        $msg = array("msg" => "Repuesto actualizado", "icono" => "success");
                    } else {
                        $msg = array("msg" => "Error al actualizar", "icono" => "error");
                    }
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
        $data = $this->model->editarRep($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id)
    {
        $data = $this->model->accionRep(0, $id);
        if ($data == 1) {
            $this->model->saveBitacora($_SESSION['id_usuario'], '0', '3', $id);
            $msg = array("msg" => "Repuesto desactivado", "icono" => "success");
        } else {
            $msg = array("msg" => "Error al desactivar", "icono" => "error");
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id)
    {
        $data = $this->model->accionRep(1, $id);
        if ($data == 1) {
            $this->model->saveBitacora($_SESSION['id_usuario'], '0', '2', $id);
            $msg = array("msg" => "Repuesto activado", "icono" => "success");
        } else {
            $msg = array("msg" => "Error al activar", "icono" => "warning");
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function generarPDF()
    {
        ob_start();
        date_default_timezone_set('America/Caracas');
        $fechaHora = date("d/m/Y H:i A");

        $json =  $_POST['tableData'];
        $tableData = json_decode($json, true);

        /* require($_SERVER['DOCUMENT_ROOT'] . '/pos_inv/Libraries/fpdf/fpdf.php'); */
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

        $pdf->SetTitle(mb_convert_encoding('Listado de Repuestos ', 'ISO-8859-1', 'UTF-8') . $fechaHora);
        $this->pdfHeader($pdf, $fechaHora);

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(140, 10, mb_convert_encoding('LISTADO DE REPUESTOS', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        $pdf->Ln(10);

        $headers = ['CÓDIGO', 'NOMBRE', 'MARCA', 'CATEGORÍA', 'STOCK', 'PRECIO'];
        $col_widths = [20, 50, 30, 30, 18, 30];
        $margin_left = 20;
        $total_width = array_sum($col_widths);
        $line_height = 7;
        $inner_line_height = 4;
        $font_table = [
            'header' => ['Arial', 'B', 10],
            'body'   => ['Arial', '', 8]
        ];

        $pdf->SetX($margin_left);
        $this->pdfTableHeader($pdf, $col_widths, $headers, $font_table);
        $this->pdfTableBody($pdf, $font_table);

        foreach ($tableData as $row) {
            $pdf->SetX($margin_left);
            $row_height = $line_height * $this->NbLines($pdf, $total_width, implode(' ', $row), $inner_line_height);
            $this->CheckPageBreak($pdf, $row_height, $col_widths, $headers, $margin_left, $font_table);
            $this->MultiCellRow($pdf, $col_widths, [
                $row['codigo'],
                mb_convert_encoding($row['nombre'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['marca'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['categoria'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['cantidad'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['precio_venta'] . 'BS', 'ISO-8859-1', 'UTF-8')
            ], $margin_left, $line_height, $inner_line_height);
        }

        $this->pdfTableBody($pdf);

        foreach ($tableData as $row) {
            $this->MultiCellRow($pdf, $col_widths, [], $margin_left, $line_height, $inner_line_height);
        }

        ob_end_clean();
        $pdf->Output('I', 'Listado de Repuestos  ' . $fechaHora . '.pdf');
    }



    public function buscarCod()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $codigoBase = $data['codigoBase'];

        if (isset($data['idRep']) && $data['idRep'] != '') {
            $repuesto = $this->model->getRepCod($data['idRep']);
            $prefijo = substr($repuesto['codigo'], 0, strlen($codigoBase));
            if ($prefijo == $codigoBase) {
                $numero = (int)substr($repuesto['codigo'], strlen($codigoBase));
                $sigNum = str_pad($numero, 2, '0', STR_PAD_LEFT);
            } else {
                $data = $this->model->getNumbers($codigoBase);
                if (empty($data)) {
                    $sigNum = '01';
                } else {
                    $codigo = $data[0]['codigo'];
                    $prefijo = substr($codigo, 0, strlen($codigoBase));

                    if (isset($data['codNumero']) && strcmp($prefijo, $codigoBase) === 0) {
                        $sigNum = str_pad($data['codNumero'], 2, '0', STR_PAD_LEFT);
                    } else {
                        $numero = (int)substr($codigo, strlen($codigoBase));
                        $sigNum = str_pad($numero + 1, 2, '0', STR_PAD_LEFT);
                    }
                }
            }
        } else {
            $data = $this->model->getNumbers($codigoBase);

            if (empty($data)) {
                $sigNum = '01';
            } else {
                $codigo = $data[0]['codigo'];
                $prefijo = substr($codigo, 0, strlen($codigoBase));

                if (isset($data['codNumero']) && strcmp($prefijo, $codigoBase) === 0) {
                    $sigNum = str_pad($data['codNumero'], 2, '0', STR_PAD_LEFT);
                } else {
                    $numero = (int)substr($codigo, strlen($codigoBase));
                    $sigNum = str_pad($numero + 1, 2, '0', STR_PAD_LEFT);
                }
            }
        }

        echo json_encode(['numero' => $sigNum]);
        die();
    }
}
