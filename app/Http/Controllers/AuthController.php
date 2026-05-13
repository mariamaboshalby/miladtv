<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // ── Login ──────────────────────────────────────────────────────────────
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->intended(route('checkout.index'));
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Restore cart from cookie if session cart is empty
            $this->restoreCartFromCookie($request);

            return redirect()->intended(route('checkout.index'));
        }

        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }

    // ── Register ───────────────────────────────────────────────────────────
    public function registerForm()
    {
        if (Auth::check()) {
            return redirect()->intended(route('checkout.index'));
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:500',
            'city'     => 'nullable|string|max:100',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'] ?? null,
            'address'  => $validated['address'] ?? null,
            'city'     => $validated['city'] ?? null,
            'password' => Hash::make($validated['password']),
            'role'     => 'user',
            'is_active'=> true,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        // Restore cart from cookie
        $this->restoreCartFromCookie($request);

        return redirect()->route('checkout.index');
    }

    // ── Logout ─────────────────────────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    // ── Helpers ────────────────────────────────────────────────────────────
    private function restoreCartFromCookie(Request $request): void
    {
        $sessionCart = session()->get('cart', []);

        if (empty($sessionCart)) {
            $cookieCart = json_decode($request->cookie('mjk_cart', '[]'), true);
            if (!empty($cookieCart)) {
                session()->put('cart', $cookieCart);
            }
        }
    }
}
