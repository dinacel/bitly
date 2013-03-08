<?php
namespace Contrib\Component\Service\Bitly\V3\Response;

/**
 * Bit.ly XML response.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class XmlResponse extends BitlyResponse
{
    /**
     * Response format.
     *
     * @var string
     */
    const FORMAT = 'xml';

    /**
     * {@inheritdoc}
     *
     * @see \Contrib\Component\Service\Bitly\V3\Response\BitlyResponse::getResponseData()
     */
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
