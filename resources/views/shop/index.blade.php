@extends('layouts.template')

@section('title', 'Shop')

@section('main')
    <h1>Shop</h1>
    @include('shop.search')
    @if ($records->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show">
            Can't find any artist or album with <b>'{{ request()->artist }}'</b> for this genre
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif
    {{ $records->withQueryString()->links() }}
    <div class="row">
        @foreach($records as $record)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card">
                    <img class="card-img-top" src="{{$record['cover']}}" alt="{{$record->artist}} {{$record->title}}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $record->artist }}</h5>
                        <p class="card-text">{{$record['title']}}</p>
                        <a href="shop/{{ $record->id }}" class="btn btn-outline-info btn-sm btn-block">Show details</a>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <p>{{ucfirst($record->genre->name)}}</p>
{{--                        <p>{{ucfirst($record->genre->name)}}</p>--}}
                        <p>
                            € {{$record->price}}
                            <span class="ml-3 badge {{$record->badge}}">{{$record->stock}}</span>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $records->withQueryString()->links() }}

@endsection
