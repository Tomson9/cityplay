<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GameController extends Controller
{
    /**
     * Liste des jeux.
     */
    public function index()
    {
        return Inertia::render('Admin/Games/Index', [
            'games' => Game::latest()->get(),
        ]);
    }

    /**
     * Formulaire création.
     */
    public function create()
    {
        return Inertia::render('Admin/Games/Create');
    }

    /**
     * Enregistrement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        Game::create($validated);

        return redirect()
            ->route('admin.games.index')
            ->with('success', 'Parcours créé avec succès.');
    }

    /**
     * Formulaire édition.
     */
    public function edit(Game $game)
    {
        return Inertia::render('Admin/Games/Edit', [
            'game' => $game,
        ]);
    }

    /**
     * Mise à jour.
     */
    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $game->update($validated);

        return redirect()
            ->route('admin.games.index')
            ->with('success', 'Parcours modifié avec succès.');
    }

    /**
     * Suppression.
     */
    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()
            ->route('admin.games.index')
            ->with('success', 'Parcours supprimé.');
    }
}