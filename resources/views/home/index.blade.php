<!doctype html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/ncl_icon.ico') }}">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Document</title>
    <style>
        body {
            font-size: 150%;
        }
        input {outline: none;border: hidden;width: 100px}
        #main-tbl-list {overflow-x: hidden; white-space: nowrap; border: 1px solid black; margin-bottom: 10px; padding: 3px;} /*#fa0202 box-shadow: 2px 2px 5px rgba(32,32,32,0.8)*/

    </style>
</head>
<body style="background: #e5e5e5">

<div class="container-fluid">
    <div>
        <div class="row">
            <div class="col">
                <form action="{{ route('game-store') }}" method="post">
                    @csrf
                    <input type="text" name="name" placeholder="Game name" style="width: 130px;background: #e5e5e5"> &nbsp;&nbsp;
                    <button class="btn btn-outline-success">Start new Game</button>
                    <a class="btn btn-primary" href="{{ route('home', ['games' => 'all']) }}">All</a>
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



<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="{{asset('js/app.js')}}"></script>
<script>

/*

    (function() {

        //statements...

    })();

    (function (window) {
        window.__env = window.__env || {};

        window.__env.apiBaseUrl = "https://data.connectify.me:4433";

    }(this));

*/

    window.onload = () => {
        const gameFrames = document.querySelectorAll(".game-frame-for-js")

        gameFrames.forEach((gameFrame, index)=>{

            let prevScoresTd = gameFrame.querySelectorAll(".prev-score-td-for-js")

            let scoreObj = [...prevScoresTd].map((prevScoreTd, scoreIndex)=>{

                return {
                    elm: prevScoreTd, prevScore: Number(prevScoreTd.innerText)
                };

            });

            let collection = collect_js(scoreObj);

            let maxObj = collection.first(item => item.prevScore === collection.max('prevScore'))
            let minObj = collection.first(item => item.prevScore === collection.min('prevScore'))


            maxObj && maxObj.elm.parentElement.classList.add("bg-danger", "text-light");
            minObj && minObj.elm.parentElement.classList.add("bg-success", "text-light");

            //maxObj && maxObj.elm.parentElement.classList.remove("bg-white");
            //minObj && minObj.elm.parentElement.classList.remove("bg-white");

            //maxObj && maxObj.elm.parentElement.setAttribute("style", "background-color:red !important");
            //minObj && minObj.elm.parentElement.setAttribute("style", "background-color:green !important");

            //maxObj && maxObj.elm.parentElement.classList.remove("text-dark");
            //minObj && minObj.elm.parentElement.classList.remove("text-dark");


            //console.log(index, '--->', maxObj );

        });


        //prevScore prev-score-td-for-js
    }

</script>


</body>
</html>
