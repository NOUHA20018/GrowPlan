<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UserTypes;
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

    //     return redirect()->intended(route('dashboard', absolute: false));
    
    if (Auth::user()->role == UserTypes::ADMIN) {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::user()->role == UserTypes::FORMATEUR) {
        return redirect()->route('formateur.dashboard');
    } elseif (Auth::user()->role == UserTypes::APPRENANT) {
        return redirect()->route('apprenant.dashboard');
    }
    return redirect('/');
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
