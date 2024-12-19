@extends('layouts.app')

@section('title', 'Minecraft Story Mode - Hunt Kun')

@section('content')
    <div class="story-container">
        <div class="story-header">
            <h1>Minecraft Story Mode</h1>
            <p>Choose your adventure and immerse yourself in the world of Minecraft!</p>
        </div>
        <div class="story-content">
            <p>Start your journey by choosing your path:</p>
            <ul class="story-options">
                <li><a href="#">Explore the Cave</a></li>
                <li><a href="#">Build a Fortress</a></li>
            </ul>
        </div>
        <div class="story-footer">
            <a href="{{ route('minecraft.index') }}">Back to Minecraft Home</a>
        </div>
    </div>
@endsection
