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
        $this->views->getView("Categorias", $this, "index");
    }

    public function listar()
    {
        $data = $this->model->getCategorias();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="bagde-active">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="primary" type="button" title="Actualizar" onclick="btnEditarCat(' . $data[$i]['id'] . ');"><span type="button" class="primary material-symbols-outlined">edit</span></button>
                <button class="warning" type="button" title="Desactivar" onclick="btnEliminarCat(' . $data[$i]['id'] . ');"><span type="button" class="delete material-symbols-outlined">lock</span></button>
                </div>';
            } else {
                $data[$i]['estado'] = '<span class="bagde-inactive">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="success" type="button" title="Activar" onclick="btnIngresarCat(' . $data[$i]['id'] . ');"><span class="success material-symbols-outlined">lock_open</span></button>
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
                if ($data['status'] == "ok") {
                    $detalle = $data['id'];
                    $this->model->saveBitacora($_SESSION['id_usuario'], '5', '0', $detalle);
                    $msg = array("msg" => "Categoria registrada", "icono" => "success");
                } else if ($data['status'] == "existe") {
                    $msg = array("msg" => "La Categoria ya está registrada", "icono" => "warning");
                } else {
                    $msg = array("msg" => "Error al registrar", "icono" => "error");
                }
            } else {
                $data = $this->model->modificarCategoria($nombre, $id);
                if ($data == "modificado") {
                    $this->model->saveBitacora($_SESSION['id_usuario'], '5', '1', $id);
                    $msg = array("msg" => "Categoria actualizada", "icono" => "success");
                } else {
                    $msg = array("msg" => "Error al actualizar", "icono" => "error");
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
            $this->model->saveBitacora($_SESSION['id_usuario'], '5', '3', $id);
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
            $this->model->saveBitacora($_SESSION['id_usuario'], '5', '2', $id);
            $msg = array("msg" => "Categoria activada", "icono" => "success");
        } else {
            $msg = array("msg" => "Error al activar", "icono" => "error");
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function generarPDF()
    {
        if ($_SESSION['rol'] == "Vendedor") {
            header("location: " . APP_URL);
            die();
        }
        ob_start();
        date_default_timezone_set('America/Caracas');
        $fechaHora = date("d/m/Y H:i A");

        $json =  $_POST['tableData'];
        $tableData = json_decode($json, true);

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

        $pdf->SetTitle(mb_convert_encoding('Listado de Caregorías ', 'ISO-8859-1', 'UTF-8') . $fechaHora);
        $this->pdfHeader($pdf, $fechaHora);

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(140, 10, mb_convert_encoding('LISTADO DE CATEGORÍAS', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        $pdf->Ln(10);

        $headers = ['NOMBRE'];
        $col_widths = [176];
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
                mb_convert_encoding($row['nombre'], 'ISO-8859-1', 'UTF-8')
            ], $margin_left, $line_height, $inner_line_height);
        }

        ob_end_clean();
        $pdf->Output('I', 'Listado de Categorias ' . $fechaHora . '.pdf');
    }
}
