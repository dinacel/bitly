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
        $apiClassName = substr($name, 3);
        $class        = __NAMESPACE__ . '\\Api\\' . $apiClassName;

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
