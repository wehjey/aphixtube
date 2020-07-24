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
        "Accept: application/json"
    ];

    $options = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => $headers,
    ];

    if ($data) {
        array_push(
            $options, [
                CURLOPT_POSTFIELDS => json_encode($data)
            ]
        );
    }

    curl_setopt_array(
        $curl,
        $options
    );

    $response = curl_exec($curl);
    $err = curl_error($curl);

    if (!$err) {
        $result = [
            'success' => true,
            'data' => json_decode($response, true)
        ];
    } else {
        $result = [
            'success' => false,
            'data' => null,
            'error' => $err
        ];
    }

    return $result;
}
