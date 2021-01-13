<?php

namespace MinaWilliam\Zoom\Classes;

use MinaWilliam\Zoom\Support\Request;

class Users extends Request
{

    /**
     * List Users
     *
     * @return array
     */
    public function list() : array
    {
        return $this->get('users');
    }

    /**
     * Create
     *
     * @param array $data
     * @return array|mixed
     */
    public function create(array $data): array
    {
        return $this->post('users', $data);
    }

    /**
     * Update
     *
     * @param string $userId
     * @param array $data
     * @return array|mixed
     */
    public function update(string $userId, array $data): array
    {
        return $this->patch("users/{$userId}", $data);
    }

    /**
     * UpdatePassword
     *
     * @param string $userId
     * @param array $data
     * @return array|mixed
     */
    public function updatePassword(string $userId, array $data): array
    {
        return $this->put("users/{$userId}/password", $data);
    }
    
    /**
     * Retrieve
     *
     * @param string $userId
     * @param array $optional
     * @return array|mixed
     */
    public function retrieve(string $userId, $optional = []): array
    {
        return $this->get("users/{$userId}", $optional);
    }

    /**
     * Remove
     *
     * @param string $userId
     * @return array|mixed
     */
    public function remove(string $userId): array
    {
        return $this->delete("users/{$userId}");
    }

    /**
     * Users Assistants List
     *
     * @param string $userId
     * @return array|mixed
     */
    public function assistantsList(string $userId): array
    {
        return $this->get("users/{$userId}/assistants");
    }

    /**
     * Add Assistant
     *
     * @param string $userId
     * @param array $data
     * @return array|mixed
     */
    public function addAssistant(string $userId, array $data): array
    {
        return $this->post("users{$userId}/assistants", $data);
    }

    /**
     * Delete Assistants
     *
     * @param string $userId
     * @return array|mixed
     */
    public function deleteAssistants(string $userId): array
    {
        return $this->delete("users/{$userId}/assistants");
    }

    /**
     * Delete Assistant
     *
     * @param string $userId
     * @param string $assistantId
     * @return array|mixed
     */
    public function deleteAssistant(string $userId, string $assistantId): array
    {
        return $this->delete("users/{$userId}/assistants/{$assistantId}");
    }

    /**
     * Schedulers List
     *
     * @param string $userId
     * @return array|mixed
     */
    public function schedulersList(string $userId): array
    {
        return $this->get("users/{$userId}/schedulers");
    }

    /**
     * Deletes Schedulers
     *
     * @param string $userId
     * @return array|mixed
     */
    public function deletesSchedulers(string $userId): array
    {
        return $this->delete("users/{$userId}/schedulers");
    }

    /**
     * Deletes Scheduler
     *
     * @param string $userId
     * @param string $schedulerId
     * @return array|mixed
     */
    public function deletesScheduler(string $userId, string $schedulerId): array
    {
        return $this->delete("users/{$userId}/schedulers/{$schedulerId}");
    }

}