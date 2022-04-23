


<div class="border border-dark pe-3 mb-5 game-frame-for-js" style="background: #ffffff">

    <div class="row">
        <div class="col">
            <div class="m-3">
                <b class="text-info"> {{ $game->name }} - ( {{ $game->created_at->format('h:i') }} )</b>

                {{--{{ $game->created_at->toDateString() }} {{ $game->name }}--}}

                @if($type !== 'single')

                    <a class="btn btn-warning" href="{{ route('home', ['id' => $game->id]) }}" target="_blank">Open this Game to different tab</a>

                @endif

                <br>

                <div class="row">
                    <div class="col-5">
                        <form action="{{ route('member-store') }}" method="post">
                            @csrf
                            <input type="hidden" name="game_id" size="6" value="{{ $game->id }}">
                            <input type="text" name="name" placeholder="name">
                            <input type="text" name="email" placeholder="email">
                            <input type="text" name="phone" placeholder="phone">
                            <input type="text" name="address" placeholder="address">
                            <button class="btn btn-outline-success">Save Player</button>
                        </form>

                        <label for="selectMember">Winner</label>
                        <select name="winner" class="form-select form-select-sm" aria-label="selectMember">
                            <option value="" selected>Select a member...</option>

                            @foreach($members as $member)
                                <option value='{"member_id":"{{$member->id}}", "member_name":"{{$member->name}}"}'>{{$member->name}}</option>
                            @endforeach

                        </select>

                    </div>

                    <div class="col-1">
                        <div class="border border-success rounded ps-2">
                            {{ $game->created_at->format('y-m-d') }}
                        </div>
                    </div>

                    <div class="col">

                        <form action="{{ route('point-store') }}" method="post">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="game_id" size="6" value="{{ $game->id }}">

                                <div class="col">Match - {{ $game->point ? $game->point->match_point : 0 }} <input type="text" name="match_point" placeholder="Point"> </div>
                                <div class="col text-danger">Club - {{ $game->point ? $game->point->club_point : 0 }} <input type="text" name="club_point" placeholder="Point"> </div>

                                <div class="col">
                                    <label for="Default select example">Winner</label>
                                    <select name="winner" class="form-select form-select-sm" aria-label="Default select example">
                                        <option value="" selected>Select a member...</option>

                                        @foreach($members as $member)
                                            <option value='{"member_id":"{{$member->id}}", "member_name":"{{$member->name}}"}'>{{$member->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col">
                                    <label>Hunter </label>
                                    <select name="hunter" class="form-select form-select-sm" aria-label="Default select example2">
                                        <option value="" selected>Select a member...</option>

                                        @foreach($members as $member)
                                            <option value='{"member_id":"{{$member->id}}", "member_name":"{{$member->name}}"}'>{{$member->name}}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col text-danger">
                                    <button class="btn btn-success">Save Info</button>
                                    <a class="btn btn-danger" onclick="return confirm('delete ?')" href="{{ route('game-delete', $game->id) }}">Delete</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>




                <hr class="bg-danger border border-danger">

            </div>
        </div>

    </div>

    <div class="row">
        @php

            $colorIndex = 1;

        @endphp

        @foreach($members as $member)

            <div class="col ms-3 p-0">
                <div style="background: {{ isset($colors[$colorIndex]) ? $colors[$colorIndex++] : $colors[0] }}">

                    <table class="table table-bordered">
                        <tr>
                            <th colspan="2">{{ $member->name }}</th>
                        </tr>

                        @php
                            $prevScore = 0;
                        @endphp

                        @foreach($member->score as $k=>$score)

                            <tr>
                                <td>


                                    {{$prevScore}}

                                    {{--{{ $score->multiply ? $prevScore * $score->multiply : $prevScore}}--}}


                                </td>
                                <td>

                                    @if((count($member->score) - $k) == 1 )
                                        <form action="{{ route('score-update', $score->id) }}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="member_id" size="6" value="{{ $member->id }}">

                                            <table>
                                                <tr>
                                                    <td>
                                                        <label>
                                                            <input type="number" name="score" size="6" value="{{ $score->score }}" style="background: {{$colors[$colorIndex-1]}}">
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-dark">Update</button>
                                                    </td>
                                                    <td>
                                                        &nbsp;<span> @if($score->multiply) * @endif </span>
                                                        {{--<button class="btn btn-sm @if($score->multiply) btn-danger @endif btn-secondary" name="multiply" value="2">*</button>--}}
                                                    </td>
                                                </tr>
                                            </table>

                                        </form>
                                    @else

                                        <table>
                                            <tr>
                                                <td>
                                                    {{ $score->score }}
                                                </td>
                                                <td>
                                                    <span> @if($score->multiply) * @endif </span>
                                                </td>
                                            </tr>
                                        </table>

                                    @endif



                                </td>
                            </tr>

                            @php
                                $prevScore = $prevScore + $score->score;
                            @endphp

                        @endforeach

                        {{--Score save area--}}
                        <tr class="bg-white">
                            <td>

                                <b class="prev-score-td-for-js">{{ $prevScore }}</b>

                            </td>

                            <td>
                                <form action="{{ route('score-store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="member_id" value="{{ $member->id }}">

                                    <table>
                                        <tr>
                                            <td>
                                                <input type="text" name="score">
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-dark">Save</button>
                                                <button class="btn btn-sm btn-outline-danger" name="multiply" value="2">*</button>
                                            </td>
                                        </tr>
                                    </table>

                                </form>
                            </td>
                        </tr>
                        {{--End Score save area--}}

                    </table>

                </div>
            </div>

        @endforeach
    </div>

    <br>

    <div class="row">
        <div class="col"></div>

        <div class="col">
            <div class="alert alert-success ms-3 d-flex justify-content-center" role="alert">
                @php

                    $gamePointData = gamePoint($game, 'winner');

                @endphp

                Winner : {{ $gamePointData->member_name }}

                <br>

                Point : {{ (((count($members) - 1) * $gamePointData->match_point) - $gamePointData->club_point) - $gamePointData->hunter_match_point }}

            </div>
        </div>

        <div class="col">
            <div class="alert alert-danger d-flex justify-content-center" role="alert">

                @php

                    $gamePointData = gamePoint($game, 'hunter');

                @endphp

                Hunter : {{ $gamePointData->member_name }}

                <br>

                Point : {{ $gamePointData->match_point }}
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>
