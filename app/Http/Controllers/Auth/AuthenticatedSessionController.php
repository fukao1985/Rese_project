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
use Illuminate\Support\Facades\Storage;
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

        return $this->getShopList($request);
    }

    public function getShopList(Request $request) {

        $areas = Area::all();
        $genres = Genre::all();
        $query = Shop::query();

        if ($request->filled('area_id')) {
            $query->where('area_id', $request->input('area_id'));
        }
        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->input('genre_id'));
        }
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $shops = $query->get();

        // foreach ($shops as $shop) {
        //     $imageContents = file_get_contents($shop->url);
        //     $newImagePath = 'images/' . uniqid() . '.jpg';
        //     Storage::disk('public')->put($newImagePath, $imageContents);
        //     $newImageUrl = Storage::url($newImagePath);
        //     $shop->url = $newImageUrl;
        //     $shop->save();
        // }

        // $request->session()->put('areas', $areas);
        // $request->session()->put('genres', $genres);
        // $request->session()->put('shops', $shops);



        // return redirect()->route('private.shop_list');

        return view('private_page.shop_list', compact('areas', 'genres', 'shops'));
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
