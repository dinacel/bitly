<?php
namespace Contrib\Component\Service\Bitly\V3\Request\Adapter;

/**
 * HTTP client adapter.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class Curl
{
    /**
     * Default options.
     *
     * @var array
     */
    protected $options;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPGET        => false,
            CURLOPT_POST           => false,
            CURLOPT_URL            => null,
        );
    }

    /**
     * Execute HTTP GET method.
     *
     * @param string $url URL.
     * @return string HTTP response body.
     */
    public function get($url)
    {
        $getOptions = array(
            CURLOPT_HTTPGET => true,
            CURLOPT_URL     => $url,
        );

        $options = $getOptions + $this->options;

        return $this->execute($options);
    }

    // internal method

    /**
     * Execute HTTP access.
     *
     * @param array $options CURL options.
     * @return string HTTP response body.
     * @throws \RuntimeException
     */
    protected function execute(array $options)
    {
        $curl = curl_init();

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);
        $info     = curl_getinfo($curl);

        if ($info['http_code'] !== 200) {
            $message = sprintf('Failed to call API. status code: %d', $info['http_code']);

            throw new \RuntimeException($message);
        }

        curl_close($curl);

        return $response;
    }
}
