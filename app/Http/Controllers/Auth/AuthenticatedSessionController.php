<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Services\AuditService;

class AuthenticatedSessionController extends Controller
{
    public function create(): \Illuminate\View\View
    {
        return view('auth.login');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'employee_id' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Find user by employee_id
        $user = \App\Models\User::where('employee_id', $request->employee_id)->first();

        // Check if user exists
        if (!$user) {
            return back()->withErrors([
                'employee_id' => __('The provided Employee ID does not exist.'),
            ])->onlyInput('employee_id');
        }

        // Check if password is correct
        if (!\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'employee_id' => __('The provided credentials do not match our records.'),
            ])->onlyInput('employee_id');
        }

        // Log the user in
        Auth::login($user, $request->boolean('remember'));

        $request->session()->regenerate();

        // Log the login (wrap in try-catch to prevent blocking on errors)
        try {
            AuditService::log('login_logout', 'User', Auth::id(), 'User logged in');
        } catch (\Exception $e) {
            // Log error but don't block login
            \Log::error('Failed to log login: ' . $e->getMessage());
        }

        return redirect()->intended(route('dashboard'));
    }

    public function destroy(Request $request): \Illuminate\Http\RedirectResponse
    {
        $userId = Auth::id();
        
        AuditService::log('login_logout', 'User', $userId, 'User logged out');

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
