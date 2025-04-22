<?php

namespace apiConverter\infrastructure\infraConverter;

use League\Csv\Reader;

class CsvToTxtConverter implements ConverterInfrastructureInterface
{

    #[\Override] public function convert(string $filePath): string
    {
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setDelimiter(';');
        $records = $csv->getRecords();

        $output = '';
        foreach ($records as $record) {
            $output .= implode(' ', $record) . PHP_EOL;
        }

        $newFilePath = sys_get_temp_dir() . '/' . uniqid('converted_', true) . '.txt';
        file_put_contents($newFilePath, $output);

        return $newFilePath;
    }
}