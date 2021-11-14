<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Game::with('member.score');
        //$query = Member::with('score');
        //$query = $query->latest();
        //$query = $query->where('name', 'ff');
        //$query2 = $query;

        $type = 'single';
        if ($request->has('games') && $request->get('games') == 'all') {
            $type = 'all';
            $games = $query->orderBy('id', 'desc')->get();
        } else {
            $games = $query->orderBy('id', 'desc')->first();
        }


        //$games = $query->orderBy('id', 'desc');
        //dd($query->latest()->get());
        //dd($games);
        //return $members;
        //$members->load('score');
        //dd($members);
        //dd(Member::find(1)->score);

        $comp = compact('games', 'type');

        //return $members;
        return view('home.index', $comp);
    }
}
