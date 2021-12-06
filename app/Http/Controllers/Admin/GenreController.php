<?php

namespace App\Http\Controllers\Admin;

use App\Genre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Json;
use Route;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::orderBy('name')
            ->withCount('records')
            ->get();
        $result = compact('genres');
        Json::dump($result);
        return view('admin.genres.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate $request
        $this->validate($request,[
            'name' => 'required|min:3|unique:genres,name'
        ]);

        // Create new genre
        $genre = new Genre();
        $genre->name = $request->name;
        $genre->save();

        // Flash a success message to the session
        session()->flash('success', "The genre <b>$genre->name</b> has been added");
        // Redirect to the master page
        return redirect('admin/genres');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        return redirect('admin/genres');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        $result = compact('genre');
        Json::dump($result);
        return view('admin.genres.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        // Validate $request
        $this->validate($request,[
            'name' => 'required|min:3|unique:genres,name,' . $genre->id
        ]);

        // Update genre
        if ($request->name === $genre->name){
            session()->flash('danger', 'Not updated');
            return redirect('admin/genres'); // of else
        }
        $oldName = $genre->name;
        $genre->name = $request->name;
        $genre->save();

        // Flash a success message to the session
        session()->flash('success', "The genre <b>'$oldName'</b> has been updated to <span class='text-danger'>'$genre->name'</span>");
        // Redirect to the master page
        return redirect('admin/genres');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        session()->flash('success', "The genre <b>$genre->name</b> has been deleted");
        return redirect('admin/genres');
    }
}
