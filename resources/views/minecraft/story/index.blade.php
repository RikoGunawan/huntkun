@extends('layouts.app')

@section('title', 'Minecraft Story Mode - Hunt Kun')

@section('content')
<div class="minecraft-banner">
    <h2>Pilih Story Mode</h2>
    <section id="cards" class="container my-5">
        <div class="row" style="justify-content: center;">
            @foreach ($roles as $role)
                <div class="col-md-3">
                    <a href="{{ route('minecraft.story.show', $role->id) }}" class="modern-card" style="background-image: url('{{ asset('storage/images/' . $role->image) }}');">
                        <div class="modern-card-content">
                            <div>
                                <h5 class="modern-card-title">{{ $role->name }}</h5>
                                <p class="modern-card-text">{{ $role->description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
