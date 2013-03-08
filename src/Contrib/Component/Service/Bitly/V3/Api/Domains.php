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
 * @see    http://dev.bitly.com/domains.html
 */
class Domains extends Bitly
{
    /**
     * Query whether a given domain is a valid bitly pro domain. Keep in mind that bitly custom short domains are restricted to less than 15 characters in length.
     *
     * Parameters
     *
     * domain - A short domain. ie: nyti.ms.
     *
     * Return Values
     *
     * bitly_pro_domain - 0 or 1 designating whether this is a current bitly domain.
     * domain           - an echo back of the request parameter.
     *
     * @param string $domain A short domain. ie: nyti.ms.
     * @see http://dev.bitly.com/domains.html#v3_bitly_pro_domain
     */
    public function bitlyProDomain($domain)
    {
        $query = array(
            'domain' => $domain,
        );

        return $this->get('/bitly_pro_domain', $query);
    }

    /**
     * Returns the number of clicks on bitly links pointing to the specified tracking domain that have occured in a given time period.
     *
     * Users can register a tracking domain from their bitly settings page
     *
     * Authentication: oauth2
     *
     * Errors
     *
     * 500, TRACKING_DOMAIN_NOT_REGISTERED
     *
     * Parameters
     *
     * domain            - a tracking domain as returned from /v3/user/tracking_domain_list
     * unit              - minute | hour | day | week | month default:day
     *                     Note: when unit is minute the maximum value for units is 60
     * units             - an integer representing the time units to query data for. pass -1 to return all units of time.
     * timezone          - an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * rollup            - true | false. Return data for multiple units rolled up to a single result instead of a separate value for each period of time.
     * limit             - 1..1000 (default=100)
     * unit_reference_ts - an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     *                     Note: the value of unit_reference_ts rounds to the nearest unit.
     *                     Note: historical data is stored hourly beyond the most recent 60 minutes. If a unit_reference_ts is specified, unit cannot be minute.
     *
     * Return Values
     *
     * tz_offset              - the offset for the specified timezone, in hours.
     * unit                   - an echo of the specified unit value.
     * units                  - an echo of the specified units value.
     * tracking_domain_clicks - the number of the number of clicks on bitly links pointing to the specified tracking domain in the specified time.
     *
     * @param string         $domain          a tracking domain as returned from /v3/user/tracking_domain_list
     * @param string         $unit            minute | hour | day | week | month default:day
     * @param integer        $units           an integer representing the time units to query data for. pass -1 to return all units of time.
     * @param integer|string $timezone        an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * @param boolean        $rollup          true | false. Return data for multiple units rolled up to a single result instead of a separate value for each period of time.
     * @param integer        $limit           1..1000 (default=100)
     * @param integer        $unitReferenceTs an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     * @see http://dev.bitly.com/domains.html#v3_user_tracking_domain_clicks
     */
    public function trackingDomainClicks($domain, $unit = 'day', $units = -1, $timezone = null, $rollup = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'domain'            => $domain,
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'rollup'            => $rollup,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/user/tracking_domain_clicks', $query);
    }

    /**
     * Returns the number of links, pointing to a specified tracking domain, shortened (encoded) in a given time period by all bitly users.
     *
     * Users can register a tracking domain from their bitly settings page
     *
     * Authentication: oauth2
     *
     * Errors
     *
     * 500, TRACKING_DOMAIN_NOT_REGISTERED
     *
     * Parameters
     *
     * domain            - a tracking domain as returned from /v3/user/tracking_domain_list
     * unit              - minute | hour | day | week | month default:day
     *                     Note: when unit is minute the maximum value for units is 60
     * units             - an integer representing the time units to query data for. pass -1 to return all units of time.
     * timezone          - an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * rollup            - true | false. Return data for multiple units rolled up to a single result instead of a separate value for each period of time.
     * limit             - 1..1000 (default=100)
     * unit_reference_ts - an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     *                     Note: the value of unit_reference_ts rounds to the nearest unit.
     *                     Note: historical data is stored hourly beyond the most recent 60 minutes. If a unit_reference_ts is specified, unit cannot be minute.
     *
     * Return Values
     *
     * tz_offset                      - the offset for the specified timezone, in hours.
     * unit                           - an echo of the specified unit value.
     * units                          - an echo of the specified units value.
     * tracking_domain_shorten_counts - the number of links to the specified tracking domain shortened (encoded) by all bitly users in the specified time.
     *
     * @param string         $domain          a tracking domain as returned from /v3/user/tracking_domain_list
     * @param string         $unit            minute | hour | day | week | month default:day
     * @param integer        $units           an integer representing the time units to query data for. pass -1 to return all units of time.
     * @param integer|string $timezone        an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * @param boolean        $rollup          true | false. Return data for multiple units rolled up to a single result instead of a separate value for each period of time.
     * @param integer        $limit           1..1000 (default=100)
     * @param integer        $unitReferenceTs an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     * @see http://dev.bitly.com/domains.html#v3_user_tracking_domain_shorten_counts
     */
    public function trackingDomainShortenCounts($domain, $unit = 'day', $units = -1, $timezone = null, $rollup = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'domain'            => $domain,
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'rollup'            => $rollup,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/user/tracking_domain_shorten_counts', $query);
    }
}
