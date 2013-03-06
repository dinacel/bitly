<?php
namespace Contrib\Component\Service\Bitly\V3\Response;

class JsonResponse extends BitlyResponse
{
    const FORMAT = 'json';

    public function getResponseData()
    {
        $json = json_decode($this->response, true);

        $statusCode = $json['status_code'];
        $statusTxt  = $json['status_txt'];

        if ($statusCode === 200 && $statusTxt === 'OK') {
            return $json['data'];
        }

        throw new \RuntimeException(sprintf('API response error: %s', $statusTxt));
    }
}
