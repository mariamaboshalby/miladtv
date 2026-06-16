@extends('admin.layouts.app')
@section('title', 'Manage Brands')
@section('page-title', 'Manage Brands')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Add New Brand</h5>
                <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control rounded-3">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" checked id="brandActive">
                        <label class="form-check-label" for="brandActive">Active</label>
                    </div>
                    <button class="btn btn-primary w-100 rounded-3">Save Brand</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $brand)
                        <tr>
                            <td>
                                @if($brand->hasMedia('brand-logos'))
                                    <img src="{{ $brand->getFirstMediaUrl('brand-logos') }}" width="40" height="40" style="object-fit:contain">
                                @else
                                    <span class="text-muted">No Logo</span>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $brand->name }}</td>
                            <td>
                                <span class="badge {{ $brand->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $brand->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td>
                                <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger border-0"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
