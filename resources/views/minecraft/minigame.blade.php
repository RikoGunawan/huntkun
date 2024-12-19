@extends('layouts.app')

@section('title', 'Minecraft Minigames - Hunt Kun')

@section('content')
    <div class="minigame-container">
        <div class="minigame-header">
            <h1>Minecraft Minigames</h1>
            <p>Test your skills with these fun and challenging games!</p>
        </div>
        <div class="minigame-content">
            <ul class="minigame-list">
                <li><a href="#">Crafting Quiz</a></li>
                <li><a href="#">Redstone Puzzle</a></li>
                <li><a href="#">Memory Game</a></li>
            </ul>
        </div>
        <div class="minigame-footer">
            <a href="{{ route('minecraft.index') }}">Back to Minecraft Home</a>
        </div>
    </div>
@endsection
