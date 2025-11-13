<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $role = strtolower($request->user()->rolname ?? '');

        // return redirect()->intended(route('dashboard', absolute: false));
        return redirect()->intended(match($role) {
            'praktijkmanagement' => route('praktijkmanagement.index'),
            'patient'         => route('patient.index'),
            'Tandarts'    => route('tandarts.index'),
            'mondhygienist'   => route('mondhygienist.index'),
            'assistent'   => route('assistent.index'),
            default        => route('welcome'),
        });
       
        // route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}