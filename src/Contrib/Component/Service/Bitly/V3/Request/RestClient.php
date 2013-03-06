<?php
namespace Contrib\Component\Service\Bitly\V3\Request;

use Contrib\Component\Service\Bitly\V3\Request\Adapter\Curl;

class RestClient
{
    protected $adapter;

    public function __construct($adapter = null)
    {
        if ($adapter === null) {
            $this->adapter = new Curl();
        } else {
            $this->adapter = $adapter;
        }
    }

    public function restGet($path, array $query = array())
    {
        $url = $this->buildUrl($path, $query);

        return $this->adapter->get($url);
    }

    // internal method

    protected function buildUrl($path, array $query)
    {
        return $this->uri . $path . $this->queryString($query);
    }

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

    protected function queryString(array $query, $prependQuery = true)
    {
        $queryString = implode('&', $this->buildHttpQuery($query));

        if ($prependQuery) {
            return '?' . $queryString;
        }

        return $queryString;
    }

    // accessor

    public function setUri($uri)
    {
        $this->uri = $uri;
    }
}
