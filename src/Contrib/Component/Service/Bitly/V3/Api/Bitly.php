<?php
namespace Contrib\Component\Service\Bitly\V3\Api;

use Contrib\Component\Service\Bitly\V3\Request\RestClient;
use Contrib\Component\Service\Bitly\V3\Response\BitlyResponse;
//use ZendRest\Client\RestClient;

/**
 * Bitly API
 */
class Bitly
{
    const BITLY_API_URL = 'http://api.bit.ly';
    const BITLY_API_SECURE_URL = 'https://api-ssl.bit.ly';

    /**
     * Access token.
     *
     * @var string
     */
    protected $token;

    /**
     * Response format (json or xml).
     *
     * @var string
     */
    protected $format;

    /**
     * RestClient.
     *
     * @var RestClient
     */
    protected $client;

    /**
     * Constructor.
     *
     * @param string     $token
     * @param string     $format
     * @param RestClient $client
     */
    public function __construct($token, $format = 'json', RestClient $client = null)
    {
        $this->token  = $token;
        $this->format = $format;

        if (null === $client) {
            $this->client = new RestClient();
        } else {
            $this->client = $client;
        }
    }

    // API

    public function get($path, array $query = array())
    {
        $this->client->setUri(static::BITLY_API_SECURE_URL);

        $response = $this->client->restGet('/v3' . $path, $this->prepareArgs($query));

        return $this->getResponseData($response);
    }

    // internal method

    protected function prepareArgs(array $query = array())
    {
        $args = array_filter($query, function ($value) { return $value !== null; });

        return $args + array(
            'access_token' => $this->token,
            'format'       => $this->format,
        );
    }

    protected function getResponseData($response)
    {
        $res = new BitlyResponse($this->format, $response);

        return $res->getResponseData();
    }
}
