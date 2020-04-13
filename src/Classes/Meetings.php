<?php

namespace MinaWilliam\Zoom\Classes;

use MinaWilliam\Zoom\Support\Request;

class Meetings extends Request
{

    /**
     * List
     *
     * @param string $userId
     * @return array|mixed
     */
    public function list(string $userId)
    {
        return $this->get("users/{$userId}/meetings");
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
        return $this->post("users/{$userId}/meetings", $data);
    }

    /**
     * GetMeeting
     *
     * @param string $meetingId
     * @return array|mixed
     */
    public function getMeeting(string $meetingId)
    {
        return $this->get("meetings/{$meetingId}");
    }

    /**
     * DeleteMeeting
     *
     * @param string $meetingId
     * @return array|mixed
     */
    public function deleteMeeting(string $meetingId)
    {
        return $this->delete("meetings/{$meetingId}");
    }

    /**
     * Records
     *
     * @param string $meetingId
     * @return array|mixed
     */
    public function records(string $meetingId)
    {
        return $this->get("meetings/{$meetingId}/recordings");
    }

}