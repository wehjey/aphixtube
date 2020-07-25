<?php

namespace App\Http\Controllers;

use App\Repositories\YoutubeRepository;

class YoutubeController extends Controller
{
    
    /**
     * Function to search query youtube API
     * Search keyword and page token are optional params and only used if available
     * 
     * @param \App\Repositories\YoutubeRepository $youtubeRepository
     * 
     * @return json
     */
    public function search(YoutubeRepository $youtubeRepository) 
    {
        $data = $youtubeRepository->search(request()->only(['query', 'pageToken']));
        return response()->json($data);
    }
}
