<?php

namespace App\Http\Controllers;

use App\Models\MemberLib;
use Illuminate\Http\Request;

class MemberLibController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allMembersFromLib = MemberLib::latest('id')->get();

        $comp = compact('allMembersFromLib');

        return view('memberLib.index', $comp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            "name" => "required",
        ]);

        $member = new MemberLib();
        $member->name = $request->name;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->address = $request->address;

        $member->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MemberLib  $memberLib
     * @return \Illuminate\Http\Response
     */
    public function show(MemberLib $memberLib)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MemberLib  $memberLib
     * @return \Illuminate\Http\Response
     */
    public function edit(MemberLib $memberLib)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MemberLib  $memberLib
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MemberLib $memberLib)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MemberLib  $memberLib
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemberLib $memberLib)
    {
        //
    }
}
