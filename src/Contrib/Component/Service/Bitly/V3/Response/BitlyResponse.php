<?php
namespace Contrib\Component\Service\Bitly\V3\Response;

class BitlyResponse
{
    protected $format;
    protected $response;

    public function __construct($format, $response)
    {
        $this->format   = $format;
        $this->response = $response;
    }

    public function getResponseData()
    {
        return $this->createResponse()->getResponseData();
    }

    private function createResponse()
    {
        switch ($this->format) {
            case JsonResponse::FORMAT:
                return new JsonResponse($this->format, $this->response);
            case XmlResponse::FORMAT:
                return new XmlResponse($this->format, $this->response);
        }

        throw new \RuntimeException(sprintf('Unsupported format: %s', $this->format));
    }
}
