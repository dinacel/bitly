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
    /**
     * API host.
     *
     * @var string
     */
    const BITLY_API_URL = 'http://api.bit.ly';

    /**
     * API host (SSL).
     *
     * @var string
     */
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
     * BitlyResponse object.
     *
     * @var BitlyResponse
     */
    protected $response;

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

    /**
     * Execute HTTP GET method.
     *
     * @param string $path  Relative path under /v3.
     * @param array  $query Query parameters.
     * @return mixed Response data.
     */
    public function get($path, array $query = array())
    {
        $this->client->setUri(static::BITLY_API_SECURE_URL);

        $response = $this->client->restGet('/v3' . $path, $this->prepareArgs($query));

        return $this->getResponseData($response);
    }

    // internal method

    /**
     * Prepare API arguments.
     *
     * @param array $query API arguments.
     * @return array API arguments containing access token and response format.
     */
    protected function prepareArgs(array $query = array())
    {
        $args = array_filter($query, function ($value) { return $value !== null; });

        return $args + array(
            'access_token' => $this->token,
            'format'       => $this->format,
        );
    }

    /**
     * Return response data.
     *
     * @param string $response Raw response body.
     * @return mixed Response data.
     */
    protected function getResponseData($response)
    {
        $this->response = new BitlyResponse($this->format, $response);

        return $this->response->getResponseData();
    }

    // accessor

    /**
     * Return response format.
     *
     * @return string Response format.
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Return Restclient object.
     *
     * @return \Contrib\Component\Service\Bitly\V3\Request\RestClient
     */
    public function getRestClient()
    {
        return $this->client;
    }

    /**
     * Return BitlyResponse object.
     *
     * @return \Contrib\Component\Service\Bitly\V3\Response\BitlyResponse
     */
    public function getResponse()
    {
        return $this->response;
    }
}
