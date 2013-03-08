<?php
namespace Contrib\Component\Service\Bitly\V3\Api;

/**
 * Bundles API.
 *
 * /v3/bundle/archive
 * /v3/bundle/bundles_by_user
 * /v3/bundle/clone
 * /v3/bundle/collaborator_add
 * /v3/bundle/collaborator_remove
 * /v3/bundle/contents
 * /v3/bundle/create
 * /v3/bundle/edit
 * /v3/bundle/link_add
 * /v3/bundle/link_comment_add
 * /v3/bundle/link_comment_edit
 * /v3/bundle/link_comment_remove
 * /v3/bundle/link_edit
 * /v3/bundle/link_remove
 * /v3/bundle/link_reorder
 * /v3/bundle/pending_collaborator_remove
 * /v3/bundle/reorder
 * /v3/bundle/view_count
 * /v3/user/bundle_history
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 * @see    http://dev.bitly.com/bundles.html
 */
class Bundles extends Bitly
{
    /**
     * Archive a bundle for the authenticated user. Only a bundle's owner is allowed to archive a bundle.
     *
     * Parameters
     *
     * bundle_link - the URL corresponding to the bundle to be archived.
     *
     * @param string $bundleLink the URL corresponding to the bundle to be archived.
     * @see http://dev.bitly.com/bundles.html#v3_bundle_archive
     */
    public function archive($bundleLink)
    {
        $query = array(
            'bundle_link' => $bundleLink,
        );

        return $this->get('/bundle/archive', $query);
    }

    /**
     * Returns a list of public bundles created by a user
     *
     * Parameters
     *
     * user        - the user to get a list of bundles for.
     * expand_user - optional - true|false - include extra user info in response
     *
     * @param string  $user       the user to get a list of bundles for.
     * @param boolean $expandUser optional - true|false - include extra user info in response
     * @see http://dev.bitly.com/bundles.html#v3_bundle_bundles_by_user
     */
    public function bundlesByUser($user, $expandUser = null)
    {
        $query = array(
            'user'        => $user,
            'expand_user' => $expandUser,
        );

        return $this->get('/bundle/bundles_by_user', $query);
    }

    /**
     * Clone a bundle for the authenticated user.
     *
     * Parameters
     *
     * bundle_link - the URL of the bundle to clone.
     *
     * Return Values
     *
     * bundle_owner:     the bitly user who owns this bundle (the authenticated user on whose behalf the bundle was created).
     * created_ts:       a timestamp representing the time at which this bundle was created.
     * description:      a description of this bundle.
     * bundle_link:      a URL pointing directly to this bundle.
     * last_modified_ts: a timestamp representing the last time this bundle was modified.
     * private:          a true/false value indicating whether this bundle is set to be private.
     * links:            the links in the bundle. Each link returns the following fields:
     *   aggregate_link: the global bitly link for the specified long_url, which can be used to track aggregate stats across all matching bitly links.
     *   link:           the bitly link for the specified long_url, unique to this user's account.
     *   description:    a description of this link.
     *   title:          the title of this link, automatically populated from the destination page title and editable with the /v3/bundle/link_edit endpoint.
     *   long_url:       the destination long URL for this link.
     *   display_order:  the order in which this link will display, starting with 0 for the link to be displayed first.
     *
     * @param string $bundleLink the URL of the bundle to clone.
     * @see http://dev.bitly.com/bundles.html#v3_bundle_clone
     */
    public function cloneBundle($bundleLink)
    {
        $query = array(
            'bundle_link' => $bundleLink,
        );

        return $this->get('/bundle/clone', $query);
    }

    /**
     * Add a collaborator to a bundle.
     *
     * Parameters
     *
     * bundle_link  - the URL of the bundle
     * collaborator - bitly login or email address of the collaborator to add
     *
     * Return Values
     *
     * bundle_owner:     the bitly user who owns this bundle (the authenticated user on whose behalf the bundle was created).
     * created_ts:       a timestamp representing the time at which this bundle was created.
     * description:      a description of this bundle.
     * bundle_link:      a URL pointing directly to this bundle.
     * last_modified_ts: a timestamp representing the last time this bundle was modified.
     * private:          a true/false value indicating whether this bundle is set to be private.
     * links:            the links in the bundle. Each link returns the following fields:
     *   aggregate_link: the global bitly link for the specified long_url, which can be used to track aggregate stats across all matching bitly links.
     *   link:           the bitly link for the specified long_url, unique to this user's account.
     *   description:    a description of this link.
     *   title:          the title of this link, automatically populated from the destination page title and editable with the /v3/bundle/link_edit endpoint.
     *   long_url:       the destination long URL for this link.
     *   display_order:  the order in which this link will display, starting with 0 for the link to be displayed first.
     *
     * NOTE: If the collaborator was invited, the response will have an extra collab_token field containing the token emailed to the collaborator.
     *
     * @param string $bundleLink   the URL of the bundle
     * @param string $collaborator bitly login or email address of the collaborator to add
     * @see http://dev.bitly.com/bundles.html#v3_bundle_collaborator_add
     */
    public function collaboratorAdd($bundleLink, $collaborator)
    {
        $query = array(
            'bundle_link'  => $bundleLink,
            'collaborator' => $collaborator,
        );

        return $this->get('/bundle/collaborator_add', $query);
    }

    /**
     * Remove a collaborator from a bundle.
     *
     * Parameters
     *
     * bundle_link  - the URL of the bundle
     * collaborator - bitly login of the collaborator to remove
     *
     * Return Values
     *
     * bundle_owner:     the bitly user who owns this bundle (the authenticated user on whose behalf the bundle was created).
     * created_ts:       a timestamp representing the time at which this bundle was created.
     * description:      a description of this bundle.
     * bundle_link:      a URL pointing directly to this bundle.
     * last_modified_ts: a timestamp representing the last time this bundle was modified.
     * private:          a true/false value indicating whether this bundle is set to be private.
     * links:            the links in the bundle. Each link returns the following fields:
     *   aggregate_link: the global bitly link for the specified long_url, which can be used to track aggregate stats across all matching bitly links.
     *   link:           the bitly link for the specified long_url, unique to this user's account.
     *   description:    a description of this link.
     *   title:          the title of this link, automatically populated from the destination page title and editable with the /v3/bundle/link_edit endpoint.
     *   long_url:       the destination long URL for this link.
     *   display_order:  the order in which this link will display, starting with 0 for the link to be displayed first.
     *
     * @param string $bundleLink   the URL of the bundle
     * @param string $collaborator bitly login of the collaborator to remove
     * @see http://dev.bitly.com/bundles.html#v3_bundle_collaborator_remove
     */
    public function collaboratorRemove($bundleLink, $collaborator)
    {
        $query = array(
            'bundle_link'  => $bundleLink,
            'collaborator' => $collaborator,
        );

        return $this->get('/bundle/collaborator_remove', $query);
    }

    /**
     * Returns information about a bundle.
     *
     * Parameters
     *
     * bundle_link - the URL corresponding to the bundle to be returned.
     * expand_user - optional - true|false - include extra user info in response
     *
     * Return Values
     *
     * bundle_owner:     the bitly user who owns this bundle (the authenticated user on whose behalf the bundle was created).
     * created_ts:       a timestamp representing the time at which this bundle was created.
     * description:      a description of this bundle.
     * bundle_link:      a URL pointing directly to this bundle.
     * last_modified_ts: a timestamp representing the last time this bundle was modified.
     * private:          a true/false value indicating whether this bundle is set to be private.
     * links:            the links in the bundle. Each link returns the following fields:
     *   aggregate_link: the global bitly link for the specified long_url, which can be used to track aggregate stats across all matching bitly links.
     *   link:           the bitly link for the specified long_url, unique to this user's account.
     *   description:    a description of this link.
     *   title:          the title of this link, automatically populated from the destination page title and editable with the /v3/bundle/link_edit endpoint.
     *   long_url:       the destination long URL for this link.
     *   display_order:  the order in which this link will display, starting with 0 for the link to be displayed first.
     *
     * @param string  $bundleLink the URL corresponding to the bundle to be returned.
     * @param boolean $expandUser optional - true|false - include extra user info in response
     * @see http://dev.bitly.com/bundles.html#v3_bundle_contents
     */
    public function contents($bundleLink, $expandUser = null)
    {
        $query = array(
            'bundle_link' => $bundleLink,
            'expand_user' => $expandUser,
        );

        return $this->get('/bundle/contents', $query);
    }

    /**
     * Create a new bundle for the authenticated user
     *
     * Parameters
     *
     * private     (optional) - a value true or false designating the privacy setting of the bundle to be created (default: False).
     * title       (optional) - the title of the bundle to be created.
     * description (optional) - a description of the bundle to be created.
     *
     * Return Values
     *
     * bundle_owner:     the bitly user who owns this bundle (the authenticated user on whose behalf the bundle was created).
     * created_ts:       a timestamp representing the time at which this bundle was created.
     * description:      a description of this bundle.
     * bundle_link:      a URL pointing directly to this bundle.
     * last_modified_ts: a timestamp representing the last time this bundle was modified.
     * private:          a true/false value indicating whether this bundle is set to be private.
     * links:            the links in the bundle. Each link returns the following fields:
     *   aggregate_link: the global bitly link for the specified long_url, which can be used to track aggregate stats across all matching bitly links.
     *   link:           the bitly link for the specified long_url, unique to this user's account.
     *   description:    a description of this link.
     *   title:          the title of this link, automatically populated from the destination page title and editable with the /v3/bundle/link_edit endpoint.
     *   long_url:       the destination long URL for this link.
     *   display_order:  the order in which this link will display, starting with 0 for the link to be displayed first.
     *
     * @param string $private     (optional) - a value true or false designating the privacy setting of the bundle to be created (default: False).
     * @param string $title       (optional) - the title of the bundle to be created.
     * @param string $description (optional) - a description of the bundle to be created.
     * @see http://dev.bitly.com/bundles.html#v3_bundle_create
     */
    public function create($private = null, $title = null, $description = null)
    {
        $query = array(
            'private'     => $private,
            'title'       => $title,
            'description' => $description,
        );

        return $this->get('/bundle/create', $query);
    }

    /**
     * Edit a bundle for the authenticated user
     *
     * Parameters
     *
     * bundle_link - the URL corresponding to the bundle to be modified.
     * edit        - (optional) - a field designating which properties (e.g., title,description) are to be edited, allowing for these fields to be updated with empty values.
     * title       - (optional) - a title for the specified bundle.
     * description - (optional) - a description for the specified bundle.
     * private     - (optional) - a "true" or "false" value representing whether or not the specified bundle should set to private.
     * preview     - (optional) - a "true" or "false" value representing whether or not content previews should be shown for the specified bundle's links.
     * og_image    - (optional) - the URL to the bundle's cover image
     *
     * Return Values
     *
     * bundle_owner:     the bitly user who owns this bundle (the authenticated user on whose behalf the bundle was created).
     * created_ts:       a timestamp representing the time at which this bundle was created.
     * description:      a description of this bundle.
     * bundle_link:      a URL pointing directly to this bundle.
     * last_modified_ts: a timestamp representing the last time this bundle was modified.
     * private:          a true/false value indicating whether this bundle is set to be private.
     * links:            the links in the bundle. Each link returns the following fields:
     *   aggregate_link: the global bitly link for the specified long_url, which can be used to track aggregate stats across all matching bitly links.
     *   link:           the bitly link for the specified long_url, unique to this user's account.
     *   description:    a description of this link.
     *   title:          the title of this link, automatically populated from the destination page title and editable with the /v3/bundle/link_edit endpoint.
     *   long_url:       the destination long URL for this link.
     *   display_order:  the order in which this link will display, starting with 0 for the link to be displayed first.
     *
     * @param string  $bundleLink  the URL corresponding to the bundle to be modified.
     * @param string  $edit        (optional) - a field designating which properties (e.g., title,description) are to be edited, allowing for these fields to be updated with empty values.
     * @param string  $title       (optional) - a title for the specified bundle.
     * @param string  $description (optional) - a description for the specified bundle.
     * @param boolean $private     (optional) - a "true" or "false" value representing whether or not the specified bundle should set to private.
     * @param boolean $preview     (optional) - a "true" or "false" value representing whether or not content previews should be shown for the specified bundle's links.
     * @param string  $ogImage     (optional) - the URL to the bundle's cover image
     * @see http://dev.bitly.com/bundles.html#v3_bundle_edit
     */
    public function edit($bundleLink, $edit = null, $title = null, $description = null, $private = null, $preview = null, $ogImage = null)
    {
        $query = array(
            'bundle_link' => $bundleLink,
            'edit'        => $edit,
            'title'       => $title,
            'description' => $description,
            'private'     => $private,
            'preview'     => $preview,
            'og_image'    => $ogImage,
        );

        return $this->get('/bundle/edit', $query);
    }

    /**
     * Adds a link to a bitly bundle. Links are automatically added to the top (position 0) of a bundle.
     *
     * Parameters
     *
     * bundle_link - the URL corresponding to the bundle to which the link will be added.
     * link        - the URL to be added to the specified bundle. (This can be a bitly short URL or a long URL; if it is a long URL, it will be automatically saved to the authenticated user's account.)
     * title       - (optional) - the title to use for this link in this bundle.
     *
     * Return Values
     *
     * bundle_owner:     the bitly user who owns this bundle (the authenticated user on whose behalf the bundle was created).
     * created_ts:       a timestamp representing the time at which this bundle was created.
     * description:      a description of this bundle.
     * bundle_link:      a URL pointing directly to this bundle.
     * last_modified_ts: a timestamp representing the last time this bundle was modified.
     * private:          a true/false value indicating whether this bundle is set to be private.
     * links:            the links in the bundle. Each link returns the following fields:
     *   aggregate_link: the global bitly link for the specified long_url, which can be used to track aggregate stats across all matching bitly links.
     *   link:           the bitly link for the specified long_url, unique to this user's account.
     *   description:    a description of this link.
     *   title:          the title of this link, automatically populated from the destination page title and editable with the /v3/bundle/link_edit endpoint.
     *   long_url:       the destination long URL for this link.
     *   display_order:  the order in which this link will display, starting with 0 for the link to be displayed first.
     *
     * @param string $bundleLink the URL corresponding to the bundle to which the link will be added.
     * @param string $link       the URL to be added to the specified bundle. (This can be a bitly short URL or a long URL; if it is a long URL, it will be automatically saved to the authenticated user's account.)
     * @param string $title      (optional) - the title to use for this link in this bundle.
     * @see http://dev.bitly.com/bundles.html#v3_bundle_link_add
     */
    public function linkAdd($bundleLink, $link, $title = null)
    {
        $query = array(
            'bundle_link' => $bundleLink,
            'link'        => $link,
            'title'       => $title,
        );

        return $this->get('/bundle/link_add', $query);
    }

    /**
     * Add a comment to bundle item.
     *
     * Parameters
     *
     * bundle_link - the URL corresponding to the bundle in which the link will be edited.
     * link        - the bitly link to which the comment applies.
     * comment     - the comment to add. Must fit in 512 characters.
     *
     * Return Values
     *
     * bundle_owner:     the bitly user who owns this bundle (the authenticated user on whose behalf the bundle was created).
     * created_ts:       a timestamp representing the time at which this bundle was created.
     * description:      a description of this bundle.
     * bundle_link:      a URL pointing directly to this bundle.
     * last_modified_ts: a timestamp representing the last time this bundle was modified.
     * private:          a true/false value indicating whether this bundle is set to be private.
     * links:            the links in the bundle. Each link returns the following fields:
     *   aggregate_link: the global bitly link for the specified long_url, which can be used to track aggregate stats across all matching bitly links.
     *   link:           the bitly link for the specified long_url, unique to this user's account.
     *   description:    a description of this link.
     *   title:          the title of this link, automatically populated from the destination page title and editable with the /v3/bundle/link_edit endpoint.
     *   long_url:       the destination long URL for this link.
     *   display_order:  the order in which this link will display, starting with 0 for the link to be displayed first.
     *
     * @param string $bundleLink the URL corresponding to the bundle in which the link will be edited.
     * @param string $link       the bitly link to which the comment applies.
     * @param string $comment    the comment to add. Must fit in 512 characters.
     * @see http://dev.bitly.com/bundles.html#v3_bundle_link_comment_add
     */
    public function linkCommentAdd($bundleLink, $link, $comment)
    {
        $query = array(
            'bundle_link' => $bundleLink,
            'link'        => $link,
            'comment'     => $comment,
        );

        return $this->get('/bundle/link_comment_add', $query);
    }

    /**
     * Add a comment to bundle item.
     *
     * Parameters
     *
     * bundle_link - the URL corresponding to the bundle in which the link will be edited.
     * link        - the bitly link on which the comment exists.
     * comment_id  - the id of the comment to edit.
     * comment     - the edited comment. Must fit in 512 characters.
     *
     * Return Values
     *
     * bundle_owner:     the bitly user who owns this bundle (the authenticated user on whose behalf the bundle was created).
     * created_ts:       a timestamp representing the time at which this bundle was created.
     * description:      a description of this bundle.
     * bundle_link:      a URL pointing directly to this bundle.
     * last_modified_ts: a timestamp representing the last time this bundle was modified.
     * private:          a true/false value indicating whether this bundle is set to be private.
     * links:            the links in the bundle. Each link returns the following fields:
     *   aggregate_link: the global bitly link for the specified long_url, which can be used to track aggregate stats across all matching bitly links.
     *   link:           the bitly link for the specified long_url, unique to this user's account.
     *   description:    a description of this link.
     *   title:          the title of this link, automatically populated from the destination page title and editable with the /v3/bundle/link_edit endpoint.
     *   long_url:       the destination long URL for this link.
     *   display_order:  the order in which this link will display, starting with 0 for the link to be displayed first.
     *
     * @param string $bundleLink the URL corresponding to the bundle in which the link will be edited.
     * @param string $link       the bitly link on which the comment exists.
     * @param string $commentId  the id of the comment to edit.
     * @param string $comment    the edited comment. Must fit in 512 characters.
     * @see http://dev.bitly.com/bundles.html#v3_bundle_link_comment_edit
     */
    public function linkCommentEdit($bundleLink, $link, $commentId, $comment)
    {
        $query = array(
            'bundle_link' => $bundleLink,
            'link'        => $link,
            'comment_id'  => $commentId,
            'comment'     => $comment,
        );

        return $this->get('/bundle/link_comment_edit', $query);
    }

    /**
     * Remove a comment from a bundle item. Only the original commenter and the bundles owner may perform this action.
     *
     * Parameters
     *
     * bundle_link - the URL corresponding to the bundle in which the link will be edited.
     * link        - the bitly link to be edited.
     * comment_id  - the ID of the comment to be removed.
     *
     * Return Values
     *
     * bundle_owner:     the bitly user who owns this bundle (the authenticated user on whose behalf the bundle was created).
     * created_ts:       a timestamp representing the time at which this bundle was created.
     * description:      a description of this bundle.
     * bundle_link:      a URL pointing directly to this bundle.
     * last_modified_ts: a timestamp representing the last time this bundle was modified.
     * private:          a true/false value indicating whether this bundle is set to be private.
     * links:            the links in the bundle. Each link returns the following fields:
     *   aggregate_link: the global bitly link for the specified long_url, which can be used to track aggregate stats across all matching bitly links.
     *   link:           the bitly link for the specified long_url, unique to this user's account.
     *   description:    a description of this link.
     *   title:          the title of this link, automatically populated from the destination page title and editable with the /v3/bundle/link_edit endpoint.
     *   long_url:       the destination long URL for this link.
     *   display_order:  the order in which this link will display, starting with 0 for the link to be displayed first.
     *
     * @param string $bundleLink the URL corresponding to the bundle in which the link will be edited.
     * @param string $link       the bitly link to be edited.
     * @param string $commentId  the ID of the comment to be removed.
     * @see http://dev.bitly.com/bundles.html#v3_bundle_link_comment_remove
     */
    public function linkCommentRemove($bundleLink, $link, $commentId)
    {
        $query = array(
            'bundle_link' => $bundleLink,
            'link'        => $link,
            'comment_id'  => $commentId,
        );

        return $this->get('/bundle/link_comment_remove', $query);
    }

    /**
     * Edit the title for a link.
     *
     * Parameters
     *
     * bundle_link - the URL corresponding to the bundle in which the link will be edited.
     * link        - the bitly link to be edited.
     * edit        - a field designating which properties (title, preview) are to be edited, allowing for these fields to be updated with empty values.
     * title       - (optional) - a title for the specified link.
     * preview     - (optional) - whether an content preview should be displayed for this item (overrides the per-bundle flag of the same name)
     *
     * Return Values
     *
     * bundle_owner:     the bitly user who owns this bundle (the authenticated user on whose behalf the bundle was created).
     * created_ts:       a timestamp representing the time at which this bundle was created.
     * description:      a description of this bundle.
     * bundle_link:      a URL pointing directly to this bundle.
     * last_modified_ts: a timestamp representing the last time this bundle was modified.
     * private:          a true/false value indicating whether this bundle is set to be private.
     * links:            the links in the bundle. Each link returns the following fields:
     *   aggregate_link: the global bitly link for the specified long_url, which can be used to track aggregate stats across all matching bitly links.
     *   link:           the bitly link for the specified long_url, unique to this user's account.
     *   description:    a description of this link.
     *   title:          the title of this link, automatically populated from the destination page title and editable with the /v3/bundle/link_edit endpoint.
     *   long_url:       the destination long URL for this link.
     *   display_order:  the order in which this link will display, starting with 0 for the link to be displayed first.
     *
     * @param string $bundleLink the URL corresponding to the bundle in which the link will be edited.
     * @param string $link       the bitly link to be edited.
     * @param string $edit       a field designating which properties (title, preview) are to be edited, allowing for these fields to be updated with empty values.
     * @param string $title      (optional) - a title for the specified link.
     * @param string $preview    (optional) - whether an content preview should be displayed for this item (overrides the per-bundle flag of the same name)
     * @see http://dev.bitly.com/bundles.html#v3_bundle_link_edit
     */
    public function linkEdit($bundleLink, $link, $edit, $title = null, $preview = null)
    {
        $query = array(
            'bundle_link' => $bundleLink,
            'link'        => $link,
            'edit'        => $edit,
            'title'       => $title,
            'preview'     => $preview,
        );

        return $this->get('/bundle/link_edit', $query);
    }

    /**
     * Remove a link from a bitly bundle
     *
     * Parameters
     *
     * bundle_link - the URL corresponding to the bundle from which the link will be removed.
     * link        - the bitly link to be removed from this bundle.
     *
     * Return Values
     *
     * bundle_owner:     the bitly user who owns this bundle (the authenticated user on whose behalf the bundle was created).
     * created_ts:       a timestamp representing the time at which this bundle was created.
     * description:      a description of this bundle.
     * bundle_link:      a URL pointing directly to this bundle.
     * last_modified_ts: a timestamp representing the last time this bundle was modified.
     * private:          a true/false value indicating whether this bundle is set to be private.
     * links:            the links in the bundle. Each link returns the following fields:
     *   aggregate_link: the global bitly link for the specified long_url, which can be used to track aggregate stats across all matching bitly links.
     *   link:           the bitly link for the specified long_url, unique to this user's account.
     *   description:    a description of this link.
     *   title:          the title of this link, automatically populated from the destination page title and editable with the /v3/bundle/link_edit endpoint.
     *   long_url:       the destination long URL for this link.
     *   display_order:  the order in which this link will display, starting with 0 for the link to be displayed first.
     *
     * @param string $bundleLink the URL corresponding to the bundle from which the link will be removed.
     * @param string $link       the bitly link to be removed from this bundle.
     * @see http://dev.bitly.com/bundles.html#v3_bundle_link_remove
     */
    public function linkRemove($bundleLink, $link)
    {
        $query = array(
            'bundle_link' => $bundleLink,
            'link'        => $link,
        );

        return $this->get('/bundle/link_remove', $query);
    }

    /**
     * Change the position of a link in a bitly bundle.
     *
     * Parameters
     *
     * bundle_link   - the URL corresponding to the bundle in which the link will be reordered.
     * link          - the bitly link to be reordered in this bundle.
     * display_order - the new display_order value to be assigned to the the specified link. (A value of -1 moves to end, 0 to the front, any other number moves it to that spot, bumping everythign else down.)
     *
     * Return Values
     *
     * bundle_owner:     the bitly user who owns this bundle (the authenticated user on whose behalf the bundle was created).
     * created_ts:       a timestamp representing the time at which this bundle was created.
     * description:      a description of this bundle.
     * bundle_link:      a URL pointing directly to this bundle.
     * last_modified_ts: a timestamp representing the last time this bundle was modified.
     * private:          a true/false value indicating whether this bundle is set to be private.
     * links:            the links in the bundle. Each link returns the following fields:
     *   aggregate_link: the global bitly link for the specified long_url, which can be used to track aggregate stats across all matching bitly links.
     *   link:           the bitly link for the specified long_url, unique to this user's account.
     *   description:    a description of this link.
     *   title:          the title of this link, automatically populated from the destination page title and editable with the /v3/bundle/link_edit endpoint.
     *   long_url:       the destination long URL for this link.
     *   display_order:  the order in which this link will display, starting with 0 for the link to be displayed first.
     *
     * @param string $bundleLink   the URL corresponding to the bundle in which the link will be reordered.
     * @param string $link         the bitly link to be reordered in this bundle.
     * @param string $displayOrder the new display_order value to be assigned to the the specified link. (A value of -1 moves to end, 0 to the front, any other number moves it to that spot, bumping everythign else down.)
     * @see http://dev.bitly.com/bundles.html#v3_bundle_link_reorder
     */
    public function linkReorder($bundleLink, $link, $displayOrder)
    {
        $query = array(
            'bundle_link'   => $bundleLink,
            'link'          => $link,
            'display_order' => $displayOrder,
        );

        return $this->get('/bundle/link_reorder', $query);
    }

    /**
     * Removes a pending/invited collaborator from a bundle.
     *
     * Parameters
     *
     * bundle_link  - the URL of the bundle
     * collaborator - bitly login or email address of the collaborator to remove.
     *
     * Return Values
     *
     * bundle_owner:     the bitly user who owns this bundle (the authenticated user on whose behalf the bundle was created).
     * created_ts:       a timestamp representing the time at which this bundle was created.
     * description:      a description of this bundle.
     * bundle_link:      a URL pointing directly to this bundle.
     * last_modified_ts: a timestamp representing the last time this bundle was modified.
     * private:          a true/false value indicating whether this bundle is set to be private.
     * links:            the links in the bundle. Each link returns the following fields:
     *   aggregate_link: the global bitly link for the specified long_url, which can be used to track aggregate stats across all matching bitly links.
     *   link:           the bitly link for the specified long_url, unique to this user's account.
     *   description:    a description of this link.
     *   title:          the title of this link, automatically populated from the destination page title and editable with the /v3/bundle/link_edit endpoint.
     *   long_url:       the destination long URL for this link.
     *   display_order:  the order in which this link will display, starting with 0 for the link to be displayed first.
     *
     * @param string $bundleLink   the URL of the bundle
     * @param string $collaborator bitly login or email address of the collaborator to remove.
     * @see http://dev.bitly.com/bundles.html#v3_bundle_pending_collaborator_remove
     */
    public function pendingCollaboratorRemove($bundleLink, $collaborator)
    {
        $query = array(
            'bundle_link'  => $bundleLink,
            'collaborator' => $collaborator,
        );

        return $this->get('/bundle/pending_collaborator_remove', $query);
    }

    /**
     * Re-order the links in a bundle.
     *
     * Parameters
     *
     * bundle_link - the URL corresponding to the bundle in which the link will be reordered.
     * link        - one ore more bitly links to be reordered
     *
     * The link param should be repeated for each link to be reordered, and each link should be given in the order in which it should appear in the bundle.
     *
     * Return Values
     *
     * bundle_owner:     the bitly user who owns this bundle (the authenticated user on whose behalf the bundle was created).
     * created_ts:       a timestamp representing the time at which this bundle was created.
     * description:      a description of this bundle.
     * bundle_link:      a URL pointing directly to this bundle.
     * last_modified_ts: a timestamp representing the last time this bundle was modified.
     * private:          a true/false value indicating whether this bundle is set to be private.
     * links:            the links in the bundle. Each link returns the following fields:
     *   aggregate_link: the global bitly link for the specified long_url, which can be used to track aggregate stats across all matching bitly links.
     *   link:           the bitly link for the specified long_url, unique to this user's account.
     *   description:    a description of this link.
     *   title:          the title of this link, automatically populated from the destination page title and editable with the /v3/bundle/link_edit endpoint.
     *   long_url:       the destination long URL for this link.
     *   display_order:  the order in which this link will display, starting with 0 for the link to be displayed first.
     *
     * @param string          $bundleLink the URL corresponding to the bundle in which the link will be reordered.
     * @param string|string[] $link       one ore more bitly links to be reordered
     * @see http://dev.bitly.com/bundles.html#v3_bundle_reorder
     */
    public function reorder($bundleLink, $link)
    {
        $query = array(
            'bundle_link' => $bundleLink,
            'link'        => $link,
        );

        return $this->get('/bundle/reorder', $query);
    }

    /**
     * Get the number of views for a bundle.
     *
     * Parameters
     *
     * bundle_link - the URL of the bundle.
     *
     * Return Values
     *
     * bundle_link - an echo of the input bundle_link param
     * view_count  - the number of times the bundle has been viewed
     *
     * @param string $bundleLink the URL of the bundle.
     * @see http://dev.bitly.com/bundles.html#v3_bundle_view_count
     */
    public function viewCount($bundleLink)
    {
        $query = array(
            'bundle_link' => $bundleLink,
        );

        return $this->get('/bundle/view_count', $query);
    }

    /**
     * Returns all bundles this user has access to (public + private + collaborator)
     *
     * Parameters
     *
     * expand_user optional - true|false - include extra user info in response
     *
     * @param boolean $expandUser optional - true|false - include extra user info in response
     * @see http://dev.bitly.com/bundles.html#v3_user_bundle_history
     */
    public function bundleHistory($expandUser = null)
    {
        $query = array(
            'expand_user' => $expandUser,
        );

        return $this->get('/user/bundle_history', $query);
    }
}
