<?php
namespace Contrib\Component\Service\Bitly\V3\Request;

use Contrib\Component\Service\Bitly\V3\Request\Adapter\Curl;

/**
 * REST client.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class RestClient
{
    /**
     * HTTP client adapter.
     *
     * @var mixed
     */
    protected $adapter;

    /**
     * Base URI.
     *
     * @var string
     */
    protected $uri;

    /**
     * Accessed URL.
     *
     * @var string
     */
    protected $url = null;

    /**
     * Constructor.
     *
     * @param mixed $adapter HTTP client adapter.
     */
    public function __construct($adapter = null)
    {
        if ($adapter === null) {
            $this->adapter = new Curl();
        } else {
            $this->adapter = $adapter;
        }
    }

    // API

    /**
     * Execute HTTP GET method.
     *
     * @param string $path  Relative path.
     * @param array  $query Query parameters.
     * @return mixed
     */
    public function restGet($path, array $query = array())
    {
        $this->url = $this->buildUrl($path, $query);

        return $this->adapter->get($this->url);
    }

    // internal method

    /**
     * Build URL.
     *
     * @param string $path  Relative path.
     * @param array  $query Query parameters.
     * @return string URL.
     */
    protected function buildUrl($path, array $query)
    {
        if (!isset($this->uri)) {
            throw new \RuntimeException('base URI is not set.');
        }

        return $this->uri . $path . $this->queryString($query);
    }

    /**
     * Build HTTP query parameters.
     *
     * @param array $query Query parameters.
     * @return string[] Query parameters.
     * @throws \InvalidArgumentException
     */
    protected function buildHttpQuery(array $query)
    {
        $qs = array();

        foreach ($query as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $v) {
                    if (is_array($v)) {
                        throw new \InvalidArgumentException('Invalid query string.');
                    }

                    $qs[] = http_build_query(array($key => $v));
                }
            } else {
                $qs[] = http_build_query(array($key => $value));
            }
        }

        return $qs;
    }

    /**
     * Return query string.
     *
     * @param array  $query        Query parameters.
     * @param string $prependQuery Whether to prepend "?".
     * @return string Query string.
     */
    protected function queryString(array $query, $prependQuery = true)
    {
        $queryString = implode('&', $this->buildHttpQuery($query));

        if ($prependQuery) {
            return '?' . $queryString;
        }

        return $queryString;
    }

    // accessor

    /**
     * Set HTTP client adapter.
     *
     * @param mixed $adapter HTTP client adapter
     * @return \Contrib\Component\Service\Bitly\V3\Request\RestClient
     */
    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;

        return $this;
    }

    /**
     * Return HTTP client adapter.
     *
     * @return mixed HTTP client adapter.
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * Set URI.
     *
     * @param string $uri URI.
     * @return \Contrib\Component\Service\Bitly\V3\Request\RestClient
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Return URI.
     *
     * @return string URI.
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Return accessed URL.
     *
     * @return string Accessed URL.
     */
    public function getUrl()
    {
        return $this->url;
    }
}
