<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YoutubeController extends Controller
{

    private $_MAX_RESULTS = 12; // Default number of results

    /**
     * Function to search query youtube API
     * Search keyword and page token are optional params and only used if available
     *
     * @param Request $request contain query params
     * 
     * @return json
     */
    public function search(Request $request) 
    {
        $baseUrl = config('app.youtube_url');
        $apiKey = config('app.youtube_api_key');

        $requestUrl = "{$baseUrl}/search?key={$apiKey}&part=snippet&maxResults={$this->_MAX_RESULTS}";

        if (request()->has('query') && request('query') != '') {
            $requestUrl .= "&q={$request['query']}";
        }

        if (request()->has('pageToken') && request('pageToken') != '') {
            $requestUrl .= "&pageToken={$request['pageToken']}";
        }

        $response = makeRequest($requestUrl, 'GET');

        if ($response['success'] && !isset($response['data']['error'])) {
            return response()->json($response);
        }

        return response()->json(
            [
                'success' => false,
                'data' => null,
                'error' => 'No search result(s) available'
            ]
        );
    }
}
