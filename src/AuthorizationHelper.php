<?php

namespace Speicher210\Estimote;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use Speicher210\Estimote\Auth\Application as ApplicationAuthorization;

class AuthorizationHelper
{
    /**
     * Check if an application authorization is valid.
     *
     * @param ApplicationAuthorization $applicationAuthorization The authorization code to check.
     * @return boolean
     */
    public function isApplicationAuthorizationValid(ApplicationAuthorization $applicationAuthorization)
    {
        try {
            $client = new ClientAppAuth($applicationAuthorization);
            // We get the visits and filter so we get no data back.
            // We are only interested if the request is authorized or not.
            $response = $client->get(
                'analytics/visits',
                [
                    'query' => [
                        'from' => time(),
                        'to' => time(),
                        'granularity' => 'hourly',
                    ],
                ]
            );

            return $response->getStatusCode() === 200;
        } catch (ClientException $e) {
            $response = $e->getResponse();
            if ($response->getStatusCode() === 401 || $response->getStatusCode() === 403) {
                return false;
            }

            throw $e;
        }

        return false;
    }

    public function authorizeApplication($clientId, $clientSecret, $username, $password)
    {
        $client = new GuzzleClient(['cookies' => true, 'allow_redirects' => true]);

        // Login into the portal
        $client->post(
            'https://cloud.estimote.com/v1/login',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => array('username' => $username, 'password' => $password),
            ]
        );

        $url = 'https://cloud.estimote.com/v1/oauth2/client_details?response_type=code&client_id='.$clientId.'&redirect_uri=http://localhost';
        $response = $client->get($url, ['allow_redirects' => false]);

        $json = \GuzzleHttp\json_decode($response->getBody(), true);

        $query = parse_url($json['redirect'], PHP_URL_QUERY);
        $output = array();
        parse_str($query, $output);
        $code = $output['code'];

        $response = $client->post(
            'https://cloud.estimote.com/v1/oauth2/access_token',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                ],
            ]
        );

        $json = \GuzzleHttp\json_decode($response->getBody(), true);

        return $json['access_token'];
    }

    public function getAccessToken($authorizationCode, $clientId, $clientSecret)
    {
        $client = new GuzzleClient();
        $response = $client->post(
            'https://cloud.estimote.com/v1/oauth2/access_token',
            [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'code' => $authorizationCode,
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                ],
            ]
        );

        $json = \GuzzleHttp\json_decode($response->getBody(), true);

        return $json['access_token'];
    }

    public function generateApplicationForAccess($username, $password, $applicationName)
    {
        $client = new GuzzleClient(['cookies' => true, 'allow_redirects' => true]);

        // Login into the portal.
        $client->post(
            'https://cloud.estimote.com/v1/login',
            [
                'headers' => [
                    'Content-Type' => '	application/json',
                ],
                'json' => array('username' => $username, 'password' => $password),
            ]
        );

        $response = $client->post(
            'https://cloud.estimote.com/v1/applications',
            [
                'json' => [
                    'name' => $applicationName,
                    'description' => $applicationName,
                    'template' => 'your-own-app',
                ],
            ]
        );

        $json = \GuzzleHttp\json_decode($response->getBody(), true);

        return new ApplicationAuthorization($json['name'], $json['token']);
    }
}
