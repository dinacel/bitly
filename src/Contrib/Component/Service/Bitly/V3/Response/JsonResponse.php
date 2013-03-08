<?php
namespace Contrib\Component\Service\Bitly\V3\Response;

/**
 * Bit.ly JSON response.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class JsonResponse extends BitlyResponse
{
    /**
     * Response format.
     *
     * @var string
     */
    const FORMAT = 'json';

    /**
     * {@inheritdoc}
     *
     * @see \Contrib\Component\Service\Bitly\V3\Response\BitlyResponse::getResponseData()
     */
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
