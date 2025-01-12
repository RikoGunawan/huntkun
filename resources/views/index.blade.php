@extends('layouts.app')

@section('content')
    <!-- Banner Section (Welcome) -->
    <section id="banner">
        <div>
            <h1>Welcome to Hunt Kun Web!</h1>
            <p>Explore the world of Minecraft, Doomsday, and more exciting features!</p>
        </div>
    </section>


    <!-- Card Navigation Section -->
    <section id="cards" class="container my-5">
        <div class="row">
            <!-- Minecraft Card -->
            <div class="col-md-4">
                <a href="/minecraft" class="modern-card" style="background-image: url('{{ asset('storage/images/mc_game.jpg') }}');">
                    <div class="modern-card-content">
                        <div>
                            <h5 class="modern-card-title">Minecraft</h5>
                            <p class="modern-card-text">Join the Minecraft community and explore interactive stories!</p>
                        </div>
                        <span class="modern-card-icon">
                            <i class="fas fa-arrow-right"></i> <!-- Ikon panah kanan -->
                        </span>
                    </div>
                </a>
            </div>
            <!-- Doomsday Card -->
            <div class="col-md-4">
                <a href="/doomsday" class="modern-card" style="background-image: url('{{ asset('storage/images/doomsday_bduck.jpg') }}');">
                    <div class="modern-card-content">
                        <div>
                            <h5 class="modern-card-title">Doomsday</h5>
                            <p class="modern-card-text">Survive and conquer the world of Doomsday Last Survivors!</p>
                        </div>
                        <span class="modern-card-icon">
                            <i class="fas fa-arrow-right"></i> <!-- Ikon panah kanan -->
                        </span>
                    </div>
                </a>
            </div>
            <!-- About Youtuber Card -->
            <div class="col-md-4">
                <a href="/about" class="modern-card" style="background-image: url('{{ asset('storage/images/about_me.jpg') }}');">
                    <div class="modern-card-content">
                        <div>
                            <h5 class="modern-card-title">About Hunt Kun</h5>
                            <p class="modern-card-text">Learn more about the creator and his YouTube channel!</p>
                        </div>
                        <span class="modern-card-icon">
                            <i class="fas fa-arrow-right"></i> <!-- Ikon panah kanan -->
                        </span>
                    </div>
                </a>
            </div>
            {{-- <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('storage/images/about-card.jpg') }}" class="card-img-top" alt="About">
                    <div class="card-body">
                        <h5 class="card-title">About Hunt Kun</h5>
                        <p class="card-text">Learn more about the creator and his YouTube channel!</p>
                        <a href="/about" class="btn btn-primary">About Hunt Kun</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
@endsection
