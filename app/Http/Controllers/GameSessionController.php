<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Sessionn;
use App\Models\SessionnPlace;
use Inertia\Inertia;
use Illuminate\Http\Request;

class GameSessionController extends Controller
{
    public function index()
    {
        $sessions = Sessionn::with('game')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return Inertia::render('GameSessions/Index', [
            'sessions' => $sessions,
        ]);
    }

    public function create(Game $game)
    {
        $gameData = [
            'id' => $game->id,
            'title' => $game->title,
            'description' => $game->description,
        ];

        return Inertia::render('GameSessions/Create', [
            'game' => $gameData,
        ]);
    }

    public function store(Request $request, Game $game)
    {
        $validated = $request->validate([
            'difficulty' => ['required', 'integer', 'min:1', 'max:3'],
            'transport_type' => ['required', 'string'],
            'team_size' => ['required', 'integer', 'min:1'],
            'children_under_10' => ['nullable', 'integer'],
        ]);

        $session = Sessionn::create([
            'user_id' => auth()->id(),
            'game_id' => $game->id,
            'difficulty' => $validated['difficulty'],
            'transport_type' => $validated['transport_type'],
            'team_size' => $validated['team_size'],
            'children_under_10' => $validated['children_under_10'] ?? 0,
            'status' => 'active',
        ]);

        foreach ($game->places as $place) {
            SessionnPlace::create([
                'sessionn_id' => $session->id,
                'place_id' => $place->id,
                'validated' => false,
            ]);
        }

        return redirect()->route('gamesession.show', $session->id);
    }

    public function show(Sessionn $session)
    {
        $session->load([
            'game',
            'sessionnPlaces.place.riddles',
        ]);

        $nextSessionPlace = $session->sessionnPlaces
            ->where('validated', false)
            ->sortBy(fn ($sp) => $sp->place->order ?? 0)
            ->first();

            // dd($nextSessionPlace);
        $nextPlace = $nextSessionPlace?->place;

        $riddle = null;
        if ($nextPlace) {
            $riddle = $nextPlace->riddles
                ->where('difficulty', $session->difficulty)
                ->first();
        }
// dd($nextPlace->riddles, [
//             'session' => $session,
//             'nextPlace' => $nextPlace,
//             'riddle' => $riddle,
// ]);
        return Inertia::render('GameSessions/Show', [
            'session' => $session,
            'nextPlace' => $nextPlace,
            'riddle' => $riddle,
        ]);
    }

    public function destroy(Sessionn $session)
    {
        $session->delete();

        return redirect()->route('sessions.index');
    }
}
