@extends('layouts.app')
@section('content')
<div class="container text-white">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Edit Role</h1>
    </div>

    <!-- Modal for Editing -->
    <div class="modal fade show" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" style="display: block;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                    <a href="{{ route('minecraft.admin.roles.index') }}" class="btn-close"></a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('minecraft.admin.roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ $role->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('minecraft.admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
