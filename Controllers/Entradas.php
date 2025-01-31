<?php

class Entradas extends Controller
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
        $data = $this->model->getProveedor();
        $this->views->getView("Generar Entrada", $this, "index", $data);
    }

    public function salidas()
    {
        $this->views->getView("Generar Salida", $this, "salidas");
    }

    public function historial_salidas()
    {
        $this->views->getView("Historial de Salidas || Lotes", $this, "historial_salidas");
    }

    public function historial_salidas_g()
    {
        $this->views->getView("Historial de Salidas || General", $this, "historial_salidas_g");
    }

    public function listar_historial_salida()
    {
        $data = $this->model->getHistorialSalida();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <a class="warning" type="button" title="Reporte" href="' . APP_URL . "Entradas/generarPdfSalida/" . $data[$i]['id'] . '" target="_blank"><span class="warning material-symbols-outlined">picture_as_pdf</span></a>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listar_historial_salidas_g()
    {
        $data = $this->model->getHistorialSalida_g();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function pdf_salidas()
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

        $pdf->SetTitle(mb_convert_encoding('Reporte de Salidas ', 'ISO-8859-1', 'UTF-8') . $fechaHora);
        $this->pdfHeader($pdf, $fechaHora);

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(140, 10, mb_convert_encoding('REPORTE DE SALIDAS', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');

        $pdf->Ln(10);

        $headers = ['Ref', 'Repuesto', 'Marca', 'Categoria', 'Precio', 'Cantidad', 'Total', 'Fecha'];
        $col_widths = [15, 30, 25, 25, 25, 20, 35, 30];
        $margin_left = 5;
        $total_width = array_sum($col_widths);
        $line_height = 6;
        $inner_line_height = 4;
        $font_table = [
            'header' => ['Arial', 'B', 10],  // Fuente para el encabezado
            'body'   => ['Arial', '', 8]    // Fuente para el cuerpo
        ];

        $pdf->SetX($margin_left);
        $this->pdfTableHeader($pdf, $col_widths, $headers, $font_table);
        $this->pdfTableBody($pdf, $font_table);

        foreach ($tableData as $row) {

            $formattedPrecio = number_format($row['precio'], 2, ',', '.');
            $formattedCantidad = number_format($row['cantidad'], 0, ',', '.');
            $formattedSubTotal = number_format($row['sub_total'], 2, ',', '.');

            $pdf->SetX($margin_left);
            $row_height = $line_height * $this->NbLines($pdf, $total_width, implode(' ', $row), $inner_line_height);
            $this->CheckPageBreak($pdf, $row_height, $col_widths, $headers, $margin_left, $font_table);
            $this->MultiCellRow($pdf, $col_widths, [
                mb_convert_encoding($row['ref'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['repuesto'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['marca'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['categoria'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($formattedPrecio . 'Bs', 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($formattedCantidad, 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($formattedSubTotal . 'Bs', 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['fecha'], 'ISO-8859-1', 'UTF-8')
            ], $margin_left, $line_height, $inner_line_height);
        }

        ob_end_clean();
        $pdf->Output('I', 'Reporte de Salidas: ' . $fechaHora . '.pdf');
    }


    public function generarPdfSalida($id_salida)
    {
        $empresa = $this->model->getEmpresa();
        $productos = $this->model->getRepSalida($id_salida);
        require('Libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P', 'mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 0, 0);
        $pdf->SetTitle('Reporte Salida');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->cell(56, 10, mb_convert_encoding($empresa['nombre'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        // $pdf->Image(APP_URL . 'Assets/img/logo.jpg', 60, 20, 15, 15);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 5, 'RIF: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 5, $empresa['rif'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 5, mb_convert_encoding('TELÉFONO: ', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 5, $empresa['telefono'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 5, mb_convert_encoding('DIRECCIÓN: ', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 5, $empresa['direccion'], 0, 1, 'L');

        // $pdf->SetFont('Arial', 'B', 8);
        // $pdf->Cell(18, 5, 'Factura: ', 0, 0, 'L');
        // $pdf->SetFont('Arial', '', 8);
        // $pdf->Cell(20, 5, $id_salida, 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 5, 'FECHA Y HORA ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);

        $fechaHora = date("Y-m-d g:i A", strtotime($productos[0]['fecha']));
        $pdf->Cell(20, 5, $fechaHora, 0, 1, 'L');

        $pdf->Ln();

        // Emcabezado del Producto
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(41, 5, mb_convert_encoding('Descripción', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L', true);
        $pdf->Cell(10, 5, 'Cant', 0, 0, 'L', true);
        // $pdf->Cell(10, 5, 'Precio', 0, 0, 'L', true);
        $pdf->Cell(15, 5, 'Sub Total', 0, 1, 'L', true);
        $pdf->SetTextColor(0, 0, 0);
        $total = 0.00;
        foreach ($productos as $row) {
            $total = $total + $row['sub_total'] * $row['precio_dolar'];
            $pdf->Cell(42, 5, mb_convert_encoding($row['nombre'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
            $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
            // $pdf->Cell(10, 5, $row['precio'], 0, 0, 'L');
            $pdf->Cell(15, 5, 'Bs ' . number_format($row['sub_total'] * $row['precio_dolar'], 2, '.', ','), 0, 1, 'L');
        }
        $pdf->Ln();
        $pdf->Cell(70, 5, 'Total a Pagar', 0, 1, 'R');
        $pdf->Cell(70, 5, 'Bs ' . number_format($total, 2, '.', ','), 0, 1, 'R');

        $pdf->Output();
    }

    public function buscarCodigo($cod)
    {
        $data = $this->model->getRepCod($cod);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function ingresar()
    {
        $id = $_POST["id"];
        $datos = $this->model->getRepuestos($id);
        $id_repuesto = $datos["id"];
        $id_usuario = $_SESSION["id_usuario"];
        $precio = $_POST["precio"];
        $cantidad = $_POST["cantidad"];
        $comprobar = $this->model->consultarDetalle('detalle', $id_repuesto, $id_usuario);
        if (empty($comprobar)) {
            $sub_total = $precio * $cantidad;
            $data = $this->model->registrarDetalle('detalle', $id_repuesto, $id_usuario, $precio, $cantidad, $sub_total);
            if ($data == "ok") {
                $msg = array('msg' => 'Repuesto Ingresado', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al Ingresar', 'icono' => 'error');
            }
        } else {
            $total_cantidad = $comprobar["cantidad"] + $cantidad;
            $sub_total = $total_cantidad * $precio;

            // Verificar si el precio ha cambiado
            if ($comprobar["precio"] != $precio) {
                $data = $this->model->actualizarDetalle('detalle', $precio, $total_cantidad, $sub_total, $id_repuesto, $id_usuario);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Repuesto Actualizado y el precio ha sido actualizado.', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al Actualizar', 'icono' => 'error');
                }
            } else {
                $data = $this->model->actualizarDetalle('detalle', $precio, $total_cantidad, $sub_total, $id_repuesto, $id_usuario);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Repuesto Actualizado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al Actualizar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function ingresarSalida()
    {
        $id = $_POST["id"];
        $datos = $this->model->getRepuestos($id);
        $id_repuesto = $datos["id"];
        $id_usuario = $_SESSION["id_usuario"];
        $precio = $datos["precio_venta"];
        $cantidad = $_POST["cantidad"];
        $comprobar = $this->model->consultarDetalle('detalle_temp', $id_repuesto, $id_usuario);
        if (empty($comprobar)) {
            if ($datos['cantidad'] >= $cantidad) {
                $sub_total = $precio * $cantidad;
                $data = $this->model->registrarDetalle('detalle_temp', $id_repuesto, $id_usuario, $precio, $cantidad, $sub_total);
                if ($data == "ok") {
                    $msg = array('msg' => 'Repuesto Ingresado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al Ingresar', 'icono' => 'error');
                }
            } else {
                $msg = array('msg' => 'Stock Disponible hay ' . $datos['cantidad'], 'icono' => 'warning');
            }
        } else {
            $total_cantidad = $comprobar["cantidad"] + $cantidad;
            $sub_total = $total_cantidad * $precio;
            $data = $this->model->actualizarDetalle('detalle_temp', $precio, $total_cantidad, $sub_total, $id_repuesto, $id_usuario);
            if ($data == "modificado") {
                $msg = array('msg' => 'Repuesto Actualizado', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al Actualizar', 'icono' => 'error');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listar($table)
    {
        $id_usuario = $_SESSION["id_usuario"];
        $data['detalle'] = $this->model->getDetalle($table, $id_usuario);
        $data['total_pagar'] = $this->model->calcularEntrada($table, $id_usuario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delete($id)
    {
        $data = $this->model->deleteDetalle('detalle', $id);
        if ($data == "ok") {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        } else {
            $msg = array('msg' => 'Repuesto eliminado', 'icono' => 'success');
        }
        echo json_encode($msg);
        die();
    }

    public function deleteSalida($id)
    {
        $data = $this->model->deleteDetalle('detalle_temp', $id);
        if ($data == "ok") {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        } else {
            $msg = array('msg' => 'Repuesto eliminado', 'icono' => 'success');
        }
        echo json_encode($msg);
        die();
    }

    public function registrarEntrada($id_proveedor)
    {
        $id_usuario = $_SESSION["id_usuario"];
        $comprobar = $this->model->consultarDetalle2('detalle', $id_usuario);
        if (empty($comprobar)) {
            $msg = array("msg" => "Ingrese al menos un Repuesto", "icono" => "error");
        } else {
            $total = $this->model->calcularEntrada('detalle', $id_usuario);
            $data = $this->model->registrarEntrada($id_proveedor, $total['total_sub_total']);
            if ($data['status'] == "ok") {
                $detalle = $this->model->getDetalle('detalle', $id_usuario);
                $id_entrada = $data['id'];
                foreach ($detalle as $row) {
                    $cantidad = $row['cantidad'];
                    $precio = $row['precio'];
                    $id_rep = $row['id_repuesto'];
                    $sub_total = $cantidad * $precio;
                    $this->model->registrarDetalleEntrada($id_entrada, $id_rep, $cantidad, $precio, $sub_total);
                    $stock_actual = $this->model->getRepuestos($id_rep);
                    $stock = $stock_actual['cantidad'] + $cantidad;
                    $this->model->actualizarStock($stock, $id_rep);
                }
                $vaciar = $this->model->vaciarDetalle('detalle', $id_usuario);
                if ($vaciar == "ok") {
                    $this->model->saveBitacora($id_usuario, '1', '0', $id_entrada);
                    $msg = array('msg' => 'ok', 'id_entrada' => $id_entrada);
                }
            } else {
                $msg = array("msg" => "Error al realizar la Entrada", "icono" => "error");
            }
        }
        echo json_encode($msg);
        die();
    }

    public function registrarSalida()
    {
        $id_usuario = $_SESSION["id_usuario"];
        $comprobar = $this->model->consultarDetalle2('detalle_temp', $id_usuario);
        if (empty($comprobar)) {
            $msg = array("msg" => "Ingrese al menos un Repuesto", "icono" => "error");
        } else {
            $total = $this->model->calcularEntrada('detalle_temp', $id_usuario);
            $data = $this->model->registrarSalida($total['total']);
            if ($data['status'] == "ok") {
                $detalle = $this->model->getDetalle('detalle_temp', $id_usuario);
                $id_salida = $data['id'];
                foreach ($detalle as $row) {
                    $cantidad = $row['cantidad'];
                    $precio = $row['precio'];
                    $id_rep = $row['id_repuesto'];
                    $sub_total = $cantidad * $precio;
                    $this->model->registrarDetalleSalida($id_salida, $id_rep, $cantidad, $precio, $sub_total);
                    $stock_actual = $this->model->getRepuestos($id_rep);
                    $stock = $stock_actual['cantidad'] - $cantidad;
                    $this->model->actualizarStock($stock, $id_rep);
                }
                $vaciar = $this->model->vaciarDetalle('detalle_temp', $id_usuario);
                if ($vaciar == "ok") {
                    $this->model->saveBitacora($id_usuario, '2', '0', $id_salida);
                    $msg = array('msg' => 'ok', 'id_salida' => $id_salida);
                }
            } else {
                $msg = array("msg" => "Error al realizar la Salida", "icono" => "error");
            }
        }
        echo json_encode($msg);
        die();
    }

    public function generarPdf($id_entrada)
    {
        $empresa = $this->model->getEmpresa();
        $productos = $this->model->getRepEntrada($id_entrada);
        require('Libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P', 'mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 0, 0);
        $pdf->SetTitle('Justificativo de Entrada');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->cell(56, 10, mb_convert_encoding($empresa['nombre'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');

        // $pdf->Image(APP_URL . 'Assets/img/logo.jpg', 60, 20, 15, 15);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 5, 'RIF: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 5, $empresa['rif'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 5, mb_convert_encoding('TELÉFONO: ', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 5, $empresa['telefono'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 5, mb_convert_encoding('DIRECCIÓN: ', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 5, $empresa['direccion'], 0, 1, 'L');

        // $pdf->SetFont('Arial', 'B', 8);
        // $pdf->Cell(18, 5, 'Factura: ', 0, 0, 'L');
        // $pdf->SetFont('Arial', '', 8);
        // $pdf->Cell(20, 5, $id_entrada, 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 5, 'FECHA Y HORA ', 0, 0, 'L');

        $pdf->SetFont('Arial', '', 8);
        $fechaHora = date("Y-m-d g:i A", strtotime($productos[0]['fecha']));
        $pdf->Cell(20, 5, $fechaHora, 0, 1, 'L');

        $pdf->Ln();

        // Emcabezado del Producto
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(35, 5, mb_convert_encoding('Descripción', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L', true);
        $pdf->Cell(20, 5, 'Cant', 0, 0, 'L', true);
        // $pdf->Cell(10, 5, 'Precio', 0, 0, 'L', true);
        $pdf->Cell(15, 5, 'Sub Total', 0, 1, 'L', true);
        $pdf->SetTextColor(0, 0, 0);
        $total = 0.00;
        foreach ($productos as $row) {
            $total = $total + $row['sub_total'];
            $pdf->Cell(35, 5, mb_convert_encoding($row['nombre'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
            $pdf->Cell(20, 5, $row['cantidad'], 0, 0, 'L');
            // $pdf->Cell(10, 5, $row['precio'], 0, 0, 'L');
            $pdf->Cell(15, 5, 'Bs ' . number_format($row['sub_total'], 2, '.', ','), 0, 1, 'L');
        }
        $pdf->Ln();
        // $pdf->SetFont('Arial', 'B');
        $pdf->Cell(70, 5, 'Total a Pagar', 0, 1, 'R');
        $pdf->Cell(70, 5, 'Bs ' . number_format($total, 2, '.', ','), 0, 1, 'R');

        $pdf->Output();
    }

    public function pdf_entradas()
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

        $pdf->SetTitle(mb_convert_encoding('Reporte de Entradas ', 'ISO-8859-1', 'UTF-8') . $fechaHora);
        $this->pdfHeader($pdf, $fechaHora);

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(140, 10, mb_convert_encoding('REPORTE DE ENTRADAS', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        $pdf->Ln(10);

        $headers = ['Ref', 'Proveedor', 'Repuesto', 'Marca', 'Categoria', 'Precio', 'Cantidad', 'Total', 'Fecha'];
        $col_widths = [15, 25, 25, 20, 20, 20, 20, 30, 30];
        $margin_left = 5;
        $total_width = array_sum($col_widths);
        $line_height = 6;
        $inner_line_height = 4;
        $font_table = [
            'header' => ['Arial', 'B', 10],  // Fuente para el encabezado
            'body'   => ['Arial', '', 8]    // Fuente para el cuerpo
        ];

        $pdf->SetX($margin_left);
        $this->pdfTableHeader($pdf, $col_widths, $headers, $font_table);
        $this->pdfTableBody($pdf, $font_table);

        foreach ($tableData as $row) {

            $formattedPrecio = number_format($row['precio'], 2, ',', '.');
            $formattedCantidad = number_format($row['cantidad'], 0, ',', '.');
            $formattedSubTotal = number_format($row['sub_total'], 2, ',', '.');

            $pdf->SetX($margin_left);
            $row_height = $line_height * $this->NbLines($pdf, $total_width, implode(' ', $row), $inner_line_height);
            $this->CheckPageBreak($pdf, $row_height, $col_widths, $headers, $margin_left, $font_table);
            $this->MultiCellRow($pdf, $col_widths, [
                mb_convert_encoding($row['ref'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['proveedor'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['repuesto'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['marca'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['categoria'], 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($formattedPrecio . 'Bs', 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($formattedCantidad, 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($formattedSubTotal . 'Bs', 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($row['fecha_entrada'], 'ISO-8859-1', 'UTF-8')
            ], $margin_left, $line_height, $inner_line_height);
        }

        // Salida del PDF
        ob_end_clean();
        $pdf->Output('I', 'Reporte de Entradas  ' . $fechaHora . '.pdf');
    }

    public function historial()
    {
        $this->views->getView("Historial de Entradas || Lotes", $this, "historial");
    }

    public function listar_historial()
    {
        $data = $this->model->getHistorialEntradas();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <a class="warning" type="button" title="Reporte" href="' . APP_URL . "Entradas/generarPdf/" . $data[$i]['id'] . '" target="_blank"><span class="warning material-symbols-outlined">picture_as_pdf</span></a>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function historialG()
    {
        $this->views->getView("Historial de Entradas || General", $this, "historialG");
    }

    public function listar_historial_g()
    {
        $data = $this->model->getHistorialEntradas_g();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
