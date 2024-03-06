<?php

namespace MinaWilliam\Zoom\Support;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Cache;

class Request
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var \Illuminate\Config\Repository|mixed|null|string
     */
    protected $zoomUserId;

    /**
     * @var string
     */
    public $apiPoint = 'https://api.zoom.us/v2/';

    /**
     * @var string
     */
    public $authPoint = 'https://zoom.us/oauth/token';

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * OAuth
     *
     * @return array|mixed
     */
    public function auth()
    {
        $fields = [
           'code' => config('zoom.user_code'),
           'grant_type'  => 'authorization_code',
           'redirect_uri' => config('zoom.redirect_uri')
        ];

        try {
            $response = $this->client->request('POST', $this->authPoint,
                ['form_params' => $fields, 'headers' => $this->authHeaders()]);

            return $this->result($response);

        } catch (ClientException $e) {

            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    /**
     * Refresh Token
     * 
     * Use Server-to-Server OAuth
     * @see https://developers.zoom.us/docs/internal-apps/s2s-oauth/
     */
    public function refreshAuth()
    {
        $accountId = config('zoom.account_id');

        $fields = [
            'account_id' => $accountId,
            'grant_type'  => 'account_credentials',
        ];

        try {
            $response = $this->client->request('POST', $this->authPoint,
                ['form_params' => $fields, 'headers' => $this->authHeaders()]);

            return $this->result($response);

        } catch (ClientException $e) {

            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }



    /**
     * Headers
     *
     * @return array
     */
    protected function authHeaders(): array
    {
        $client_id = config('zoom.client_id');
        $client_secret = config('zoom.client_secret');

        $authToken = base64_encode("{$client_id}:{$client_secret}");
        return [
            'Authorization' => "Basic {$authToken}",
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
    }



    /**
     * Headers
     *
     * @return array
     */
    protected function headers(): array
    {
        $access_token = $this->generateAccessToken();
        return [
            //'Authorization' => 'Bearer ' . $this->generateJWT(),
            'Authorization' => "Bearer {$access_token}",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    /**
     * Generate AccessToken
     *
     * @return string
     */
    protected function generateAccessToken(): string
    {
        $access_token = Cache::get('zoom.access_token');
        if(empty($access_token)){
            $authResult = $this->refreshAuth();
            $access_token = $authResult['access_token'];
            Cache::set('zoom.access_token', $access_token, 3600);
        }

        return $access_token;
    }

    /**
     * Generate J W T
     *
     * @return string
     */
    protected function generateJWT(): string
    {
        $token = [
            'iss' => config('zoom.api_key'),
            'exp' => time() + 60,
        ];

        return JWT::encode($token,  config('zoom.api_secret'));
    }


    /**
     * Get
     *
     * @param $method
     * @param array $fields
     * @return array|mixed
     */
    protected function get($method, $fields = [])
    {
        try {
            $response = $this->client->request('GET', $this->apiPoint . $method, [
                'query' => $fields,
                'headers' => $this->headers(),
            ]);

            return $this->result($response);

        } catch (ClientException $e) {

            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    /**
     * Post
     *
     * @param $method
     * @param $fields
     * @return array|mixed
     */
    protected function post($method, $fields)
    {
        $body = \json_encode($fields, JSON_PRETTY_PRINT);

        try {
            $response = $this->client->request('POST', $this->apiPoint . $method,
                ['body' => $body, 'headers' => $this->headers()]);

            return $this->result($response);

        } catch (ClientException $e) {

            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    /**
     * Put
     *
     * @param $method
     * @param $fields
     * @return array|mixed
     */
    protected function put($method, $fields)
    {
        $body = \json_encode($fields, JSON_PRETTY_PRINT);

        try {
            $response = $this->client->request('PUT', $this->apiPoint . $method,
                ['body' => $body, 'headers' => $this->headers()]);

            return $this->result($response);

        } catch (ClientException $e) {

            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    /**
     * Patch
     *
     * @param $method
     * @param $fields
     * @return array|mixed
     */
    protected function patch($method, $fields)
    {
        $body = \json_encode($fields, JSON_PRETTY_PRINT);

        try {
            $response = $this->client->request('PATCH', $this->apiPoint . $method,
                ['body' => $body, 'headers' => $this->headers()]);

            return $this->result($response);

        } catch (ClientException $e) {

            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    protected function delete($method)
    {
        try {
            $response = $this->client->request('DELETE', $this->apiPoint . $method,
                [ 'headers' => $this->headers()]);

            return $this->result($response);

        } catch (ClientException $e) {

            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    /**
     * Result
     *
     * @param Response $response
     * @return mixed
     */
    protected function result(Response $response)
    {
        $result = json_decode((string)$response->getBody(), true);

        $result['code'] = $response->getStatusCode();

        return $result;
    }
}
