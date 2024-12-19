@extends('layouts.app')

@section('title', 'Doomsday - Hunt Kun')

@section('content')
    <div class="doomsday-banner">
        <h1>Welcome to Doomsday</h1>
        <p>Survive the apocalypse in Doomsday Last Survivors with Hunt Kun!</p>
    </div>
    <div class="card-menu">
        <a href="{{ route('doomsday.story') }}" class="card">
            <h2>Story Mode</h2>
            <p>Survive and make choices in a world full of dangers</p>
        </a>
        <a href="{{ route('doomsday.minigame') }}" class="card">
            <h2>Minigames</h2>
            <p>Take on challenges in Doomsday-themed minigames</p>
        </a>
    </div>
@endsection
