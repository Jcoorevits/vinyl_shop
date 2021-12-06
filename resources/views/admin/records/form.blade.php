@csrf

{{--@php--}}
{{--    // Or temporarily add this record-object to the form to simplify testing--}}
{{--    $record = (object)[];--}}
{{--    $record->artist = 'The Doors';--}}
{{--    $record->title = 'L.A. Woman';--}}
{{--    $record->title_mbid = 'e68f23df-61e3-4264-bfc3-17ac3a6f856b';--}}
{{--    $record->cover = null;--}}
{{--    $record->price = 21.99;--}}
{{--    $record->stock = 5;--}}
{{--    $record->genre_id = 1;--}}
{{--@endphp--}}
{{--
@php
    // Or temporarily add this record-object to the form to simplify testing
    $record = (object)[];
    $record->artist = 'Ramones';
    $record->title = 'End of the Century';
    $record->title_mbid = '58dcd354-a89a-48ea-9e6e-e258cb23e11d';
    $record->cover = null;
    $record->price = 19.90;
    $record->stock = 2;
    $record->genre_id = 2;
@endphp
--}}


<div class="row">
    <div class="col-8">
        <div class="form-group">
            <label for="artist">Artist</label>
            <input type="text" name="artist" id="artist"
                   class="form-control @error('artist') is-invalid @enderror"
                   placeholder="Artist name"
                   required
                   value="{{ old('artist', $record->artist ?? '') }}">
            @error('artist')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title"
                   class="form-control @error('title') is-invalid @enderror"
                   placeholder="Record title"
                   required
                   value="{{ old('title', $record->title ?? '') }}">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="title_mbid">Title MusicBrainz ID</label>
            <input type="text" name="title_mbid" id="title_mbid"
                   class="form-control @error('title_mbid') is-invalid @enderror"
                   placeholder="Title MusicBrainz ID (36 characters)"
                   required minlength="36" maxlength="36"
                   value="{{ old('title_mbid', $record->title_mbid ?? '') }}">
            @error('title_mbid')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="cover">Cover URL</label>
            <input type="text" name="cover" id="cover"
                   class="form-control @error('cover') is-invalid @enderror"
                   placeholder="Cover URL"
                   value="{{ old('cover', $record->cover ?? '') }}">
            @error('cover')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price"
                   class="form-control @error('price') is-invalid @enderror"
                   placeholder="Price"
                   required
                   step="0.01"
                   value="{{ old('price', $record->price ?? '') }}">
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock"
                   class="form-control @error('stock') is-invalid @enderror"
                   placeholder="Items in stock"
                   required
                   value="{{ old('stock', $record->stock ?? '') }}">
            @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="genre_id">Genre</label>
            <select name="genre_id" id="genre_id"
                    class="custom-select @error('genre_id') is-invalid @enderror"
                    required>
                <option value="">Select a genre</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}"
                        {{ (old('genre_id', $record->genre_id ?? '') ==  $genre->id ? 'selected' : '') }}>{{ ucfirst($genre->name) }}</option>
                @endforeach
            </select>
            @error('genre_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <p>
            <button type="submit" id="submit" class="btn btn-success">Save record</button>
        </p>
    </div>
    <div class="col-4">
        <img src="/assets/vinyl.png" alt="cover" class="img-thumbnail" id="coverImage">
    </div>
</div>
