<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Record;
use Http;
use Illuminate\Http\Request;
use Json;

class ShopController extends Controller
{
    // Master Page: http://vinyl_shop.test/shop or http://localhost:3000/shop
    public function index(Request $request)
    {

        $artist = '%' . $request->artist . '%';
        $genre_id = $request->genre_id ?? '%';

        $genres = Genre::orderBy('name')
            ->has('records')
            ->withCount('records')
            ->get()
            ->transform(function ($genre, $key) {
                $genre->name = ucfirst($genre->name) . " ({$genre->records_count})";
                return $genre;

            })
            ->makeHidden(['updated_at', 'created_at', 'records_count']);

        $records = Record::with('genre')
            ->where([['artist', 'like', $artist],
                ['genre_id', 'like', $genre_id]
            ])
            ->paginate(8);

        foreach ($records as $record) {

            $result = compact('genres', 'records');

            $record->price = number_format($record->price, 2);
            $record->genre->name = ucfirst($record->genre->name);
            $record->badge = ($record->stock > 0) ? 'badge-success' : 'badge-danger';
            if (!$record->cover) {
                $record->cover = "https://coverartarchive.org/release/{$record->title_mbid}/front-250.jpg'";
//                $record->cover = $record->cover ?? "https://coverartarchive.org/release/{$record->title_mbid}/front-250.jpg";
            }
        }
        $result = compact('genres', 'records');           // compact('records') is the same as ['records' => $records]
        Json::dump($result);                    // open http://vinyl_shop.test/shop?json
        return view('shop.index', $result);     // add $result as second parameter// get all records
//        dd($records);                           // 'dump' the collection and 'die' (stop execution)
//        return view('shop.index', ['records'=> $records]);
    }

    // Detail Page: http://vinyl_shop.test/shop/{id} or http://localhost:3000/shop/{id}
    public function show($id)
    {

        $record = Record::with('genre')->findOrFail($id);

        $record->cover = $record->cover ?? "https://coverartarchive.org/release/$record->title_mbid/front-500.jpg";
        // Combine artist + title
        $record->title = $record->artist . ' - ' . $record->title;
        // Links to MusicBrainz API
        // https://wiki.musicbrainz.org/Development/JSON_Web_Service
        $record->recordUrl = 'https://musicbrainz.org/ws/2/release/' . $record->title_mbid . '?inc=recordings+url-rels&fmt=json';
        // If stock > 0: button is green, otherwise the button is red
        $record->btnClass = $record->stock > 0 ? 'btn-outline-success' : 'btn-outline-danger disabled';
        // You can't overwrite the attribute genre (object) with a string, so we make a new attribute
        $record->genreName = $record->genre->name;
        // Hide attributes you don't need for the view*

        $record->price = number_format($record->price, 2);

        $record->makeHidden(['genre', 'artist', 'genre_id', 'created_at', 'updated_at', 'title_mbid', 'genre']);

        // get record info and convert it to json
        $response = Http::get($record->recordUrl)->json();


        $tracks = $response['media'][0]['tracks'];
        /*foreach ($tracks as $track){
            $track['length'] = date('i:s', $track['length'] / 1000);
            unset($track['id'], $track['recording'], $track['number']);
            return $track;
        }
        dump($tracks);*/
        $tracks = collect($tracks)
            ->transform(function ($item, $key) {
                $item['length'] = date('i:s', $item['length'] / 1000);
                unset($item['id'], $item['recording'], $item['number']);
                return $item;
            });

        $result = compact('tracks', 'record');
        Json::dump($result);
        return view('shop.show', $result);  // Pass $result to the view
    }
}
