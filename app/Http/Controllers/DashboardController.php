<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\MemberLib;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Game::with('member.score', 'point')->where('status', 'running');
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

        if ($request->has('id')) {
            $games = $query->find($request->get('id'));
        }

        $membersFromLib = MemberLib::all();



        //dd($memberFromLib);
        //dd(count($games));
        //dd($games->member);

        //orderBy('id', 'desc')->first();


        //$games = $query->orderBy('id', 'desc');
        //dd($query->latest()->get());
        //dd($games);
        //return $members;
        //$members->load('score');
        //dd($members);
        //dd(Member::find(1)->score);

        $colors = [
            '',
            '#74b9ff',
            '#fab1a0',
            '#ffeaa7',
            '#81ecec',
            '#fd79a8',
            '#a29bfe',
            '#e17055',
        ];

        $comp = compact('games', 'type', 'colors', 'membersFromLib');

        //return $members;
        return view('home.index', $comp);
    }
}
