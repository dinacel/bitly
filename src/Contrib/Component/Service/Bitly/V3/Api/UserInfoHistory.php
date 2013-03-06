<?php
namespace Contrib\Component\Service\Bitly\V3\Api;

/**
 * User Info / History
 *
 * /v3/user/info
 * /v3/user/link_history
 * /v3/user/network_history
 * /v3/user/tracking_domain_list
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class UserInfoHistory extends Bitly
{
    public function info()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/usr/info', $query);
    }

    public function linkHistory()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/usr/link_history', $query);
    }

    public function networkHistory()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/usr/network_history', $query);
    }

    public function trackingDomainList()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/usr/tracking_domain_list', $query);
    }
}
