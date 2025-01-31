<?php

class Controller
{
    protected $model, $views;
    public function __construct()
    {
        // Declara la vista
        $this->views = new Views();
        // Declara el metodo cargarModel
        $this->cargarModel();
    }

    public function cargarModel()
    {
        // Declarar el archivo modeloModel
        $model = get_class($this) . "Model";
        // Declarar la ruta de la carpeta Models
        $ruta = "Models/" . $model . ".php";
        // Verificar si existe ese modelo
        if (file_exists($ruta)) {
            require_once $ruta;
            $this->model = new $model();
        }
    }

    public function pdfHeader($pdf, $fechaHora) {
        $pdf->AliasNbPages();
        $pdf->AddPage();

        // Configuración de la fuente y logo
        $pdf->SetFont('Arial', 'B', 10);
        
        $membrete_width = 216; // Ancho completo de la página
        $membrete_height = 30; // Altura para el membrete
        $membrete_x = 0; // Sin margen izquierdo
        $membrete_y = 0; // Posición en Y para el membrete

        // Logo (membrete en la parte superior)
        $pdf->Image($_SERVER['DOCUMENT_ROOT'] . '/pos_inv/Assets/img/membrete.jpg', $membrete_x, $membrete_y, $membrete_width, $membrete_height);

        // Posicionar el texto "Reporte emitido" a la derecha, con la fecha y hora
        $pdf->SetXY(160, 30); 
        $pdf->Cell(0, 10, 'REPORTE EMITIDO:', 0, 1, 'R');
        $pdf->SetXY(160, 35);
        $pdf->Cell(0, 10, $fechaHora, 0, 1, 'R');         
        $pdf->SetXY(35, 45);
    }

    public function pdfTableHeader($pdf, $col_widths, $headers, $font_table=[]) {
        $pdf->SetFillColor(254, 222, 227);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont($font_table['header'][0], $font_table['header'][1], $font_table['header'][2]);
        foreach ($headers as $index => $header) {
            $pdf->Cell($col_widths[$index], 8, mb_convert_encoding($header, 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
        }
        $pdf->Ln();
    }

    public function pdfTablebody($pdf, $font_table=[]) {
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont($font_table['body'][0], $font_table['body'][1], $font_table['body'][2]);
    }
    

    public function CheckPageBreak($pdf, $h, $col_widths, $headers,  $margin_left, $font_table=[])
    {
        // Altura de la página menos el espacio para el footer
        $page_height = $pdf->GetPageHeight() - 30;
        if ($pdf->GetY() + $h > $page_height) {
            $pdf->SetTopMargin(20); // Establece el margen superior a 20 mm
            $pdf->AddPage();
            $pdf->SetX($margin_left);
            $this->pdfTableHeader($pdf, $col_widths, $headers, $font_table);
            $this->pdfTablebody($pdf, $font_table);
        }
    }
    
    public function MultiCellRow($pdf, $col_widths, $data, $margin_left, $line_height = 6, $inner_line_height = 4)
    {
        $max_lines = 0;

        foreach ($data as $i => $cell) {
            $nb = $this->NbLines($pdf, $col_widths[$i], $cell, $inner_line_height);
            $max_lines = max($max_lines, $nb);
        }

        $height = $line_height * $max_lines;

        $pdf->SetX($margin_left);
        for ($i = 0; $i < count($data); $i++) {
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $pdf->Rect($x, $y, $col_widths[$i], $height);
            $pdf->SetXY($x, $y + ($height - $inner_line_height * $this->NbLines($pdf, $col_widths[$i], $data[$i], $inner_line_height)) / 2);
            $pdf->MultiCell($col_widths[$i], $inner_line_height, $data[$i], 0, 'C', false);
            $pdf->SetXY($x + $col_widths[$i], $y);
        }
        $pdf->Ln($height);
    }

    public function NbLines($pdf, $w, $txt)
    {
        $properties = $pdf->getProperties();
        $cw = &$properties['CurrentFont']['cw'];
        if ($w == 0)
            $w = $properties['w'] - $properties['rMargin'] - $properties['x'];
        $wmax = ($w - 2 * $properties['cMargin']) * 1000 / $properties['FontSize'];
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
    
}
