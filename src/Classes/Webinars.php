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
     * webinar
     *
     * @param string $webinarId
     * @return array|mixed
     */
    public function webinar(string $webinarId)
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
