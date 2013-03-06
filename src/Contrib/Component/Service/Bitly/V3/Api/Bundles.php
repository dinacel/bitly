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
 */
class Bundles extends Bitly
{
    public function archive()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/archive', $query);
    }

    public function bundlesByUser()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/bundles_by_user', $query);
    }

    public function cloneBundle()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/clone', $query);
    }

    public function collaboratorAdd()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/collaborator_add', $query);
    }

    public function collaboratorRemove()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/collaborator_remove', $query);
    }

    public function contents()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/contents', $query);
    }

    public function create()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/create', $query);
    }

    public function edit()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/edit', $query);
    }

    public function linkAdd()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/link_add', $query);
    }

    public function linkCommentAdd()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/link_comment_add', $query);
    }

    public function linkCommentEdit()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/link_comment_edit', $query);
    }

    public function linkCommentRemove()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/link_comment_remove', $query);
    }

    public function linkEdit()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/link_edit', $query);
    }

    public function linkRemove()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/link_remove', $query);
    }

    public function linkReorder()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/link_reorder', $query);
    }

    public function pendingCollaboratorRemove()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/pending_collaborator_remove', $query);
    }

    public function reorder()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/reorder', $query);
    }

    public function viewCount()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/bundle/view_count', $query);
    }

    public function bundleHistory()
    {
        throw new \Exception('not implemented.');

        $query = array(
        );

        return $this->get('/user/bundle_history', $query);
    }
}
