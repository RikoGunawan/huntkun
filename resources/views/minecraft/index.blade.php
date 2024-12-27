@extends('layouts.app')

@section('title', 'Minecraft - Hunt Kun')

@section('content')
    <!-- Banner -->
    <div class="minecraft-banner">
        <h2>Apa yang ingin kamu lakukan?</h2>
        {{-- <p class="font-sans-serif">
            Explore, create, and battle in the world of Minecraft with Hunt Kun!
        </p> --}}
        <!-- Card Navigation Section -->
    <section id="cards" class="container my-5">
        <div class="row" style="justify-content: center;">
            <!-- Minecraft Card -->
            <div class="col-md-4">
                <a href="{{ route('minecraft.story.index') }}" class="modern-card" style="background-image: url('{{ asset('images/story_mode.jpg') }}');">
                    <div class="modern-card-content">
                        <div>
                            <h5 class="modern-card-title">Story Mode</h5>
                            <p class="modern-card-text">Embark on an epic adventure in Minecraft</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-4">
                <a href="{{ route('minecraft.minigame') }}" class="modern-card" style="background-image: url('{{ asset('images/roles/redstone_engineer.jpg') }}');">
                    <div class="modern-card-content">
                        <div>
                            <h5 class="modern-card-title">Minigames</h5>
                            <p class="modern-card-text">Challenge yourself in Minecraft-based minigames</p>
                        </div>
                    </div>
                </a>
            </div>
    </div>
@endsection
