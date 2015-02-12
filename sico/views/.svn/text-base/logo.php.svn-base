<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');
$objWorksheet = $excelito->getActiveSheet();
echo '<table border="1">' . "\n";
foreach ($objWorksheet->getRowIterator() as $row) {
    echo '<tr>' . "\n";
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);
    foreach ($cellIterator as $cell) {
        $hol = (string) $cell->getValue();
        if ($hol != '') {
            echo '<td>' . $cell->getValue() . '</td>' . "\n";
        }
    }

    echo '</tr>' . "\n";
}
echo '</table>' . "\n";

foreach ($excelito->getWorksheetIterator() as $worksheet) {
    $worksheetTitle = $worksheet->getTitle();
    $highestRow = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
    echo "<br>The worksheet " . $worksheetTitle . " has ";
    echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
    echo ' and ' . $highestRow . ' row.';
    echo '<table border="1"><tr>';
    for ($row = 1; $row <= $highestRow; ++$row) {
        echo '<tr>';
        for ($col = 0; $col < $highestColumnIndex; ++$col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            $val = (string) $cell->getValue();
            $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
            if ($val != '') {
                echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';
            }
        }
        echo '</tr>';
    }
    echo '</table>';
}
?>