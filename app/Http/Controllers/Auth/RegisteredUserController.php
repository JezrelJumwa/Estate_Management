<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Models\SystemRole;
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
            'id_number' => ['required', 'string', 'max:30', 'unique:users,id_number'],
            'first_name' => ['required', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:30'],
            'other_name' => ['nullable', 'string', 'max:30'],
            'gender' => ['required', 'in:Male,Female'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $activeStatusId = Status::query()->where('name', 'ACTIVE')->value('id') ?? 1;
        $tenantRoleId = SystemRole::query()->where('name', 'TENANT')->value('id') ?? 3;

        $user = User::create([
            'name' => trim($request->first_name . ' ' . $request->last_name),
            'id_number' => $request->id_number,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'other_name' => $request->other_name,
            'gender' => $request->gender,
            'status_id' => $activeStatusId,
            'system_role_id' => $tenantRoleId,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
