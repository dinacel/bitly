<?php
namespace Contrib\Component\Service\Bitly\V3\Api;

/**
 * Link Metrics API.
 *
 * /v3/link/clicks
 * /v3/link/countries
 * /v3/link/encoders
 * /v3/link/encoders_count
 * /v3/link/referrers
 * /v3/link/referrers_by_domain
 * /v3/link/referring_domains
 * /v3/link/shares
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class LinkMetrics extends Bitly
{
    public function clicks()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/link/clicks', $query);
    }

    public function countries()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/link/countries', $query);
    }

    public function encoders()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/link/encoders', $query);
    }

    public function encodersCount()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/link/encoders_count', $query);
    }

    public function referrers()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/link/referrers', $query);
    }

    public function referrersByDomain()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/link/referrers_by_domain', $query);
    }

    public function referringDomains()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/link/referring_domains', $query);
    }

    public function shares()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/link/shares', $query);
    }
}
