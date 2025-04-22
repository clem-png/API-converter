<?php

namespace apiConverter\core\services\converter;

use apiConverter\infrastructure\infraConverter\CsvToTxtConverter;
use apiConverter\infrastructure\infraConverter\CsvToXlsxConverter;

class ConverterService implements ConverterServiceInterface
{

    #[\Override] public function executeConverter(string $format, string $filePath): string
    {
        $converter= null;
        switch ($format){
            case "txt":
                $converter = new CsvToTxtConverter();
                break;
            case "xlsx":
                $converter = new CsvToXlsxConverter();
                break;
            default:
                break;
        }

        return $converter->convert($filePath);
    }
}