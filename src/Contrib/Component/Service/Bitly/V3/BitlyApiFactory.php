<?php
namespace Contrib\Component\Service\Bitly\V3;

use Contrib\Component\Service\Bitly\V3\Api\Bitly;

/**
 * Bit.ly API client factory.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class BitlyApiFactory
{
    /**
     * Constructor.
     *
     * @param string $token Access token.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    // API

    /**
     * Return API client.
     *
     * @param string $name Called method name.
     * @param array  $args Method arguments.
     * @return Contrib\Component\Service\Bitly\V3\Api\Bitly
     * @throws \RuntimeException
     */
    public function __call($name, array $args)
    {
        if (false !== strpos($name, 'get')) {
            $apiClassName = substr($name, 3);
            $class        = __NAMESPACE__ . '\\Api\\' . $apiClassName;

            return $this->createApi($class, $args);
        }

        throw new \BadMethodCallException(sprintf('Method not found: %s', $name));
    }

    // internal method

    /**
     * Return API client.
     *
     * @param string $class API client class name.
     * @param array  $args  Constructor options.
     * @return \Contrib\Component\Service\Bitly\V3\Api\Bitly
     * @throws \RuntimeException
     */
    protected function createApi($class, array $args)
    {
        if (!class_exists($class)) {
            throw new \RuntimeException(sprintf('Class not found: %s', $class));
        }

        if (isset($args[0])) {
            $format = $args[0];
        } else {
            $format = 'json';
        }

        return new $class($this->token, $format);
    }
}
