<?php

namespace apiConverter\application\actions;

use apiConverter\core\services\converter\ConverterService;
use apiConverter\core\services\converter\ConverterServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Psr7\Response;
use Slim\Psr7\Stream;

class PostConvertAction extends AbstractAction{

    private ConverterServiceInterface $converter;

    private array $format;

    public function __construct(ConverterServiceInterface $converter, array $format){
        $this->converter = $converter;
        $this->format = $format;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $uploadedFiles = $rq->getUploadedFiles();
        $formatRq = $rq->getParsedBody()['target_format'];

        if (!isset($uploadedFiles['file'])) {
            throw new HttpBadRequestException($rq, 'Fichier manquant');
        }

        $file = $uploadedFiles['file'];
        $tempPath = '/tmp/' . $file->getClientFilename();
        $file->moveTo($tempPath);
        $converter = in_array($formatRq, $this->format);

        if (!$converter) {
            throw new HttpBadRequestException($rq, 'Format non pris en charge');
        }


        $outputFile = $this->converter->executeConverter($formatRq,$tempPath);
        $stream = new Stream(fopen($outputFile, 'rb'));

        return $rs
            ->withHeader('Content-Type', 'application/octet-stream')
            ->withHeader('Content-Disposition', 'attachment; filename="' . basename($outputFile) . '"')
            ->withBody($stream);
    }
}
