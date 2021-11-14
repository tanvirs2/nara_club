<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {border:1px solid #1804f6; display: inline-block; margin: 10px}
        tr, td {border:1px solid black; padding: 5px}
        input {outline: none;border: hidden;width: 80px}
        .main-tbl {overflow-x: scroll; white-space: nowrap}
        .main-tbl-list {overflow-x: hidden; white-space: nowrap; border: 1px solid black; margin-bottom: 10px; padding: 3px;} /*#fa0202 box-shadow: 2px 2px 5px rgba(32,32,32,0.8)*/
        .float {
            float: left;
            padding: 10px;
            border: 1px solid black;
        }
    </style>
</head>
<body>

<form action="{{ route('game-store') }}" method="post">
    @csrf
    <input type="text" name="name" placeholder="Game name"> &nbsp;&nbsp; |
    <button>Start new Game</button>
    <br>
    <br>
</form>

@if($type == 'single')
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










</body>
</html>
