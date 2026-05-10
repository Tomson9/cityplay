<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Riddle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class RiddleController extends Controller
{
    /**
     * Liste des énigmes.
     */
    public function index()
    {
        return Inertia::render('Admin/Riddles/Index', [
            'riddles' => Riddle::with('place.game')
                ->latest()
                ->get(),
        ]);
    }

    /**
     * Formulaire création.
     */
    public function create()
    {
        return Inertia::render('Admin/Riddles/Create', [
            'places' => Place::with('game')
                ->orderBy('name')
                ->get(),
        ]);
    }

    /**
     * Enregistrement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'place_id'   => ['required', 'exists:places,id'],
            'difficulty' => ['required', 'integer', 'min:1', 'max:5'],
            'question'   => ['required', 'string'],
            'image'      => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('riddles', 'public');
        }

        Riddle::create($validated);

        return redirect()
            ->route('admin.riddles.index')
            ->with('success', 'Énigme créée.');
    }

    /**
     * Formulaire édition.
     */
    public function edit(Riddle $riddle)
    {
        return Inertia::render('Admin/Riddles/Edit', [
            'riddle' => $riddle,
            'places' => Place::with('game')
                ->orderBy('name')
                ->get(),
        ]);
    }

    /**
     * Mise à jour.
     */
    public function update(Request $request, Riddle $riddle)
    {
        $validated = $request->validate([
            'place_id'   => ['required', 'exists:places,id'],
            'difficulty' => ['required', 'integer', 'min:1', 'max:5'],
            'question'   => ['required', 'string'],
            'image'      => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {

            if ($riddle->image) {
                Storage::disk('public')->delete($riddle->image);
            }

            $validated['image'] = $request
                ->file('image')
                ->store('riddles', 'public');
        }

        $riddle->update($validated);

        return redirect()
            ->route('admin.riddles.index')
            ->with('success', 'Énigme modifiée.');
    }

    /**
     * Suppression.
     */
    public function destroy(Riddle $riddle)
    {
        if ($riddle->image) {
            Storage::disk('public')->delete($riddle->image);
        }

        $riddle->delete();

        return redirect()
            ->route('admin.riddles.index')
            ->with('success', 'Énigme supprimée.');
    }
}