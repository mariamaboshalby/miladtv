@extends('admin.layouts.app')

@section('title', 'Home Page Settings')
@section('page-title', 'Home Page Settings')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            <input type="hidden" name="submitted" value="1">
            
            <h5 class="fw-bold mb-4">Toggle Home Page Sections</h5>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="home_show_brands" name="home_show_brands" value="1" {{ ($settings['home_show_brands'] ?? '0') == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="home_show_brands">Show "Shop by Brand" Section</label>
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="home_show_recommended" name="home_show_recommended" value="1" {{ ($settings['home_show_recommended'] ?? '0') == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="home_show_recommended">Show "Recommended for You" Section</label>
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="home_show_newsletter" name="home_show_newsletter" value="1" {{ ($settings['home_show_newsletter'] ?? '0') == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="home_show_newsletter">Show "Newsletter Subscription" Section</label>
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="home_show_faq" name="home_show_faq" value="1" {{ ($settings['home_show_faq'] ?? '0') == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="home_show_faq">Show "FAQ" Section</label>
            </div>

            <div class="form-check form-switch mb-4">
                <input class="form-check-input" type="checkbox" id="home_show_track_order" name="home_show_track_order" value="1" {{ ($settings['home_show_track_order'] ?? '0') == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="home_show_track_order">Show "Track Your Order" Section</label>
            </div>

            <hr>

            <h5 class="fw-bold mb-4 mt-4">Deal of the Day Section</h5>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="home_show_deal" name="home_show_deal" value="1" {{ ($settings['home_show_deal'] ?? '0') == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="home_show_deal">Show "Deal of the Day" Section</label>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Deal Product</label>
                    <select name="home_deal_product_id" class="form-select rounded-3">
                        <option value="">Select a product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ ($settings['home_deal_product_id'] ?? '') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Deal End Time</label>
                    <input type="datetime-local" name="home_deal_end_time" class="form-control rounded-3" value="{{ $settings['home_deal_end_time'] ?? '' }}">
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-4 rounded-3"><i class="fas fa-save me-2"></i> Save Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
