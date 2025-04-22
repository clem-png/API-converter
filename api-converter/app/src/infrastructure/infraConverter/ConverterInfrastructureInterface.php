<?php

namespace apiConverter\infrastructure\infraConverter;

interface ConverterInfrastructureInterface
{
    public function convert(string $filePath): string;

}