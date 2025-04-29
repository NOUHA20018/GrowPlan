<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserTypes;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'prenom' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'date_naissance' => ['nullable', 'date', 'date_format:Y-m-d', 'before:today'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'in:1,2,3']
    ]);

    $user = User::create([
        'name' => $request->name,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'date_naissance' => $request->date_naissance,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    event(new Registered($user));

    Auth::login($user);

    // Redirection selon le role
    if ($user->role == UserTypes::ADMIN) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role == UserTypes::FORMATEUR) {
        return redirect()->route('formateur.dashboard');
    } elseif ($user->role == UserTypes::APPRENANT) {
        return redirect()->route('apprenant.dashboard');
    }

    return redirect('/');
}
}