

<div class="main-tbl-list">

    <h1>{{ $game->name }}</h1>

    <div class="float">

        <form action="{{ route('member-store') }}" method="post">
            @csrf
            <input type="hidden" name="game_id" size="6" value="{{ $game->id }}">
            <input type="text" name="name" placeholder="name"> &nbsp;&nbsp; |
            <input type="text" name="email" placeholder="email"> &nbsp;&nbsp; |
            <input type="text" name="phone" placeholder="phone"> &nbsp;&nbsp; |
            <input type="text" name="address" placeholder="address"> &nbsp;&nbsp; |
            <button>Save</button>
        </form>
        <hr>

        <h2>Member Name</h2>
        @php
            $sprint = 1
        @endphp

        @foreach($members as $member)

            <hr>
            <h4> {{ $sprint++ }}. {{ $member->name }}</h4>
        @endforeach
    </div>
    <div>
        <div class="main-tbl">
            @foreach($members as $member)

                <table>
                    <tr>
                        <th colspan="2">{{ $member->name }}</th>
                    </tr>

                    @php
                        $prevScore = 0;
                    @endphp

                    @foreach($member->score as $score)

                        <tr>
                            <td>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                {{ $prevScore }}

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                            <td>
                                <form action="{{ route('score-update', $score->id) }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="member_id" size="6" value="{{ $member->id }}">
                                    <input type="number" name="score" size="6" value="{{ $score->score }}"> |
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
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            {{ $prevScore }}
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                        <td>
                            <form action="{{ route('score-store') }}" method="post">
                                @csrf
                                <input type="hidden" name="member_id" value="{{ $member->id }}">
                                <input type="text" name="score" > &nbsp;&nbsp;
                                <button>Save</button>
                            </form>
                        </td>
                    </tr>
                    {{--End Score save area--}}

                </table>

            @endforeach
        </div>
    </div>
</div>
