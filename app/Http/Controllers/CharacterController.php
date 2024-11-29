<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index()
    {
        return Character::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'movie_id' => 'required|exists:movies,id',
            'picture' => 'required|url',
            'description' => 'required|string',
        ]);

        $character = Character::create($request->all());

        return response()->json($character, 201);
    }

    public function show($id)
    {
        $character = Character::findOrFail($id);

        return response()->json($character);
    }

    public function update(Request $request, $id)
    {
        $character = Character::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string',
            'movie_id' => 'sometimes|exists:movies,id',
            'picture' => 'sometimes|url',
            'description' => 'sometimes|string',
        ]);

        $character->update($request->all());

        return response()->json($character);
    }

    public function destroy($id)
    {
        $character = Character::findOrFail($id);
        $character->delete();

        return response()->json(null, 204);
    }
}
