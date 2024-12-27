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
                        <div class="d-flex justify-content gap-3">
                            @foreach ($tools as $tool)
                                <button class="tool-button" data-modifier="{{ $tool->modifier }}"
                                    data-tool-id="{{ $tool->id }}">
                                    <img src="{{ asset('images/' . $tool->icon) }}" alt="{{ $tool->name }}"
                                        class="tool-icon">
                                    {{ $tool->name }}
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <!-- Location Cards -->
                <div class="location-cards my-4">
                    <h4>Pilih Lokasi</h4>
                    @if ($locations->isEmpty())
                        <p class="text-muted">Belum ada lokasi yang tersedia untuk role ini.</p>
                    @else
                        <div class="row">
                            @foreach ($locations as $location)
                                <div class="col">
                                    <div class="location-card" data-location-id="{{ $location->id }}"
                                        data-base-time="{{ $location->base_time }}" data-reward="{{ $location->reward }}">
                                        <img src="{{ asset('images/' . $location->image) }}" alt="{{ $location->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $location->name }}</h5>
                                            <p class="card-text">Estimasi waktu dasar: {{ $location->base_time }} menit</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
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
