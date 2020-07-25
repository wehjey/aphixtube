<?php

namespace App\Repositories;

use App\Repositories\Interfaces\YoutubeRepositoryInterface;

class YoutubeRepository implements YoutubeRepositoryInterface
{

    private $_MAX_RESULTS = 12; // Default number of results
    private $_baseUrl;
    private $_apiKey;

    /**
     * Constructor
     * Set base url and api key
     */
    public function __construct()
    {
        $this->_baseUrl = config('app.youtube_url');
        $this->_apiKey = config('app.youtube_api_key');
    }

    /**
     * Search youtube API
     * Returns a list of youtube videos and channels
     *
     * @param array $data contains request payload [keyword, pageToken]
     * 
     * @return array
     */
    public function search($data)
    {
        $requestUrl = "{$this->_baseUrl}/search?key={$this->_apiKey}&part=snippet&maxResults={$this->_MAX_RESULTS}";

        if (isset($data['query']) && $data['query'] != '') {
            $requestUrl .= '&q=' . urlencode($data['query']);
        }

        if (isset($data['pageToken']) && $data['pageToken'] != '') {
            $requestUrl .= "&pageToken={$data['pageToken']}";
        }

        $response = makeRequest($requestUrl, 'GET');

        if ($response['success'] && !isset($response['data']['error'])) {
            return $response;
        }

        return [
                'success' => false,
                'data' => null,
                'error' => 'No search result(s) available'
            ];
    }

}