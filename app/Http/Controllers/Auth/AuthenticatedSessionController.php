<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $targetApp = $request->string('target_app')->value();
        $appUrls = [
            'drawing' => config('services.sso.drawing'),
            'inventory' => config('services.sso.inventory'),
            'npc' => config('services.sso.npc'),
            'all_dashboard' => config('services.sso.all_dashboard'),
            'management' => config('services.sso.management'),
        ];

        if (! Auth::check()) {
            $request->authenticate();
            $request->session()->regenerate();
        }

        $user = $request->user();

        // Check SSO app access
        $columnMap = [
            'drawing' => 'app_drawing',
            'inventory' => 'app_inventory',
            'npc' => 'app_npc',
            'all_dashboard' => 'app_dashboard',
            'management' => 'app_management',
        ];
        $scopeId = $columnMap[$targetApp] ?? null;

        if ($scopeId) {
            $hasAccess = DB::table('user_scope_roles')
                ->where('user_id', $user->id)
                ->where('scope_id', $scopeId)
                ->exists();

            if (!$hasAccess) {
                Auth::guard('web')->logout();

                return back()->withErrors([
                    'nik' => 'Sorry, your account does not have access to this application.',
                ])->withInput($request->only('nik'));
            }
        }

        $request->session()->put([
            'name' => $user->name,
            'email' => $user->email,
        ]);

        return redirect()->away($appUrls[$targetApp]);
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
