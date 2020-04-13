<?php

namespace MinaWilliam\Zoom\Classes;


use MinaWilliam\Zoom\Support\Request;

class Webinars extends Request
{

    /**
     * List
     *
     * @param string $userId
     * @return array|mixed
     */
    public function list(string $userId)
    {
        return $this->get("users/{$userId}/webinars");
    }

    /**
     * Create
     *
     * @param string $userId
     * @param array $data
     * @return array|mixed
     */
    public function create(string $userId, array $data  = null)
    {
        return $this->post("users/{$userId}/webinars", $data);
    }

    /**
     * Update
     *
     * @param string $webinarId
     * @param array $data
     * @return array|mixed
     */
    public function update(string $webinarId, array $data  = null)
    {
        return $this->patch("webinars/{$webinarId}", $data);
    }

    /**
     * UpdateStatus
     *
     * @param string $webinarId
     * @param string $action
     * @return array|mixed
     */
    public function updateStatus(string $webinarId, string $action)
    {
        return $this->put("webinars/{$webinarId}/status", ['action' => $action]);
    }

    /**
     * DeleteWebinar
     *
     * @param string $webinarId
     * @return array|mixed
     */
    public function deleteWebinar(string $webinarId)
    {
        return $this->delete("webinars/{$webinarId}");
    }

    /**
     * getWebinar
     *
     * @param string $webinarId
     * @return array|mixed
     */
    public function getWebinar(string $webinarId)
    {
        return $this->get("webinars/{$webinarId}");
    }

    /**
     * Records
     *
     * @param string $webinarId
     * @return array|mixed
     */
    public function records(string $webinarId)
    {
        return $this->get("webinars/{$webinarId}/recordings");
    }

}
