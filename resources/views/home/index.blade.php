<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Document</title>
    <style>
        input {outline: none;border: hidden;width: 60px}
        #main-tbl-list {overflow-x: hidden; white-space: nowrap; border: 1px solid black; margin-bottom: 10px; padding: 3px;} /*#fa0202 box-shadow: 2px 2px 5px rgba(32,32,32,0.8)*/

    </style>
</head>
<body>

<div class="container-fluid">
    <div>
        <div class="row">
            <div class="col">
                <form action="{{ route('game-store') }}" method="post">
                    @csrf
                    <input type="text" name="name" placeholder="Game name"> &nbsp;&nbsp; |
                    <button>Start new Game</button>
                    <br>
                    <br>
                </form>
            </div>

        </div>
    </div>



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

</body>
</html>
