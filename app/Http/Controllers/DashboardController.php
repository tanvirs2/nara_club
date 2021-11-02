<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $query = Member::with('score');

        //$query = $query->where('name', 'ff');

        $members = $query->get();

        //$members->load('score');
        //dd($members);
        //dd(Member::find(1)->score);

        $comp = compact('members');

        //return $members;
        return view('home.index', $comp);
    }
}
