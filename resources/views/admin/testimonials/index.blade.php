@extends('admin.layouts.app')

@section('title', __('app.manage_testimonials'))

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0">
        <i class="fas fa-star text-warning me-2"></i>{{ __('app.manage_testimonials') }}
    </h3>
    <span class="badge bg-primary rounded-pill">{{ $testimonials->total() }} {{ __('app.testimonials') }}</span>
</div>

{{-- Stats Cards --}}
<div class="d-flex row justify-content-evenly align-items-center ">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center" style="width:56px;height:56px;">
                        <i class="fas fa-comments fa-2x"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">{{ $stats['total'] }}</h4>
                        <p class="text-muted mb-0 small">{{ __('app.total_testimonials') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center" style="width:56px;height:56px;">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">{{ $stats['approved'] }}</h4>
                        <p class="text-muted mb-0 small">{{ __('app.approved') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 d-flex align-items-center justify-content-center" style="width:56px;height:56px;">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">{{ $stats['pending'] }}</h4>
                        <p class="text-muted mb-0 small">{{ __('app.pending_approval') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Filters --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control rounded-3" 
                       placeholder="{{ __('app.search_testimonial') }}" 
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select rounded-3">
                    <option value="">{{ __('app.all_statuses') }}</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>{{ __('app.approved') }}</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>{{ __('app.pending_approval') }}</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100 rounded-3">
                    <i class="fas fa-search me-1"></i>{{ __('app.search') }}
                </button>
            </div>
            @if(request('search') || request('status'))
            <div class="col-md-2">
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary w-100 rounded-3">
                    <i class="fas fa-times me-1"></i>{{ __('app.clear') }}
                </a>
            </div>
            @endif
        </form>
    </div>
</div>

{{-- Testimonials Table --}}
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @if($testimonials->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">{{ __('app.customer') }}</th>
                        <th>{{ __('app.rating') }}</th>
                        <th>{{ __('app.message') }}</th>
                        <th>{{ __('app.status') }}</th>
                        <th>{{ __('app.date') }}</th>
                        <th class="text-end pe-4">{{ __('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $testimonial)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">{{ $testimonial->name }}</h6>
                                    <small class="text-muted">{{ $testimonial->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-o' }}"></i>
                                @endfor
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 text-truncate" style="max-width:300px;" title="{{ $testimonial->message }}">
                                {{ Str::limit($testimonial->message, 80) }}
                            </p>
                        </td>
                        <td>
                            @if($testimonial->is_approved)
                                <span class="badge bg-success">{{ __('app.approved') }}</span>
                            @else
                                <span class="badge bg-warning">{{ __('app.pending_approval') }}</span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">{{ $testimonial->created_at->format('d M Y') }}</small>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group btn-group-sm">
                                @if(!$testimonial->is_approved)
                                <form action="{{ route('admin.testimonials.approve', $testimonial->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success" title="{{ __('app.approve') }}">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif
                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('{{ __('app.delete_confirm_short') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="{{ __('app.delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="p-3">
            {{ $testimonials->links('admin.pagination') }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-comments text-muted mb-3" style="font-size:3rem;"></i>
            <h5 class="text-muted">{{ __('app.no_testimonials') }}</h5>
        </div>
        @endif
    </div>
</div>

@endsection
