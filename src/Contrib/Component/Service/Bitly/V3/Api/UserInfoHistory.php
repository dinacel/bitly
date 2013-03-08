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
 * @see    http://dev.bitly.com/user_info.html
 */
class UserInfoHistory extends Bitly
{
    /**
     * Return or update information about a user
     *
     * Parameters
     *
     * login     - (optional) the bitly login of the user whose info to look up. If not given, the authenticated user will be used.
     * full_name - (optional) set the users full name value. (only available for the authenticated user)
     *
     * Return Values
     *
     * All requests
     *
     * login
     * profile_url    - URL of user's profile page
     * profile_image  - URL of user's profile image
     * member_since   - Unix timestamp for the moment the user signed up
     * full_name      - (optional) the user's full name, if set
     * display_name   - (optional) the user's display name, if set
     * share_accounts - (optional) a list of the share accounts (Twitter or Facebook) linked to the user's account.
     *
     * Only included in requests for a user's own info
     *
     * apiKey                    - the user's bitly API key
     * is_enterprise             - 0 or 1 to indicate if this account is signed up for bitly enterprise
     * custom_short_domain       - A short domain registered with this account that can be used in place of bit.ly for shortening links.
     * tracking_domains          - A list of domains configured for analytics tracking.
     * default_link_privacy      - public or private indicating the default privacy setting for new links
     * domain_preference_options - A list of the valid short domains that this account can choose as a default.
     *
     * Only included for enterprise accounts (is_enterprise == 1)
     *
     * sub_accounts           - (optional) list of accounts associated with this account.
     * e2e_domains            - (optional) list of domains associated with this custom_short_domain.
     * master_account         - (optional) the login of a master account, if this is associated with an enterprise account.
     * enterprise_permissions - (optional) list of enterprise permissions associated with this account
     *
     * @param string $login    (optional) the bitly login of the user whose info to look up. If not given, the authenticated user will be used.
     * @param string $fullName (optional) set the users full name value. (only available for the authenticated user)
     * @see http://dev.bitly.com/user_info.html#v3_user_info
     */
    public function info($login = null, $fullName = null)
    {
        $query = array(
            'login'     => $login,
            'full_name' => $fullName,
        );

        return $this->get('/user/info', $query);
    }

    /**
     * Returns entries from a user's link history in reverse chronological order.
     *
     * Note: Entries will be sorted by the user_ts field found in the response data.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
     * link             optional the bitly link to return metadata for (when specified, overrides all other options).
     * limit            optional integer in the range 1;100 default:50, specifying the max number of results to return.
     * offset           optional integer specifying the numbered result at which to start (for pagination).
     * created_before   optional timestamp as an integer unix epoch.
     * created_after    optional timestamp as an integer unix epoch.
     * modified_after   optional timestamp as an integer unix epoch.
     * expand_client_id optional true|false whether to provide additional information about encoding application. default: false.
     * archived         optional on|off|both whether to include or exclude archived history entries. (on = return only archived history entries) default: off
     * private          optional on|off|both whether to include or exclude private history entries. (on = return only private history entries) default: both
     * user             optional the user for whom to retrieve history entries (if different from authenticated user).
     *
     * Return Values
     *
     * result_count - the number of returned links in this user's history.
     * link_history - the specified user's links. Each link returns:
     *   link           - the bitly link specific to this user and this long_url.
     *   aggregate_link - the global bitly identifier for this long_url.
     *   long_url       - the original long URL.
     *   archived       - a true/false value indicating whether the user has archived this link.
     *   private        - a true/false value indicating whether the user has made this link private.
     *   created_at     - an integer unix epoch indicating when this link was shortened/encoded.
     *   user_ts        - a user-provided timestamp for when this link was shortened/encoded, used for backfilling data.
     *   modified_at    - an integer unix epoch indicating when this link's metadata was last edited.
     *   title          - the title for this link.
     *   shares         - a list of share actions (for the authenticated user only)
     *   client_id      - the oauth client ID of the app that shortened/saved this link on behalf of the user. If expand_client_id is set to false, this will be a string corresponding to the client_id of the encoding oauth application. If expand_client_id is set to true, this will be a mapping containing the following fields:
     *     client_id       - a string corresponding to the client_id of the encoding oauth application.
     *     app_link        - the link for the encoding oauth application.
     *     app_name        - the name of the encoding oauth application.
     *     app_description - a description of the encoding oauth application.
     *
     * @param string  $link           optional the bitly link to return metadata for (when specified, overrides all other options).
     * @param integer $limit          optional integer in the range 1;100 default:50, specifying the max number of results to return.
     * @param integer $offset         optional integer specifying the numbered result at which to start (for pagination).
     * @param integer $createdBefore  optional timestamp as an integer unix epoch.
     * @param integer $createdAfter   optional timestamp as an integer unix epoch.
     * @param integer $modifiedAfter  optional timestamp as an integer unix epoch.
     * @param boolean $expandClientId optional true|false whether to provide additional information about encoding application. default: false.
     * @param string  $archived       optional on|off|both whether to include or exclude archived history entries. (on = return only archived history entries) default: off
     * @param string  $private        optional on|off|both whether to include or exclude private history entries. (on = return only private history entries) default: both
     * @param string  $user           optional the user for whom to retrieve history entries (if different from authenticated user).
     * @see http://dev.bitly.com/user_info.html#v3_user_link_history
     */
    public function linkHistory($link = null, $limit = null, $offset = null, $createdBefore = null, $createdAfter = null, $modifiedAfter = null, $expandClientId = null, $archived = null, $private = null, $user = null)
    {
        $query = array(
            'link'           => $link,
            'limit'          => $limit,
            'offset'         => $offset,
            'created_before' => $createdBefore,
            'created_after'  => $createdAfter,
            'modified_after' => $modifiedAfter,
            'archived'       => $archived,
            'private'        => $private,
            'user'           => $user,
        );

        return $this->get('/user/link_history', $query);
    }

    /**
     * Returns entries from a user's network history in reverse chronogical order. (A user's network history includes publicly saved links from Twitter and Facebook connections.)
     *
     * Authentication: oauth2
     *
     * Parameters
     *
     * offset           - optional integer that specifies the first record to return.
     * expand_client_id - optional true|false whether to provide additional information about encoding application. default: false.
     * limit            - optional integer in the range 1;100 that specifies the number of records to return (default:20).
     * expand_user      - optional - true|false - include extra user info in response (login, avatar_url, display_name, profile_url, full_name).
     *
     * Return Values
     *
     * total   - the total number of network history results returned.
     * limit   - an echo back of the limit parameter.
     * offset  - an echo back of the offset parameter.
     * entries - the returned network history links. Each link includes:
     *   global_hash - the global (aggregate) identifier of this link.
     *   saves       - information about each time this link has been publicly saved by bitly users followed by the authenticated user. Each save returns:
     *     link           - the bitly link specific to this user and this long_url.
     *     aggregate_link - the global bitly identifier for this long_url.
     *     long_url       - the original long URL.
     *     user           - the bitly user who saved this link.
     *     archived       - a true/false value indicating whether the user has archived this link.
     *     private        - a true/false value indicating whether the user has made this link private.
     *     created_at     - an integer unix epoch indicating when this link was shortened/encoded.
     *     user_ts        - a user-provided timestamp for when this link was shortened/encoded, used for backfilling data.
     *     modified_at    - an integer unix epoch indicating when this link's metadata was last edited.
     *     title          - the title for this link.
     *     client_id      - the oauth client ID of the app that shortened/saved this link on behalf of the user. If expand_client_id is set to false, this will be a string corresponding to the client_id of the encoding oauth application. If expand_client_id is set to true, this will be a mapping containing the following fields:
     *       client_id       - a string corresponding to the client_id of the encoding oauth application.
     *       app_link        - the link for the encoding oauth application.
     *       app_name        - the name of the encoding oauth application.
     *       app_description - a description of the encoding oauth application.
     *
     * @param integer $offset
     * @param boolean $expandClientId
     * @param integer $limit
     * @param boolean $expandUser
     * @see http://dev.bitly.com/user_info.html#v3_user_network_history
     */
    public function networkHistory($offset = null, $expandClientId = null, $limit = null, $expandUser = null)
    {
        $query = array(
            'offset'           => $offset,
            'expand_client_id' => $expandClientId,
            'limit'            => $limit,
            'expand_user'      => $expandUser,
        );

        return $this->get('/user/network_history', $query);
    }

    /**
     * Returns a list of tracking domains a user has configured.
     *
     * Return Values
     *
     * tracking_domains - a list of tracking domains configured for the authenticated user.
     *
     * @see http://dev.bitly.com/user_info.html#v3_user_tracking_domain_list
     */
    public function trackingDomainList()
    {
        return $this->get('/user/tracking_domain_list');
    }
}
