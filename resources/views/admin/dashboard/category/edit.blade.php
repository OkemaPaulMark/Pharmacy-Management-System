@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="modal fade show" id="editCategoryModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: block; padding-right: 17px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <a href="{{ route('categories.index') }}" class="close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label>Category*</label>
                        <input type="text" name="category" class="form-control" value="{{ old('category', $category->category) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Description*</label>
                        <textarea name="description" class="form-control" required>{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update Category</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal-backdrop fade show"></div>
@endsection
