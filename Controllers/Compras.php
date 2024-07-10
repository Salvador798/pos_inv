<?php

class Compras extends Controller
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

    public function ventas()
    {
        $this->views->getView($this, "ventas");
    }

    public function historial_ventas()
    {
        $this->views->getView($this, "historial_ventas");
    }

    public function buscarCodigo($cod)
    {
        $data = $this->model->getProCod($cod);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function ingresar()
    {
        $id = $_POST["id"];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos["id"];
        $id_usuario = $_SESSION["id_usuario"];
        $precio = $datos["precio_compra"];
        $cantidad = $_POST["cantidad"];
        $comprobar = $this->model->consultarDetalle('detalle', $id_producto, $id_usuario);
        if (empty($comprobar)) {
            $sub_total = $precio * $cantidad;
            $data = $this->model->registrarDetalle('detalle', $id_producto, $id_usuario, $precio, $cantidad, $sub_total);
            if ($data == "ok") {
                $msg = array('msg' => 'Producto Ingresado', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al Ingresar', 'icono' => 'error');
            }
        } else {
            $total_cantidad = $comprobar["cantidad"] + $cantidad;
            $sub_total = $total_cantidad * $precio;
            $data = $this->model->actualizarDetalle('detalle', $precio, $total_cantidad, $sub_total, $id_producto, $id_usuario);
            if ($data == "modificado") {
                $msg = array('msg' => 'Producto Actualizado', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al Actualizar', 'icono' => 'error');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function ingresarVenta()
    {
        $id = $_POST["id"];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos["id"];
        $id_usuario = $_SESSION["id_usuario"];
        $precio = $datos["precio_venta"];
        $cantidad = $_POST["cantidad"];
        $comprobar = $this->model->consultarDetalle('detalle_temp', $id_producto, $id_usuario);
        if (empty($comprobar)) {
            $sub_total = $precio * $cantidad;
            $data = $this->model->registrarDetalle('detalle_temp', $id_producto, $id_usuario, $precio, $cantidad, $sub_total);
            if ($data == "ok") {
                $msg = array('msg' => 'Producto Ingresado', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al Ingresar', 'icono' => 'error');
            }
        } else {
            $total_cantidad = $comprobar["cantidad"] + $cantidad;
            $sub_total = $total_cantidad * $precio;
            $data = $this->model->actualizarDetalle('detalle_temp', $precio, $total_cantidad, $sub_total, $id_producto, $id_usuario);
            if ($data == "modificado") {
                $msg = array('msg' => 'Producto Actualizado', 'icono' => 'success');
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
        $data['total_pagar'] = $this->model->calcularCompra($table, $id_usuario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delete($id)
    {
        $data = $this->model->deleteDetalle('detalle', $id);
        if ($data == "ok") {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        } else {
            $msg = array('msg' => 'Producto eliminado', 'icono' => 'success');
        }
        echo json_encode($msg);
        die();
    }

    public function deleteVenta($id)
    {
        $data = $this->model->deleteDetalle('detalle_temp', $id);
        if ($data == "ok") {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        } else {
            $msg = array('msg' => 'Producto eliminado', 'icono' => 'success');
        }
        echo json_encode($msg);
        die();
    }

    public function registrarCompra()
    {
        $id_usuario = $_SESSION["id_usuario"];
        $total = $this->model->calcularCompra('detalle', $id_usuario);
        $data = $this->model->registrarCompra($total['total']);
        if ($data == "ok") {
            $detalle = $this->model->getDetalle('detalle', $id_usuario);
            $id_compra = $this->model->getId("compras");
            foreach ($detalle as $row) {
                $cantidad = $row['cantidad'];
                $precio = $row['precio'];
                $id_pro = $row['id_producto'];
                $sub_total = $cantidad * $precio;
                $this->model->registrarDetalleCompra($id_compra['id'], $id_pro, $cantidad, $precio, $sub_total);
                $stock_actual = $this->model->getProductos($id_pro);
                $stock = $stock_actual['cantidad'] + $cantidad;
                $this->model->actualizarStock($stock, $id_pro);
            }
            $vaciar = $this->model->vaciarDetalle('detalle', $id_usuario);
            if ($vaciar == "ok") {
                $msg = array('msg' => 'ok', 'id_compra' => $id_compra['id']);
            }
        } else {
            $msg = array("msg" => "Error al realizar la compra", "icono" => "error");
        }
        echo json_encode($msg);
        die();
    }

    public function registrarVenta()
    {
        $id_usuario = $_SESSION["id_usuario"];
        $total = $this->model->calcularCompra('detalle_temp', $id_usuario);
        $data = $this->model->registrarVenta($total['total']);
        if ($data == "ok") {
            $detalle = $this->model->getDetalle('detalle_temp', $id_usuario);
            $id_venta = $this->model->getId('ventas');
            foreach ($detalle as $row) {
                $cantidad = $row['cantidad'];
                $precio = $row['precio'];
                $id_pro = $row['id_producto'];
                $sub_total = $cantidad * $precio;
                $this->model->registrarDetalleVenta($id_venta['id'], $id_pro, $cantidad, $precio, $sub_total);
                $stock_actual = $this->model->getProductos($id_pro);
                $stock = $stock_actual['cantidad'] - $cantidad;
                $this->model->actualizarStock($stock, $id_pro);
            }
            $vaciar = $this->model->vaciarDetalle('detalle_temp', $id_usuario);
            if ($vaciar == "ok") {
                $msg = array('msg' => 'ok', 'id_venta' => $id_venta['id']);
            }
        } else {
            $msg = array("msg" => "Error al realizar la venta", "icono" => "error");
        }
        echo json_encode($msg);
        die();
    }

    public function generarPdf($id_compra)
    {
        $empresa = $this->model->getEmpresa();
        $productos = $this->model->getProCompra($id_compra);
        require('Libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P', 'mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 0, 0);
        $pdf->SetTitle('Reporte Entrada');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->cell(65, 10, utf8_decode($empresa['nombre']), 0, 1, 'C');
        $pdf->Image(APP_URL . 'Assets/img/logo.jpg', 60, 20, 15, 15);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(18, 5, 'Ruc: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 5, $empresa['ruc'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(18, 5, utf8_decode('Teléfono: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 5, $empresa['telefono'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(18, 5, utf8_decode('Dirección: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 5, $empresa['direccion'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(18, 5, 'Folio: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 5, $id_compra, 0, 1, 'L');
        $pdf->Ln();

        // Emcabezado del Producto
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(10, 5, 'Cant', 0, 0, 'L', true);
        $pdf->Cell(35, 5, utf8_decode('Descripción'), 0, 0, 'L', true);
        $pdf->Cell(10, 5, 'Precio', 0, 0, 'L', true);
        $pdf->Cell(15, 5, 'Sub Total', 0, 1, 'L', true);
        $pdf->SetTextColor(0, 0, 0);
        $total = 0.00;
        foreach ($productos as $row) {
            $total = $total + $row['sub_total'];
            $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
            $pdf->Cell(35, 5, utf8_decode($row['nombre']), 0, 0, 'L');
            $pdf->Cell(10, 5, $row['precio'], 0, 0, 'L');
            $pdf->Cell(15, 5, number_format($row['sub_total'], 2, '.', ','), 0, 1, 'L');
        }
        $pdf->Ln();
        $pdf->Cell(70, 5, 'Total a Pagar', 0, 1, 'R');
        $pdf->Cell(70, 5, number_format($total, 2, '.', ','), 0, 1, 'R');

        $pdf->Output();
    }

    public function historial()
    {
        $this->views->getView($this, "historial");
    }

    public function listar_historial()
    {
        $data = $this->model->getHistorialCompras();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <a class="warning" type="button" href="' . APP_URL . "Compras/generarPdf/" . $data[$i]['id'] . '" target="_blank"><span class="warning material-symbols-outlined">picture_as_pdf</span></a>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listar_historial_venta()
    {
        $data = $this->model->getHistorialVentas();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <a class="warning" type="button" href="' . APP_URL . "Compras/generarPdfVenta/" . $data[$i]['id'] . '" target="_blank"><span class="warning material-symbols-outlined">picture_as_pdf</span></a>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function generarPdfVenta($id_venta)
    {
        $empresa = $this->model->getEmpresa();
        $productos = $this->model->getProVenta($id_venta);
        require('Libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P', 'mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 0, 0);
        $pdf->SetTitle('Reporte Salida');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->cell(65, 10, utf8_decode($empresa['nombre']), 0, 1, 'C');
        $pdf->Image(APP_URL . 'Assets/img/logo.jpg', 60, 20, 15, 15);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(18, 5, 'Ruc: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 5, $empresa['ruc'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(18, 5, utf8_decode('Teléfono: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 5, $empresa['telefono'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(18, 5, utf8_decode('Dirección: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 5, $empresa['direccion'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(18, 5, 'Folio: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 5, $id_venta, 0, 1, 'L');
        $pdf->Ln();

        // Emcabezado del Producto
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(10, 5, 'Cant', 0, 0, 'L', true);
        $pdf->Cell(35, 5, utf8_decode('Descripción'), 0, 0, 'L', true);
        $pdf->Cell(10, 5, 'Precio', 0, 0, 'L', true);
        $pdf->Cell(15, 5, 'Sub Total', 0, 1, 'L', true);
        $pdf->SetTextColor(0, 0, 0);
        $total = 0.00;
        foreach ($productos as $row) {
            $total = $total + $row['sub_total'];
            $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
            $pdf->Cell(35, 5, utf8_decode($row['nombre']), 0, 0, 'L');
            $pdf->Cell(10, 5, $row['precio'], 0, 0, 'L');
            $pdf->Cell(15, 5, number_format($row['sub_total'], 2, '.', ','), 0, 1, 'L');
        }
        $pdf->Ln();
        $pdf->Cell(70, 5, 'Total a Pagar', 0, 1, 'R');
        $pdf->Cell(70, 5, number_format($total, 2, '.', ','), 0, 1, 'R');

        $pdf->Output();
    }
}
