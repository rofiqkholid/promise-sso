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
    /*Logika SSO*/
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
        $column = $columnMap[$targetApp] ?? null;

        if ($column) {
            $hasAccess = DB::table('t1000_sso_user_access_app')
                ->where('id_user', $user->id)
                ->value($column);

            if (filter_var($hasAccess, FILTER_VALIDATE_BOOLEAN) === false) {
                Auth::guard('web')->logout();

                return back()->withErrors([
                    'nik' => 'Sorry, your account does not have access to this application.',
                ])->withInput($request->only('nik'));
            }
        }

        $allowedMenuIds = DB::table('role_menu')
            ->where('user_id', $user->id)
            ->where('can_view', 1)
            ->distinct()
            ->pluck('menu_id')
            ->all();

        $request->session()->put([
            'name' => $user->name,
            'email' => $user->email,
            'allowed_menus' => $allowedMenuIds,
        ]);

        if ($allowedMenuIds === []) {
            Auth::guard('web')->logout();

            return back()->withErrors([
                'nik' => 'Your account does not have access rights.',
            ])->withInput($request->only('nik'));
        }

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
