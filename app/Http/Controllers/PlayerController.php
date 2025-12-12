<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = Player::all();
    
    return view('players.index', [
        'players' => $players
    ]);
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('players.create', [
            'positions' => ['PG', 'SG', 'SF', 'PF', 'C'],
            'teams' => ['LAL', 'GSW', 'BOS', 'MIA', 'CHI', 'MIL', 'DAL']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'fullname' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:50',
            'team' => 'nullable|string|max:10',
            'number' => 'nullable|integer|min:0|max:99',
            'img_url' => 'nullable|url',
            'height' => 'nullable|string|max:20',
            'weight' => 'nullable|string|max:20',
            'age' => 'nullable|integer|min:16|max:60',
            'ppg' => 'nullable|numeric|min:0|max:50',
            'rpg' => 'nullable|numeric|min:0|max:30',
            'apg' => 'nullable|numeric|min:0|max:20',
            'bio' => 'nullable|string',
        ]);

        $player = Player::create($validated);

        return redirect()->route('players.show', $player->id)
                         ->with('success', 'Игрок успешно создан!');
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $player = Player::find($id);

        if (!$player){

            abort(404, 'Игрок не найден');

        }
        $totalPlayers = Player::count();


        return view('players.show', [
            'player' => $player,
            'totalPlayers' => $totalPlayers
        ]);
        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)  
    {
        $player = Player::find($id);

        if (!$player) {
            abort(404, 'Игрок не найден');
        }

        return view('players.edit', [
            'player' => $player,
            'positions' => ['PG', 'SG', 'SF', 'PF', 'C'],
            'teams' => ['LAL', 'GSW', 'BOS', 'MIA', 'CHI', 'MIL', 'DAL']
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)  
    {
        $player = Player::find($id);

        if (!$player){
            abort(404, 'Игрок не найден');
            
        }
        
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'fullname' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:50',
            'team' => 'nullable|string|max:10',
            'number' => 'nullable|integer|min:0|max:99',
            'img_url' => 'nullable|url',
            'height' => 'nullable|string|max:20',
            'weight' => 'nullable|string|max:20',
            'age' => 'nullable|integer|min:16|max:60',
            'ppg' => 'nullable|numeric|min:0|max:50',
            'rpg' => 'nullable|numeric|min:0|max:30',
            'apg' => 'nullable|numeric|min:0|max:20',
            'bio' => 'nullable|string',
        ]);

        $player->update($validated);

        return redirect()->route('players.show', $player->id)
                         ->with('success', 'Данные игрока обновлены!');
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $player = Player::find($id);

        if (!$player){
            abort(404, 'Игрок не найден');
            
        }

        $playerName = $player->name;
        $player->delete();

        return redirect()->route('players.index')
                         ->with('success', "Игрок '$playerName' успешно удален!");
        
        
    }
}