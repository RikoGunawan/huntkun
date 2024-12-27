@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Create Tool</h1>
    <form action="{{ route('minecraft.admin.tools.store') }}" method="POST" enctype="multipart/form-data">
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
            <label for="icon" class="form-label">Icon</label>
            <input type="file" class="form-control" id="icon" name="icon">
        </div>
        <div class="mb-3">
            <label for="modifier" class="form-label">Modifier</label>
            <input type="number" step="0.1" class="form-control" id="modifier" name="modifier" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection