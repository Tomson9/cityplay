<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Place;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlaceController extends Controller
{
    /**
     * Liste des lieux.
     */
    public function index()
    {
        return Inertia::render('Admin/Places/Index', [
            'places' => Place::with('game')
                ->orderBy('order')
                ->get(),
        ]);
    }

    /**
     * Formulaire création.
     */
    public function create()
    {
        return Inertia::render('Admin/Places/Create', [
            'games' => Game::orderBy('title')->get(),
        ]);
    }

    /**
     * Enregistrement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_id'    => ['required', 'exists:games,id'],
            'name'       => ['required', 'string', 'max:255'],
            'latitude'   => ['required', 'numeric'],
            'longitude'  => ['required', 'numeric'],
            'description'=> ['required', 'string'],
            'order'      => ['required', 'integer'],
        ]);

        Place::create($validated);

        return redirect()
            ->route('admin.places.index')
            ->with('success', 'Lieu ajouté.');
    }

    /**
     * Formulaire édition.
     */
    public function edit(Place $place)
    {
        return Inertia::render('Admin/Places/Edit', [
            'place' => $place,
            'games' => Game::orderBy('title')->get(),
        ]);
    }

    /**
     * Mise à jour.
     */
    public function update(Request $request, Place $place)
    {
        $validated = $request->validate([
            'game_id'    => ['required', 'exists:games,id'],
            'name'       => ['required', 'string', 'max:255'],
            'latitude'   => ['required', 'numeric'],
            'longitude'  => ['required', 'numeric'],
            'description'=> ['required', 'string'],
            'order'      => ['required', 'integer'],
        ]);

        $place->update($validated);

        return redirect()
            ->route('admin.places.index')
            ->with('success', 'Lieu modifié.');
    }

    /**
     * Suppression.
     */
    public function destroy(Place $place)
    {
        $place->delete();

        return redirect()
            ->route('admin.places.index')
            ->with('success', 'Lieu supprimé.');
    }
}