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

    /**
     * Execute HTTP GET method.
     *
     * @param string $path  Relative path.
     * @param array  $query Query parameters.
     * @return mixed
     */
    public function restGet($path, array $query = array())
    {
        $url = $this->buildUrl($path, $query);

        return $this->adapter->get($url);
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
}
