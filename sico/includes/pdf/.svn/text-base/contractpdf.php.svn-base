<?php

class PDFCONTRACT extends FPDF {

// Cabecera de página
    function Header() {
        // Logo
        $this->Image(IMAGES.SL.'logoplentiful.jpg', 10, 10,33);               
        // Salto de línea
        $this->Ln(20);
    }

// Pie de página
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 9);
        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo().'/{nb}' , 0, 0, 'C');
    }

}

?>
