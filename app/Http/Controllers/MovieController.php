<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        return Movie::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'classification' => 'required|string',
            'release_date' => 'required|date',
            'review' => 'required|string',
            'season' => 'nullable|integer',
        ]);

        $movie = Movie::create($request->all());

        return response()->json($movie, 201);
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);

        return response()->json($movie);
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string',
            'classification' => 'sometimes|string',
            'release_date' => 'sometimes|date',
            'review' => 'sometimes|string',
            'season' => 'nullable|integer',
        ]);

        $movie->update($request->all());

        return response()->json($movie);
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return response()->json(null, 204);
    }
}
