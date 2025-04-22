<?php

namespace apiConverter\core\services\converter;

interface ConverterServiceInterface
{
    public function executeConverter(string $format,string $filePath): string;

}