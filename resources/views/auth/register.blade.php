@extends('layouts.app')
@section('title', 'إنشاء حساب — ميلاد سامي')

@section('content')

<div style="background:linear-gradient(135deg,#0f172a 0%,#030f1f 100%);padding:2.5rem 0;">
    <div class="container">
        <h1 class="text-white fw-bold mb-1">Create Account</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-white-50">Register</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                @if(session()->has('cart') && count(session('cart')) > 0)
                <div class="alert alert-info rounded-3 mb-4 d-flex align-items-center gap-2">
                    <i class="fas fa-shopping-bag text-primary"></i>
                    <span>Create an account to complete your order — your cart is saved.</span>
                </div>
                @endif

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h4 class="fw-bold mb-1 text-center">انضم إلينا</h4>
                    <p class="text-secondary text-center small mb-4">أنشئ حسابك في ميلاد سامي</p>

                    @if($errors->any())
                    <div class="alert alert-danger rounded-3 small">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="form-control rounded-3 @error('name') is-invalid @enderror"
                                   placeholder="John Doe" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="form-control rounded-3 @error('email') is-invalid @enderror"
                                   placeholder="you@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Phone <span class="text-muted">(optional)</span></label>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                   class="form-control rounded-3"
                                   placeholder="+20 1XX XXX XXXX">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Street Address <span class="text-muted">(optional)</span></label>
                            <input type="text" name="address" value="{{ old('address') }}"
                                   class="form-control rounded-3"
                                   placeholder="Street name, building, apartment...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">City <span class="text-muted">(optional)</span></label>
                            <input type="text" name="city" value="{{ old('city') }}"
                                   class="form-control rounded-3"
                                   placeholder="e.g. Mansoura">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Password</label>
                            <input type="password" name="password"
                                   class="form-control rounded-3 @error('password') is-invalid @enderror"
                                   placeholder="Min. 8 characters" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold small">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                   class="form-control rounded-3"
                                   placeholder="Repeat password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 btn-lg rounded-3 fw-bold">
                            <i class="fas fa-user-plus me-2"></i>Create Account
                        </button>
                    </form>

                    <hr class="my-4">
                    <p class="text-center small text-secondary mb-0">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-primary fw-semibold text-decoration-none">Sign in</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
