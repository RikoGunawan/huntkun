@extends('layouts.app')

@section('title', 'Minecraft - Hunt Kun')

@section('content')
    <!-- Banner -->
    <div class="minecraft-banner banner-text-dark">
        <h1>Welcome to Hunt Kun</h1>
        <p class="font-sans-serif">
            Explore, create, and battle in the world of Minecraft with Hunt Kun!
        </p>
    </div>

    <!-- Cards Section -->
    <div class="card-menu">
        <a href="{{ route('minecraft.story') }}" class="card card-text-dark">
            <h2>Story Mode</h2>
            <p>Embark on an epic adventure in Minecraft</p>
        </a>
        <a href="{{ route('minecraft.minigame') }}" class="card card-text-dark">
            <h2>Minigames</h2>
            <p>Challenge yourself in Minecraft-based minigames</p>
        </a>
    </div>
@endsection
