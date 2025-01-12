@extends('layouts.app')

@section('title', $role->name)

@section('content')
    <div class="minecraft-role">
        <div class="row">
            <div class="col-md-6">
                <!-- Header Section -->
                <div style="">
                    <h1>{{ $role->name }}</h1>
                    <p>{{ $role->description }}</p>
                </div>

                <!-- Tool Selection -->
                <div class="tool-selection my-4">
                    <h4>Pilih Alat</h4>
                    @if ($tools->isEmpty())
                        <p class="text-muted">Belum ada alat yang tersedia untuk role ini.</p>
                    @else
                        <div class="d-flex flex-wrap gap-3">
                            @foreach ($tools as $tool)
                                <button class="tool-button" data-modifier="{{ $tool->modifier }}"
                                    data-tool-id="{{ $tool->id }}">
                                    <img src="{{ asset('storage/images/' . $tool->icon) }}" alt="{{ $tool->name }}"
                                        class="tool-icon">
                                    {{ $tool->name }}
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <h4>Pilih Lokasi</h4>
                <!-- Location Cards -->
                <div class="location-cards-wrapper">
                    <!-- Tombol panah kiri -->
                    <button class="scroll-arrow scroll-arrow-left" onclick="scrollLeft()">&#9664;</button>

                    <!-- Container lokasi -->
                    <div class="location-cards">
                        @foreach ($locations as $location)
                            <div class="location-card" data-location-id="{{ $location->id }}"
                                data-base-time="{{ $location->base_time }}" data-reward="{{ $location->reward }}">
                                <img src="{{ asset('storage/images/' . $location->image) }}" alt="{{ $location->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $location->name }}</h5>
                                    <p class="card-text">Estimasi waktu dasar: {{ $location->base_time }} menit</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Tombol panah kanan -->
                    <button class="scroll-arrow scroll-arrow-right" onclick="scrollRight()">&#9654;</button>
                </div>



                <div class = "row">
                    <!-- Estimation Result -->
                    <div class="col-md-6">
                        <h4>Estimasi Waktu</h4>
                        <p id="estimation-time" class="fs-5"></p>
                    </div>
                    <!-- Reward Result -->
                    <div class="col-md-6">
                        <h4>Reward</h4>
                        <p id="reward-result" class="fs-5 text-success"></p>
                    </div>
                </div>

            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const locationCardsContainer = document.querySelector('.location-cards');

                // Fungsi gulir ke kiri
                function scrollLeft() {
                    locationCardsContainer.scrollBy({
                        left: -300,
                        behavior: 'smooth'
                    });
                }

                // Fungsi gulir ke kanan
                function scrollRight() {
                    locationCardsContainer.scrollBy({
                        left: 300,
                        behavior: 'smooth'
                    });
                }

                // Tambahkan event listener untuk scroll horizontal dengan roda mouse
                locationCardsContainer.addEventListener('wheel', (event) => {
                    event.preventDefault();
                    locationCardsContainer.scrollBy({
                        left: event.deltaY < 0 ? -300 : 300,
                        behavior: 'smooth'
                    });
                });

                // Menambahkan event listeners untuk tombol panah kiri dan kanan
                const scrollLeftButton = document.querySelector('.scroll-arrow-left');
                const scrollRightButton = document.querySelector('.scroll-arrow-right');

                scrollLeftButton.addEventListener('click', scrollLeft);
                scrollRightButton.addEventListener('click', scrollRight);
            });


            document.addEventListener('DOMContentLoaded', function() {
                const toolButtons = document.querySelectorAll('.tool-button');
                const locationCards = document.querySelectorAll('.location-card');
                let selectedToolModifier = 1;

                toolButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        selectedToolModifier = parseFloat(this.dataset.modifier);
                        toolButtons.forEach(btn => btn.classList.remove('btn-primary'));
                        this.classList.add('btn-primary');
                        calculateEstimation();
                    });
                });

                locationCards.forEach(card => {
                    card.addEventListener('click', function() {
                        locationCards.forEach(card => card.classList.remove('border-success'));
                        this.classList.add('border-success');
                        calculateEstimation();
                    });
                });

                function calculateEstimation() {
                    const selectedLocation = document.querySelector('.location-card.border-success');
                    if (selectedLocation) {
                        const baseTime = parseInt(selectedLocation.dataset.baseTime);
                        const reward = selectedLocation.dataset.reward;

                        const estimationTime = Math.ceil(baseTime / selectedToolModifier);
                        document.getElementById('estimation-time').innerText =
                            `${estimationTime} menit`;
                        document.getElementById('reward-result').innerText = `Reward: ${reward}`;
                    }
                }
            });
        </script>
    </div>
@endsection
