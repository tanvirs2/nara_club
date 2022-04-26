
@extends('layouts.master')

@section('container')

    <div class="container-fluid">
        <div>
            <div class="row">
                <div class="col">
                    <form action="{{ route('game-store') }}" method="post">
                        @csrf

                        <button class="btn btn-outline-success" onclick="return confirm('Are you sure to create new game?')">Start new Game</button>

                        <a class="btn btn-primary" href="{{ route('home', ['games' => 'all']) }}">All</a>
                        <a class="btn btn-info" href="{{ route('member-lib-list') }}">Member Library</a>
                        <br>
                        <br>
                    </form>
                </div>

            </div>
        </div>


        @php

            function gamePoint($game, $type){

                $gamePointObj = new StdClass;
                $gamePointObj->member_id = 0;
                $gamePointObj->member_name = 'Not Set';

                $gamePointObj->match_point = 0;
                $gamePointObj->club_point = 0;
                $gamePointObj->hunter_match_point = 0;


                if ($game->point){
                    if ($game->point->$type){

                        $gamePointObj = (object) array_merge(
                            (array) $gamePointObj,
                            (array) json_decode($game->point->$type)
                        );

                        $gamePointObj->match_point = $game->point->match_point;
                        $gamePointObj->club_point = $game->point->club_point;


                        if (json_decode($game->point->hunter)) {
                            $gamePointObj->hunter_match_point = $game->point->match_point;
                        }

                    }
                }

                return ($gamePointObj);
            }

        @endphp


        @if($type == 'single' && isset($games->member))
            @php
                //dd($games->member);
                  $game = $games;
                  $members = $game->member;
            @endphp

            @include('home.gameTable')

        @elseif($type == 'all')

            @foreach($games as $game)

                @php
                    $members = $game->member;
                @endphp

                @include('home.gameTable')

            @endforeach

        @endif

    </div>

@endsection
