@extends('admin.layouts.app')
@section('title', 'Manage FAQs')
@section('page-title', 'Manage FAQs')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Add New FAQ</h5>
                <form action="{{ route('admin.faqs.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Question (Arabic)</label>
                        <input type="text" name="question_ar" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Question (English)</label>
                        <input type="text" name="question_en" class="form-control rounded-3">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Answer (Arabic)</label>
                        <textarea name="answer_ar" class="form-control rounded-3" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Answer (English)</label>
                        <textarea name="answer_en" class="form-control rounded-3" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control rounded-3" value="0">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" checked id="faqActive">
                        <label class="form-check-label" for="faqActive">Active</label>
                    </div>
                    <button class="btn btn-primary w-100 rounded-3">Save FAQ</button>
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
                            <th>Question</th>
                            <th>Sort</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faqs as $faq)
                        <tr>
                            <td class="fw-bold">{{ $faq->question_ar }}</td>
                            <td>{{ $faq->sort_order }}</td>
                            <td>
                                <span class="badge {{ $faq->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $faq->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td>
                                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline">
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
