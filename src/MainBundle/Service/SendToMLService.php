<?php

namespace MainBundle\Service;

use Firebase\FirebaseLib;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

/**
 * Class SendToMLService
 * @package MainBundle\Service
 */
abstract class SendToMLService
{
    /**
     * @param string $url
     * @param string $body
     * @param string $msToken
     * @return string
     */
    public function send($url, $body, $msToken)
    {
        try {
            $headers = [
                'Authorization' => sprintf('Bearer %s', $msToken),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];

            $client = new Client();
            $response = $client->post($url, [
                'body' => $body,
                'headers' => $headers,
            ]);

            return $response->getBody()->getContents();
        } catch (ClientException $e) {
            throw $e;
        } catch (ServerException $e) {
            throw $e;
        }
    }

    /**
     * @param array  $formattedArray
     * @param string $url
     * @param string $token
     * @param string $path
     * @return void
     */
    public function sendToFirebase($formattedArray, $url, $token, $path)
    {
        $firebase = new FirebaseLib($url, $token);
        $firebase->push($path, $formattedArray);
    }
}