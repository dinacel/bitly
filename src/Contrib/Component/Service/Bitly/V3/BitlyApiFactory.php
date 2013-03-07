<?php
namespace Contrib\Component\Service\Bitly\V3;

class BitlyApiFactory
{
    public function __construct($token)
    {
        $this->token = $token;
    }

    public function __call($name, array $args)
    {
        $apiClassName = substr($name, 3);
        $class = __NAMESPACE__ . '\\Api\\' . $apiClassName;

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
