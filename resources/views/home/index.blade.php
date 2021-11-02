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
        .float {
            float: left;
            padding: 10px;
            border: 1px solid black;
        }
    </style>
</head>
<body>

<div>
    {{--<div class="float">
        <h2>Name</h2>

        @foreach($members as $member)
            <h4>-> {{ $member->name }}</h4>
            <hr>
        @endforeach
    </div>--}}
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




</body>
</html>
