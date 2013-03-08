<?php
namespace Contrib\Component\Service\Bitly\V3\Api;

/**
 * Links API.
 *
 * /v3/expand
 * /v3/info
 * /v3/link/lookup
 * /v3/shorten
 * /v3/user/link_edit
 * /v3/user/link_lookup
 * /v3/user/link_save
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 * @see    http://dev.bitly.com/links.html
 */
class Links extends Bitly
{
    /**
     * Given a bitly URL or hash (or multiple), returns the target (long) URL.
     *
     * Authentication: oauth2 / api key
     *
     * Parameters
     *
     * shortUrl - refers to one or more bitly links. e.g.: http://bit.ly/1RmnUT or http://j.mp/1RmnUT
     * hash     - refers to one or more bitly hashes. e.g.: 2bYgqR or a-custom-name
     *
     * Note
     *
     * Either shortUrl or hash must be given as a parameter
     * The maximum number of shortUrl and hash parameters is 15
     *
     * Return Values
     *
     * short_url   - an echo back of the shortUrl request parameter.
     * hash        - an echo back of the hash request parameter.
     * user_hash   - the corresponding bitly user identifier.
     * global_hash - the corresponding bitly aggregate identifier.
     * error       - indicates there was an error retrieving data for a given shortUrl or hash. An example error is "NOT_FOUND".
     * long_url    - the URL that the requested short_url or hash points to.
     *
     * @param string|string[] $shortUrl refers to one or more bitly links. e.g.: http://bit.ly/1RmnUT or http://j.mp/1RmnUT
     * @param string|string[] $hash     refers to one or more bitly hashes. e.g.: 2bYgqR or a-custom-name
     * @see http://dev.bitly.com/links.html#v3_expand
     */
    public function expand($shortUrl, $hash)
    {
        $query = array(
            'shortUrl' => $shortUrl,
            'hash'     => $hash,
        );

        return $this->get('/expand', $query);
    }

    /**
     * This is used to return the page title for a given bitly link.
     *
     * Parameters
     *
     * shortUrl    - refers to one or more bitly links e.g.: http://bit.ly/1RmnUT or http://j.mp/1RmnUT
     * hash        - optional refers to one or more bitly hashes, (e.g.: 2bYgqR or a-custom-name ).
     * expand_user - optional true|false - include extra user info in response
     *
     * Return Values
     *
     * short_url   - this is an echo back of the shortUrl request parameter.
     * hash        - this is an echo back of the hash request parameter.
     * user_hash   - the corresponding bitly user identifier.
     * global_hash - the corresponding bitly aggregate identifier.
     * error       - indicates there was an error retrieving data for a given shortUrl or hash. An example error is "NOT_FOUND".
     * title       - the HTML page title for the destination page (when available).
     * created_by  - the bitly username that originally shortened this link, if the link is public. Otherwise, null.
     * created_at  - the epoch timestamp when this bitly link was created
     *
     * @param string|string[] $shortUrl   refers to one or more bitly links e.g.: http://bit.ly/1RmnUT or http://j.mp/1RmnUT
     * @param string|string[] $hash       optional refers to one or more bitly hashes, (e.g.: 2bYgqR or a-custom-name ).
     * @param boolean         $expandUser optional true|false - include extra user info in response
     * @see http://dev.bitly.com/links.html#v3_info
     */
    public function info($shortUrl, $hash = null, $expandUser = null)
    {
        $query = array(
            'shortUrl'    => $shortUrl,
            'hash'        => $hash,
            'expand_user' => $expandUser
        );

        return $this->get('/info', $query);
    }

    /**
     * This is used to query for a bitly link based on a long URL.
     *
     * Parameters
     *
     * url - one or more long URLs to lookup
     *
     * Return Values
     *
     * url            - an echo back of the url parameter.
     * aggregate_link - the corresponding bitly aggregate link (global hash).
     *
     * @param string|string[] $url one or more long URLs to lookup
     * @see http://dev.bitly.com/links.html#v3_link_lookup
     */
    public function lookup($url)
    {
        $query = array(
            'url' => $url,
        );

        return $this->get('/link/lookup', $query);
    }

    /**
     * Given a long URL, returns a bitly short URL.
     *
     * Authentication: oauth2 / api key
     *
     * Parameters
     *
     * longUrl - a long URL to be shortened (example: http://betaworks.com/).
     * domain  - (optional) refers to a preferred domain; either bit.ly, j.mp, or bitly.com, for users who do NOT have a custom short domain set up with bitly. This affects the output value of url. The default for this parameter is the short domain selected by each user in his/her bitly account settings. Passing a specific domain via this parameter will override the default settings for users who do NOT have a custom short domain set up with bitly. For users who have implemented a custom short domain, bitly will always return short links according to the user's account-level preference.
     *
     * Notes
     *
     * Long URLs should be URL-encoded. You can not include a longUrl in the request that has &, ?, #, or other reserved parameters without first encoding it.
     * Long URLs should not contain spaces: any longUrl with spaces will be rejected. All spaces should be either percent encoded %20 or plus encoded +. Note that tabs, newlines and trailing spaces are all indications of errors. Please remember to strip leading and trailing whitespace from any user input before shortening.
     * Long URLs must have a slash between the domain and the path component. For example, http://example.com?query=parameter is invalid, and instead should be formatted as http://example.com/?query=parameter
     * The default value for the domain parameter is selected by each user from within his/her bitly account settings at http://bitly.com/a/account
     *
     * Return Values
     *
     * new_hash    - designates if this is the first time this long_url was shortened by this user. The return value will equal 1 the first time a long_url is shortened. It will also then be added to the user history.
     * url         - the actual link that should be used, and is a unique value for the given bitly account.
     * hash        - a bitly identifier for long_url which is unique to the given account.
     * global_hash - a bitly identifier for long_url which can be used to track aggregate stats across all bitly links that point to the same long_url.
     * long_url    - an echo back of the longUrl request parameter. This may not always be equal to the URL requested, as some URL normalization may occur (e.g., due to encoding differences, or case differences in the domain). This long_url will always be functionally identical the the request parameter.
     * When the output format is txt, the only response is the short url.
     *
     * @param string $longurl a long URL to be shortened (example: http://betaworks.com/).
     * @param string $domain  (optional) refers to a preferred domain; either bit.ly, j.mp, or bitly.com, for users who do NOT have a custom short domain set up with bitly. This affects the output value of url. The default for this parameter is the short domain selected by each user in his/her bitly account settings. Passing a specific domain via this parameter will override the default settings for users who do NOT have a custom short domain set up with bitly. For users who have implemented a custom short domain, bitly will always return short links according to the user's account-level preference.
     * @see http://dev.bitly.com/links.html#v3_shorten
     */
    public function shorten($longurl, $domain = null)
    {
        $query = array(
            'longUrl' => $longurl,
            'domain'  => $domain
        );

        return $this->get('/shorten', $query);
    }

    /**
     * Changes link metadata in a user's history.
     *
     * Authentication: oauth2
     *
     * Parameters
     *
     * link     - the bitly link to be edited.
     * edit     - a comma separated string of fields to be edited. ie: to edit the note field you also need to pass edit=note.
     * title    - optional the title of this bitmark.
     * note     - optional a description of, or note about, this bitmark.
     * private  - optional boolean true or false indicating privacy setting (defaults to user-level setting).
     * user_ts  - optional timestamp as an integer epoch.
     * archived - optional boolean true or false indicating whether or not link is to be archived.
     *
     * Notes
     *
     * Any fields specified in the edit parameter are required.
     * Because link metadata is modified asynchronously, it may take a few moments for changes made via this API method to update.
     *
     * Return Values
     *
     * link - an echo back of the edited bitly link.
     *
     * @param string   $link     the bitly link to be edited.
     * @param string[] $edit     a comma separated string of fields to be edited. ie: to edit the note field you also need to pass edit=note.
     * @param string   $title    optional the title of this bitmark.
     * @param string   $note     optional a description of, or note about, this bitmark.
     * @param boolean  $private  optional boolean true or false indicating privacy setting (defaults to user-level setting).
     * @param integer  $userTs   optional timestamp as an integer epoch.
     * @param boolean  $archived optional boolean true or false indicating whether or not link is to be archived.
     * @see http://dev.bitly.com/links.html#v3_user_link_edit
     */
    public function linkEdit($link, array $edit, $title = null, $note = null, $private = null, $userTs = null, $archived = null)
    {
        $query = array(
            'link'     => $link,
            'edit'     => implode(',', $edit),
            'title'    => $title,
            'note'     => $note,
            'private'  => $private,
            'user_ts'  => $userTs,
            'archived' => $archived,
        );

        return $this->get('/user/link_edit', $query);
    }

    /**
     * This is used to query for a bitly link shortened by the authenticated user based on a long URL.
     *
     * Parameters
     *
     * url - one or more long URLs to lookup
     *
     * Return Values
     *
     * url            - an echo back of the url parameter.
     * link           - the corresponding bitly link (short URL).
     * aggregate_link - the corresponding bitly aggregate link (global hash).
     *
     * @param string|string[] $url one or more long URLs to lookup
     * @see http://dev.bitly.com/links.html#v3_user_link_lookup
     */
    public function linkLookup($url)
    {
        $query = array(
            'url' => $url
        );

        return $this->get('/user/link_lookup', $query);
    }

    /**
     * Saves a link as a bitmark in a user's history, with optional pre-set metadata. (Also returns a short URL for that link.)
     *
     * Authentication: oauth2
     *
     * Parameters
     *
     * longUrl - the URL to be saved as a bitmark.
     * title   - optional the title of this bitmark.
     * note    - optional a description of, or note about, this bitmark.
     * private - optional boolean true or false indicating privacy setting (defaults to user-level setting).
     * user_ts - optional timestamp as an integer epoch.
     *
     * Notes
     *
     * Long URLs should be URL-encoded. You can not include a longUrl in the request that has &, ?, #, or other reserved parameters without first encoding it.
     * Long URLs should not contain spaces: any longUrl with spaces will be rejected. All spaces should be either percent encoded %20 or plus encoded +. Note that tabs, newlines and trailing spaces are all indications of errors. Please remember to strip leading and trailing whitespace from any user input before saving.
     * Long URLs must have a slash between the domain and the path component. For example, http://example.com?query=parameter is invalid, and instead should be formatted as http://example.com/?query=parameter
     *
     * Return Values
     *
     * link           - the bitly short URL for the provided longUrl, specific to this user.
     * aggregate_link - a bitly short URL for the provided longUrl, which can be used to track aggregate stats across all bitly links that point to the same longUrl.
     * new_link       - returns 1 if the authenticated user is saving this link for the first time, 0 if the user has previously saved it.
     * long_url an echo back of the longUrl request parameter. This may not always be equal to the URL requested, as some URL normalization may occur (e.g., due to encoding differences, or case differences in the domain). This long_url will always be functionally identical the the request parameter.
     *
     * @param string  $longUrl the URL to be saved as a bitmark.
     * @param string  $title   optional the title of this bitmark.
     * @param string  $note    optional a description of, or note about, this bitmark.
     * @param boolean $private optional boolean true or false indicating privacy setting (defaults to user-level setting).
     * @param integer $userTs  optional timestamp as an integer epoch.
     * @see http://dev.bitly.com/links.html#v3_user_link_save
     */
    public function linkSave($longUrl, $title = null, $note = null, $private = null, $userTs = null)
    {
        $query = array(
            'longUrl' => $longUrl,
            'title'   => $title,
            'note'    => $note,
            'private' => $private,
            'user_ts' => $userTs,
        );

        return $this->get('/user/link_save', $query);
    }
}
