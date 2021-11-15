<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;
use Json;

class ItunesController extends Controller
{
    public function index()
    {

        $response = Http::get('https://rss.applemarketingtools.com/api/v2/be/music/most-played/12/songs.json')->json();

        $results = $response['feed']['results'];
        $createdAt = $response['feed']['updated'];

        $results = collect($results)->transform(function ($item, $key) {
                $item['artworkUrl100'] = str_replace('100x100', '500x500', $item['artworkUrl100']);
                return $item;
            });


        $data = compact('response', 'results', 'createdAt');

        Json::dump($data);

        return view('itunes', $data);
    }
}
