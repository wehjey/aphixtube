<?php

/**
 * Helper file for general functions
 */

/**
 * Make http cURL request to endpoint
 *
 * @param string $url    Endpoint url
 * @param string $method Request method e.g GET, POST
 * @param array  $data   Request payload
 *
 * @return array
 */
function makeRequest($url, $method, $data = [])
{
    $curl = curl_init();

    $headers = [
        "content-type: application/json",
        "cache-control: no-cache"
    ];

    curl_setopt_array(
        $curl,
        array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => $headers,
        )
    );

    $response = curl_exec($curl);
    $err = curl_error($curl);

    $result = [];

    if (!$err) {
        $result = [
          'status' => true,
          'data' => json_decode($response, true)
        ];
    } else {
        $result = [
          'status' => false,
          'data' => null,
          'error' => $err
        ];
    }

    return $result;
}
