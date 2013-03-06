<?php
namespace Contrib\Component\Service\Bitly\V3\Api;

/**
 * Domains API.
 *
 * /v3/bitly_pro_domain
 * /v3/user/tracking_domain_clicks
 * /v3/user/tracking_domain_shorten_counts
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class Domains extends Bitly
{
    public function bitlyProDomain()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bitly_pro_domain', $query);
    }

    public function trackingDomainClicks()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/user/tracking_domain_clicks', $query);
    }

    public function trackingDomainShortenCounts()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/user/tracking_domain_shorten_counts', $query);
    }
}
