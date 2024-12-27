@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Create Location</h1>
    <form action="{{ route('minecraft.admin.locations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="role_id" class="form-label">Role</label>
            <select class="form-select" id="role_id" name="role_id" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="mb-3">
            <label for="base_time" class="form-label">Base Time (minutes)</label>
            <input type="number" class="form-control" id="base_time" name="base_time" required>
        </div>
        <div class="mb-3">
            <label for="reward" class="form-label">Reward</label>
            <input type="text" class="form-control" id="reward" name="reward" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
