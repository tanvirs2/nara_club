

<div class="border border-dark pe-3">

    <div class="row">
        <div class="col">
            <div class="m-3">
                <h3 class="text-info">{{ $game->name }}</h3>

                <form action="{{ route('member-store') }}" method="post">
                    @csrf
                    <input type="hidden" name="game_id" size="6" value="{{ $game->id }}">
                    <input type="text" name="name" placeholder="name">
                    <input type="text" name="email" placeholder="email">
                    <input type="text" name="phone" placeholder="phone">
                    <input type="text" name="address" placeholder="address">
                    <button>Save Player</button>
                </form>

                <hr class="bg-danger border border-danger">

            </div>
        </div>
    </div>

    <div class="row">
        @foreach($members as $member)

            <div class="col ms-3 p-0">
                <div>

                    <table class="table table-bordered">
                        <tr>
                            <th colspan="2">{{ $member->name }}</th>
                        </tr>

                        @php
                            $prevScore = 0;
                        @endphp

                        @foreach($member->score as $score)

                            <tr>
                                <td>


                                    {{ $prevScore }}


                                </td>
                                <td>
                                    <form action="{{ route('score-update', $score->id) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="member_id" size="6" value="{{ $member->id }}">

                                        <input type="number" name="score" size="6" value="{{ $score->score }}">

                                        <button>Update</button>



                                    </form>

                                </td>
                            </tr>

                            @php
                                $prevScore = $prevScore + $score->score;
                            @endphp

                        @endforeach

                        {{--Score save area--}}
                        <tr>
                            <td>

                                <b class="text-dark">{{ $prevScore }}</b>

                            </td>
                            <td>
                                <form action="{{ route('score-store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="member_id" value="{{ $member->id }}">
                                    <input type="text" name="score" >
                                    <button>Save</button>
                                </form>
                            </td>
                        </tr>
                        {{--End Score save area--}}

                    </table>

                </div>
            </div>

        @endforeach
    </div>
</div>
