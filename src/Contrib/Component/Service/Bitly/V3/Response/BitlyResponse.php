<?php
namespace Contrib\Component\Service\Bitly\V3\Response;

/**
 * Bit.ly response.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class BitlyResponse
{
    /**
     * Response format (json, xml).
     *
     * @var string
     */
    protected $format;

    /**
     * Raw response body.
     *
     * @var string
     */
    protected $response;

    /**
     * Constructor.
     *
     * @param string $format   Response format.
     * @param string $response Raw response body.
     */
    public function __construct($format, $response)
    {
        $this->format   = $format;
        $this->response = $response;
    }

    /**
     * Return response data.
     *
     * @return mixed
     */
    public function getResponseData()
    {
        return $this->createResponse($this->format, $this->response)->getResponseData();
    }

    // internal method

    /**
     * Create response object.
     *
     * @param string $format   Response format.
     * @param string $response Raw response body.
     * @return \Contrib\Component\Service\Bitly\V3\Response\BitlyResponse
     * @throws \RuntimeException
     */
    private function createResponse($format, $response)
    {
        switch ($format) {
            case JsonResponse::FORMAT:
                return new JsonResponse($format, $response);
            case XmlResponse::FORMAT:
                return new XmlResponse($format, $response);
        }

        throw new \RuntimeException(sprintf('Unsupported format: %s', $format));
    }

    // accessor

    /**
     * Return raw response body.
     *
     * @return string Raw response body.
     */
    public function getResponse()
    {
        return $this->response;
    }
}
