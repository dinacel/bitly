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
    /**
     * Returns the aggregate number of clicks on all of the authenticated user's bitly links.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
     * unit              - minute | hour | day | week | month default:day
     *                     Note: when unit is minute the maximum value for units is 60
     * units             - an integer representing the time units to query data for. pass -1 to return all units of time.
     * timezone          - an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * rollup            - true | false. Return data for multiple units rolled up to a single result instead of a separate value for each period of time.
     * limit             - 1..1000 (default=100)
     * unit_reference_ts - an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     *                     Note: the value of unit_reference_ts rounds to the nearest unit.
     *                     Note: historical data is stored hourly beyond the most recent 60 minutes. If a unit_reference_ts is specified, unit cannot be minute.

     * Note: without the parameter unit this endpoint returns a legacy response format which assumes rollup=false, unit=day and units=7.
     *
     * Return Values
     *
     * tz_offset - the offset for the specified timezone, in hours.
     * unit - an echo of the specified unit value.
     * units - an echo of the specified units value.
     * days - the number of days for which data is provided (ONLY returned if unit is not specified).
     * user_clicks - the number of clicks on this user's links. If rollup = false, the following values are returned for each specified unit:
     * dt: a unix timestamp representing the beginning of this unit.
     * day_start: a unix timestamp representing the beginning of the specified day (ONLY returned if unit is not specified).
     * clicks: the number of clicks on this user's links in the specified timeframe.
     *
     * @param string         $unit            minute | hour | day | week | month default:day
     * @param integer        $units           an integer representing the time units to query data for. pass -1 to return all units of time.
     * @param integer|string $timezone        an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * @param boolean        $rollup          true | false. Return data for multiple units rolled up to a single result instead of a separate value for each period of time.
     * @param integer        $limit           1..1000 (default=100)
     * @param integer        $unitReferenceTs an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     * @see http://dev.bitly.com/user_metrics.html#v3_user_clicks
     */
    public function clicks($unit = 'day', $units = -1, $timezone = null, $rollup = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'rollup'            => $rollup,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/usr/clicks', $query);
    }

    /**
     * Returns aggregate metrics about the countries referring click traffic to all of the authenticated user's bitly links.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
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
     * Note: without the parameter unit this endpoint returns a legacy response format which assumes rollup=false, unit=day and units=7. When a unit is specified, rollup is always true.
     *
     * Return Values
     *
     * tz_offset - the offset for the specified timezone, in hours.
     * unit      - an echo of the specified unit value.
     * units     - an echo of the specified units value.
     * days      - the number of days for which data is provided (ONLY returned if unit is not specified).
     * countries - a list of countries referring traffic to this user's links. Each country returns the following fields:
     * clicks    - the number of clicks referred from this country.
     * country   - the two-letter code of the referring country.
     *
     * @param string         $unit            minute | hour | day | week | month default:day
     * @param integer        $units           an integer representing the time units to query data for. pass -1 to return all units of time.
     * @param integer|string $timezone        an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * @param boolean        $rollup          true | false. Return data for multiple units rolled up to a single result instead of a separate value for each period of time.
     * @param integer        $limit           1..1000 (default=100)
     * @param integer        $unitReferenceTs an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     * @see http://dev.bitly.com/user_metrics.html#v3_user_countries
     */
    public function countries($unit = 'day', $units = -1, $timezone = null, $rollup = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'rollup'            => $rollup,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/usr/countries', $query);
    }

    /**
     * Returns the authenticated user's most-clicked bitly links (ordered by number of clicks) in a given time period.
     *
     * Note: This replaces the realtime_links endpoint.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
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
     * tz_offset     - the offset for the specified timezone, in hours.
     * unit          - an echo of the specified unit value.
     * units         - an echo of the specified units value.
     * popular_links - the links that have received click traffic in the specified timeframe. Each link returns:
     * link          - a bitly link.
     * clicks        - the number of clicks on that bitly link in the specified timeframe.
     *
     * @param string         $unit            minute | hour | day | week | month default:day
     * @param integer        $units           an integer representing the time units to query data for. pass -1 to return all units of time.
     * @param integer|string $timezone        an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * @param integer        $limit           1..1000 (default=100)
     * @param integer        $unitReferenceTs an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     * @see http://dev.bitly.com/user_metrics.html#v3_user_popular_links
     */
    public function popularLinks($unit = 'day', $units = -1, $timezone = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/usr/popular_links', $query);
    }

    /**
     * Returns aggregate metrics about the pages referring click traffic to all of the authenticated user's bitly links.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
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
     * Note: without the parameter unit this endpoint returns a legacy response format which assumes rollup=false, unit=day and units=7. When a unit is specified, rollup is always true.
     *
     * Return Values
     *
     * tz_offset - the offset for the specified timezone, in hours.
     * unit      - an echo of the specified unit value.
     * units     - an echo of the specified units value.
     * days      - the number of days for which data is provided (ONLY returned if unit is not specified).
     * referrers - a list of URLs referring traffic to this user's links. Each URL returns the following fields:
     * clicks    - the number of clicks referred from this URL.
     * referrer  - the URL referring clicks.
     *
     * @param string         $unit            minute | hour | day | week | month default:day
     * @param integer        $units           an integer representing the time units to query data for. pass -1 to return all units of time.
     * @param integer|string $timezone        an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * @param boolean        $rollup          true | false. Return data for multiple units rolled up to a single result instead of a separate value for each period of time.
     * @param integer        $limit           1..1000 (default=100)
     * @param integer        $unitReferenceTs an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     * @see http://dev.bitly.com/user_metrics.html#v3_user_referrers
     */
    public function referrers($unit = 'day', $units = -1, $timezone = null, $rollup = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'rollup'            => $rollup,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/usr/referrers', $query);
    }

    /**
     * Returns aggregate metrics about the domains referring click traffic to all of the authenticated user's bitly links.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
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
     * Note: without the parameter unit this endpoint returns a legacy response format which assumes rollup=false, unit=day and units=7. When a unit is specified, rollup is always true.
     *
     * Return Values
     *
     * tz_offset         - the offset for the specified timezone, in hours.
     * unit              - an echo of the specified unit value.
     * units             - an echo of the specified units value.
     * days              - the number of days for which data is provided (ONLY returned if unit is not specified).
     * referring_domains - a list of domains referring traffic to this user's links. Each domain returns the following fields:
     * clicks            - the number of clicks referred from this domain.
     * domain            - the domain referring clicks.
     * url               - the complete URL of the domain referring clicks.
     *
     * @param string         $unit            minute | hour | day | week | month default:day
     * @param integer        $units           an integer representing the time units to query data for. pass -1 to return all units of time.
     * @param integer|string $timezone        an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * @param boolean        $rollup          true | false. Return data for multiple units rolled up to a single result instead of a separate value for each period of time.
     * @param integer        $limit           1..1000 (default=100)
     * @param integer        $unitReferenceTs an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     * @see http://dev.bitly.com/user_metrics.html#v3_user_referring_domains
     */
    public function referringDomains($unit = 'day', $units = -1, $timezone = null, $rollup = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'rollup'            => $rollup,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/usr/referring_domains', $query);
    }

    /**
     * Returns the number of shares by the authenticated user in a given time period.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
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
     * tz_offset    - the offset for the specified timezone, in hours.
     * unit         - an echo of the specified unit value.
     * units        - an echo of the specified units value.
     * share_counts - the number of shares from this user's account. If rollup=false, returns timeseries data per unit:
     * dt           - timestamp corresponding to the specified unit.
     * shares       - the number of shares in that timeframe.
     *
     * @param string         $unit            minute | hour | day | week | month default:day
     * @param integer        $units           an integer representing the time units to query data for. pass -1 to return all units of time.
     * @param integer|string $timezone        an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * @param boolean        $rollup          true | false. Return data for multiple units rolled up to a single result instead of a separate value for each period of time.
     * @param integer        $limit           1..1000 (default=100)
     * @param integer        $unitReferenceTs an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     * @see http://dev.bitly.com/user_metrics.html#v3_user_share_counts
     */
    public function shareCounts($unit = 'day', $units = -1, $timezone = null, $rollup = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'rollup'            => $rollup,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/usr/share_counts', $query);
    }

    /**
     * Returns the number of shares by the authenticated user, broken down by share type (ie: twitter, facebook, email) in a given time period.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
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
     * tz_offset                  - the offset for the specified timezone, in hours.
     * unit                       - an echo of the specified unit value.
     * units                      - an echo of the specified units value.
     * share_counts_by_share_type - the number of shares from this user's account for each share_type. Each type of share returns:
     * dt                         - timestamp corresponding to the specified unit. Included in timeseries response only if rollup=false.
     * share_type                 - the type of share (twitter, email, facebook).
     * shares                     - the number of shares of the specified type in that timeframe.
     *
     * @param string         $unit            minute | hour | day | week | month default:day
     * @param integer        $units           an integer representing the time units to query data for. pass -1 to return all units of time.
     * @param integer|string $timezone        an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * @param boolean        $rollup          true | false. Return data for multiple units rolled up to a single result instead of a separate value for each period of time.
     * @param integer        $limit           1..1000 (default=100)
     * @param integer        $unitReferenceTs an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     * @see http://dev.bitly.com/user_metrics.html#v3_user_share_counts_by_share_type
     */
    public function shareCountsByShareType($unit = 'day', $units = -1, $timezone = null, $rollup = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'rollup'            => $rollup,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/usr/share_counts_by_share_type', $query);
    }

    /**
     * Returns the number of links shortened (encoded) in a given time period by the authenticated user.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
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
     * tz_offset           - the offset for the specified timezone, in hours.
     * unit                - an echo of the specified unit value.
     * units               - an echo of the specified units value.
     * user_shorten_counts - the number of shortens made by the specified user in the specified time.
     *
     * @param string         $unit            minute | hour | day | week | month default:day
     * @param integer        $units           an integer representing the time units to query data for. pass -1 to return all units of time.
     * @param integer|string $timezone        an integer hour offset from UTC (-14..14), or a timezone string default:America/New_York.
     * @param boolean        $rollup          true | false. Return data for multiple units rolled up to a single result instead of a separate value for each period of time.
     * @param integer        $limit           1..1000 (default=100)
     * @param integer        $unitReferenceTs an epoch timestamp, indicating the most recent time for which to pull metrics. default:now
     * @see http://dev.bitly.com/user_metrics.html#v3_user_shorten_counts
     */
    public function shortenCounts($unit = 'day', $units = -1, $timezone = null, $rollup = null, $limit = null, $unitReferenceTs = null)
    {
        $query = array(
            'unit'              => $unit,
            'units'             => $units,
            'timezone'          => $timezone,
            'rollup'            => $rollup,
            'limit'             => $limit,
            'unit_reference_ts' => $unitReferenceTs,
        );

        return $this->get('/usr/shorten_counts', $query);
    }
}
