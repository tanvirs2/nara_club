

<div class="border border-dark pe-3 mb-5 game-frame-for-js" style="background: #ffffff">

    <div class="row">
        <div class="col">
            <div class="m-3">
                <b class="text-info">{{ $game->name }}</b>

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
                    </div>

                    <div class="col">
                        <form action="{{ route('point-store') }}" method="post">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="game_id" size="6" value="{{ $game->id }}">

                                <div class="col text-danger">Match Point - {{ $game->point ? $game->point->match_point : 0 }} <input type="text" name="match_point" placeholder="Point"> </div>
                                <div class="col text-danger">Club Point - {{ $game->point ? $game->point->club_point : 0 }} <input type="text" name="club_point" placeholder="Point"> </div>
                                <div class="col text-danger">
                                    <button class="btn btn-success">Save Point</button>
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


                                    {{ $prevScore }}


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
                                                        <input type="number" name="score" size="6" value="{{ $score->score }}" style="background: {{$colors[$colorIndex-1]}}">
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-dark">Update</button>
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
                Winner : Name
            </div>
        </div>

        <div class="col">
            <div class="alert alert-danger d-flex justify-content-center" role="alert">
                Hunter : Name
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>
