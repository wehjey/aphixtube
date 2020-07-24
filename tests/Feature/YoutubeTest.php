<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class YoutubeTest extends TestCase
{
    /**
     * User can search for videos with query string
     *
     * @return void
     */
    public function testUserCanSearchForVideosWithQuery()
    {
        $response = $this->get('/search?query=php');

        $response->assertStatus(200)
            ->assertJsonStructure(
                [
                    'success',
                    'data' => [
                        'kind',
                        'etag',
                        'regionCode',
                        'pageInfo',
                        'items'
                    ]
                ]
            );
    }

    /**
     * User can search for videos without query string
     *
     * @return void
     */
    public function testUserCanSearchForVideosWithoutQuery() 
    {
        $response = $this->get('/search');

        $response->assertStatus(200)
            ->assertJsonStructure(
                [
                    'success',
                    'data' => [
                        'kind',
                        'etag',
                        'regionCode',
                        'pageInfo',
                        'items'
                    ]
                ]
            );
    }

    /**
     * User can view next page
     *
     * @return void
     */
    public function testUserCanViewNextPage() 
    {
        $response = $this->get('/search');

        if ($response['success'] && isset($response['data']['nextPageToken'])) {

            $nextPageResponse = $this->get("/search?pageToken={$response['data']['nextPageToken']}");

            $nextPageResponse->assertStatus(200)
                ->assertJsonStructure(
                    [
                        'success',
                        'data' => [
                            'kind',
                            'etag',
                            'prevPageToken',
                            'regionCode',
                            'pageInfo',
                            'items'
                        ]
                    ]
                );
        }
    }

    /**
     * User can view next page
     *
     * @return void
     */
    public function testUserMustEnterValidPageToken() 
    {
        $response = $this->get('/search?pageToken=invalidtoken');

        $response->assertStatus(200)
            ->assertJson(
                [
                    'success' => false,
                    'data' => null,
                    'error' => 'No search result(s) available'
                ]
            );
    }
}
