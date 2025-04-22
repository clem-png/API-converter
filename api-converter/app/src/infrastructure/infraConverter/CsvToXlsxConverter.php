<?php

namespace apiConverter\infrastructure\infraConverter;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CsvToXlsxConverter implements ConverterInfrastructureInterface
{

    #[\Override] public function convert(string $filePath): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $handle = fopen($filePath, 'r');
        $row = 1;
        while (($data = fgetcsv($handle, 1000, ";")) !== false) {
            foreach ($data as $col => $value) {
                $sheet->setCellValue([$col + 1, $row], $value);
            }
            $row++;
        }
        fclose($handle);

        $newFilePath = sys_get_temp_dir() . '/' . uniqid('converted_', true) . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($newFilePath);

        return $newFilePath;
    }
}