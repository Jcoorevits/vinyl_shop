@extends('layouts.template')

@section('main')
    <h1>iTunes {{$response['feed']['title']}} - {{strtoupper($response['feed']['country'])}}</h1>
    <p>Last updated: {{Carbon\Carbon::parse($createdAt)->format('F d Y')}} || {{Carbon\Carbon::now()}} example</p>
    <div class="row">
        @foreach($results as $result)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card">
                    <img class="card-img-top" src="{{$result['artworkUrl100']}}" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{$result['artistName']}}</h5>
                        <p class="card-text">{{$result['name']}}</p>
                        <hr>
                        <p>Genre: {{$result['genres'][0]['name']}} </p>
                        <p>Artist Url: <a href="{{$result['artistUrl']}}">{{$result['artistName']}}</a> </p>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
@endsection
