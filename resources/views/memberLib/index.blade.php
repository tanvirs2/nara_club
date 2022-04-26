@extends('layouts.master')

@section('container')

    <style>
        input {outline: none;border: hidden; width: 100px; background: #e5e5e5}
    </style>

    <div class="container">

        <div class="row">
            <div class="col">
                <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
            </div>
        </div>

        <hr>

        <div class="row">

            <div class="col">
                <form action="{{ route('member-lib-store') }}" method="post">
                    @csrf

                    <input type="text" name="name" placeholder="name">
                    <input type="text" name="email" placeholder="email">
                    <input type="text" name="phone" placeholder="phone">
                    <input type="text" name="address" placeholder="address">
                    <button class="btn btn-outline-success">Save Player</button>
                </form>
            </div>

        </div>

        <hr>

        <div class="row">

            <div class="col">

                <ul class="list-group">
                    @foreach($allMembersFromLib as $k => $member)

                            <li class="list-group-item">{{ $k + 1 }} - {{ $member->name }}</li>

                    @endforeach
                </ul>
            </div>

        </div>

    </div>

@endsection
