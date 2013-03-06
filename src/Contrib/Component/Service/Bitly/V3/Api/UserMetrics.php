<?php
namespace Contrib\Component\Service\Bitly\V3\Api;

/**
 * User Metrics API.
 *
 * /v3/user/clicks
 * /v3/user/countries
 * /v3/user/popular_links
 * /v3/user/referrers
 * /v3/user/referring_domains
 * /v3/user/share_counts
 * /v3/user/share_counts_by_share_type
 * /v3/user/shorten_counts
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class UserMetrics extends Bitly
{
    public function clicks()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/usr/clicks', $query);
    }

    public function countries()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/usr/countries', $query);
    }

    public function popularLinks()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/usr/popular_links', $query);
    }

    public function referrers()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/usr/referrers', $query);
    }

    public function referringDomains()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/usr/referring_domains', $query);
    }

    public function shareCounts()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/usr/share_counts', $query);
    }

    public function shareCountsByShareType()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/usr/share_counts_by_share_type', $query);
    }

    public function shortenCounts()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/usr/shorten_counts', $query);
    }
}
