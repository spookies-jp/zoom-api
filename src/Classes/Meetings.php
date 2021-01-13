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
    public function list(string $userId): array
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
    public function create(string $userId, array $data  = null): array
    {
        return $this->post("users/{$userId}/meetings", $data);
    }

    /**
     * GetMeeting
     *
     * @param string $meetingId
     * @return array|mixed
     */
    public function retrieve(string $meetingId): array
    {
        return $this->get("meetings/{$meetingId}");
    }

    /**
     * Update
     *
     * @param string $meetingId
     * @param array $data
     * @return array|mixed
     */
    public function update(string $meetingId, array $data  = null): array
    {
        return $this->patch("meetings/{$meetingId}", $data);
    }

    /**
     * UpdateStatus
     *
     * @param string $webinarId
     * @param string $action
     * @return array|mixed
     */
    public function updateStatus(string $meetingId, string $action): array
    {
        return $this->put("meetings/{$meetingId}/status", ['action' => $action]);
    }


    /**
     * DeleteMeeting
     *
     * @param string $meetingId
     * @return array|mixed
     */
    public function remove(string $meetingId): array
    {
        return $this->delete("meetings/{$meetingId}");
    }

    /**
     * Records
     *
     * @param string $meetingId
     * @return array|mixed
     */
    public function records(string $meetingId): array
    {
        return $this->get("meetings/{$meetingId}/recordings");
    }

}