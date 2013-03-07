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
    /**
     * Returns the number of clicks on a single bitly link.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
     * link              - a bitly link.
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
     * link_clicks       - the number of clicks on the specified bitly link.
     * tz_offset         - the offset for the specified timezone, in hours.
     * unit              - an echo of the specified unit value.
     * units             - an echo of the specified units value.
     * unit_reference_ts - an echo of the specified unit_reference_ts value.
     *
     * @param string         $link            a bitly link.
     * @param string         $unit            minute | hour | day | week | month default:day
     * @param integer        $units           an integer representing the time units to query data for. pass -1 to return all units of time.
     * @param integer|string $timezone        an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * @param boolean        $rollup          true | false. Return data for multiple units rolled up to a single result instead of a separate value for each period of time.
     * @param integer        $limit           1..1000 (default=100)
     * @param integer        $unitReferenceTs an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     * @see http://dev.bitly.com/link_metrics.html#v3_link_clicks
     */
    public function clicks($link, $unit = 'day', $units = -1, $timezone = null, $rollup = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'link'              => $link,
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'rollup'            => $rollup,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/link/clicks', $query);
    }

    /**
     * Returns metrics about the countries referring click traffic to a single bitly link.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
     * link              - a bitly link.
     * unit              - minute | hour | day | week | month default:day
     *                     Note: when unit is minute the maximum value for units is 60
     * units             - an integer representing the time units to query data for. pass -1 to return all units of time.
     * timezone          - an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * limit             - 1..1000 (default=100)
     * unit_reference_ts - an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     *                     Note: the value of unit_reference_ts rounds to the nearest unit.
     *                     Note: historical data is stored hourly beyond the most recent 60 minutes. If a unit_reference_ts is specified, unit cannot be minute.
     *
     * Return Values
     *
     * tz_offset - the offset for the specified timezone, in hours.
     * unit      - an echo of the specified unit value.
     * units     - an echo of the specified units value.
     * countries - a list of countries referring traffic to this link. Each country returns the following fields:
     * clicks    - the number of clicks referred from this country.
     * country   - the two-letter code of the referring country.
     *
     * @param string         $link            a bitly link.
     * @param string         $unit            minute | hour | day | week | month default:day
     * @param integer        $units           an integer representing the time units to query data for. pass -1 to return all units of time.
     * @param integer|string $timezone        an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * @param integer        $limit           1..1000 (default=100)
     * @param integer        $unitReferenceTs an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     * @see http://dev.bitly.com/link_metrics.html#v3_link_countries
     */
    public function countries($link, $unit = 'day', $units = -1, $timezone = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'link'              => $link,
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/link/countries', $query);
    }

    /**
     * Returns users who have encoded this link (optionally only those in the requesting user's social graph).
     *
     * Note: Some users may not be returned from this call depending on link privacy settings.
     *
     * Parameters
     *
     * link        - a bitly link.
     * my_network  - (optional) true|false - restrict to my network
     * limit       - (optional) integer in the range 1:500 that specifies the number of records to return (default:50).
     * expand_user - (optional) true|false - include display names of encoders
     *
     * Return Values
     *
     * aggregate_link - the aggregate (global) bitly link for the provided bitly link.
     * entries        - a mapping of link, user, and ts (when the link was created)
     *
     * @param string  $link       a bitly link.
     * @param boolean $myNetwork  (optional) true|false - restrict to my network
     * @param integer $limit      (optional) integer in the range 1:500 that specifies the number of records to return (default:50).
     * @param boolean $expandUser (optional) true|false - include display names of encoders
     * @see http://dev.bitly.com/link_metrics.html#v3_link_encoders
     */
    public function encoders($link, $myNetwork = null, $limit = null, $expandUser = null)
    {
        $query = array(
            'link'        => $link,
            'my_network'  => $myNetwork,
            'limit'       => $limit,
            'expand_user' => $expandUser,
        );

        return $this->get('/link/encoders', $query);
    }

    /**
     * Returns the number of users who have shortened (encoded) a single bitly link.
     *
     * Parameters
     *
     * link - a bitly link.
     *
     * Return Values
     *
     * aggregate_link - the aggregate (global) bitly link for the provided bitly link.
     * count          - the number of bitly users who have shortened (encoded) this link.
     *
     * @param string　$link a bitly link.
     * @see http://dev.bitly.com/link_metrics.html#v3_link_encoders_count
     */
    public function encodersCount($link)
    {
        $query = array(
            'link' => $link,
        );

        return $this->get('/link/encoders_count', $query);
    }

    /**
     * Returns metrics about the pages referring click traffic to a single bitly link.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
     * link              - a bitly link.
     * unit              - minute | hour | day | week | month default:day
     *                     Note: when unit is minute the maximum value for units is 60
     * units             - an integer representing the time units to query data for. pass -1 to return all units of time.
     * timezone          - an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * limit             - 1..1000 (default=100)
     * unit_reference_ts - an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     *                     Note: the value of unit_reference_ts rounds to the nearest unit.
     *                     Note: historical data is stored hourly beyond the most recent 60 minutes. If a unit_reference_ts is specified, unit cannot be minute.
     *
     * Return Values
     *
     * tz_offset - the offset for the specified timezone, in hours.
     * unit      - an echo of the specified unit value.
     * units     - an echo of the specified units value.
     * referrers - a list of URLs referring traffic to this link. Each URL returns the following fields:
     * clicks    - the number of clicks referred from this URL.
     * referrer  - the URL referring clicks.
     *
     * @param string         $link            a bitly link.
     * @param string         $unit            minute | hour | day | week | month default:day
     * @param integer        $units           an integer representing the time units to query data for. pass -1 to return all units of time.
     * @param integer|string $timezone        an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * @param integer        $limit           1..1000 (default=100)
     * @param string         $unitReferenceTs an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     * @see http://dev.bitly.com/link_metrics.html#v3_link_referrers
     */
    public function referrers($link, $unit = 'day', $units = -1, $timezone = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'link'              => $link,
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/link/referrers', $query);
    }

    /**
     * Returns metrics about the pages referring click traffic to a single bitly link, grouped by referring domain.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
     * link              - a bitly link.
     * unit              - minute | hour | day | week | month default:day
     *                     Note: when unit is minute the maximum value for units is 60
     * units             - an integer representing the time units to query data for. pass -1 to return all units of time.
     * timezone          - an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * limit             - 1..1000 (default=100)
     * unit_reference_ts - an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     *                     Note: the value of unit_reference_ts rounds to the nearest unit.
     *                     Note: historical data is stored hourly beyond the most recent 60 minutes. If a unit_reference_ts is specified, unit cannot be minute.
     *
     * Return Values
     *
     * tz_offset - the offset for the specified timezone, in hours.
     * unit      - an echo of the specified unit value.
     * units     - an echo of the specified units value.
     * referrers - a mapping from referring domain to a list of URLs referring traffic to this link. Each URL returns the following fields:
     * clicks    - the number of clicks referred from this URL.
     * referrer  - the URL referring clicks.
     *
     * @param string         $link            a bitly link.
     * @param string         $unit            minute | hour | day | week | month default:day
     * @param integer        $units           an integer representing the time units to query data for. pass -1 to return all units of time.
     * @param integer|string $timezone        an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * @param integer        $limit           1..1000 (default=100)
     * @param string         $unitReferenceTs an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     * @see http://dev.bitly.com/link_metrics.html#v3_link_referrers_by_domain
     */
    public function referrersByDomain($link, $unit = 'day', $units = -1, $timezone = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'link'              => $link,
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/link/referrers_by_domain', $query);
    }

    /**
     * Returns metrics about the domains referring click traffic to a single bitly link.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
     * link              - a bitly link.
     * unit              - minute | hour | day | week | month default:day
     *                     Note: when unit is minute the maximum value for units is 60
     * units             - an integer representing the time units to query data for. pass -1 to return all units of time.
     * timezone          - an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * limit             - 1..1000 (default=100)
     * unit_reference_ts - an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     *                     Note: the value of unit_reference_ts rounds to the nearest unit.
     *                     Note: historical data is stored hourly beyond the most recent 60 minutes. If a unit_reference_ts is specified, unit cannot be minute.
     *
     * Return Values
     *
     * tz_offset         - the offset for the specified timezone, in hours.
     * unit              - an echo of the specified unit value.
     * units             - an echo of the specified units value.
     * referring_domains - a list of domains referring traffic to this link. Each domain returns the following fields:
     * clicks            - the number of clicks referred from this domain.
     * domain            - the domain referring clicks.
     * url               - the complete URL of the domain referring clicks.
     *
     * @param string         $link
     * @param string         $unit
     * @param integer        $units
     * @param integer|string $timezone
     * @param integer        $limit
     * @param integer        $unitReferenceTs
     * @see http://dev.bitly.com/link_metrics.html#v3_link_referring_domains
     */
    public function referringDomains($link, $unit = 'day', $units = -1, $timezone = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'link'              => $link,
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/link/referring_domains', $query);
    }

    /**
     * Returns metrics about a shares of a single link.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
     * link              - a bitly link
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
     * @see http://dev.bitly.com/link_metrics.html#v3_link_shares
     */
    public function shares($link, $unit = 'day', $units = -1, $timezone = null, $rollup = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'link'              => $link,
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'rollup'            => $rollup,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/link/shares', $query);
    }
}
