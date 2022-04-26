<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Member;
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

        $membersFromLib = MemberLib::latest('id')->get();
        /*$uniqueMember = Member::all()->unique('name');

        //dd($uniqueMember);

        foreach ($uniqueMember as $m) {
            $memberLibForInsert = new MemberLib();
            if ($m->name) {
                $memberLibForInsert->name = $m->name;
                $memberLibForInsert->email = $m->email;
                $memberLibForInsert->phone = $m->phone;
                $memberLibForInsert->address = $m->address;
                $memberLibForInsert->save();
            }

        }

        //dd($uniqueMember);


        foreach (Member::all() as $m2) {
            if ($m2->name) {
                $mLib = MemberLib::where('name', $m2->name)->first();
                $m2->member_lib_id = $mLib->id;
                $m2->save();
            }
        }

        dd($uniqueMember);*/

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
