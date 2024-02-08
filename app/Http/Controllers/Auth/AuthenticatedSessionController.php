<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
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
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if ($errors = session('errors')) {
            return back()->withErrors($errors)->withInput();
        }

        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::all();
        $request->session()->put('areas', $areas);
        $request->session()->put('genres', $genres);
        $request->session()->put('shops', $shops);

        return redirect()->route('private.shop_list');

        // return view('private_page.shop_list', compact('areas', 'genres'));
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
