<?php

namespace MinaWilliam\Zoom;

use Exception;
use Illuminate\Support\Str;

/**
 * Class Zoom
 * @package MinaWilliam\Zoom
 *
 * @property-read \MinaWilliam\Zoom\Classes\Users $users
 * @property-read \MinaWilliam\Zoom\Classes\Meetings $meetings
 * @property-read \MinaWilliam\Zoom\Classes\Webinars $webinars
 */
class Zoom
{

    /**
     * __call
     *
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return $this->make($method);
    }


    /**
     * __get
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->make($name);
    }

    /**
     * Make
     *
     * @param $resource
     * @return mixed
     * @throws Exception
     */
    public function make($resource)
    {
        $class = 'MinaWilliam\\Zoom\\Classes\\' . Str::studly($resource);

        if (class_exists($class)) {

            return new $class();
        }

        throw new Exception('Wrong method');
    }

    /**
     * @param int $meeting_number
     * @param int $role
     * @return string
     */
    public function generateSignature(int $meeting_number, int $role = 0)
    {
        $api_key = config('zoom.api_key');
        $api_secret =config('zoom.api_secret');
        $time = time() * 1000 - 30000; //time in milliseconds (or close enough)

        $data = base64_encode( $api_key . $meeting_number . $time . $role);

        $hash = hash_hmac('sha256', $data, $api_secret, true);

        $_sig = $api_key . "." . $meeting_number . "." . $time . "." . $role . "." . base64_encode($hash);

        //return signature, url safe base64 encoded
        return rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');
    }
}