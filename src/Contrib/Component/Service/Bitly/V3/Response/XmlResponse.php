<?php
namespace Contrib\Component\Service\Bitly\V3\Response;

class XmlResponse extends BitlyResponse
{
    const FORMAT = 'xml';

    public function getResponseData()
    {
        $xml = simplexml_load_string($this->response);

        $statusCode = (string) $xml->status_code;
        $statusTxt  = (string) $xml->status_txt;

        if ($statusCode === '200' && $statusTxt === 'OK') {
            return $xml->data;
        }

        throw new \RuntimeException(sprintf('API response error: %s', $statusTxt));
    }
}
