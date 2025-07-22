<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Article;
use App\Models\Service;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $doctors = Doctor::active()
                         ->ordered()
                         ->take(6)
                         ->get();

        $articles = Article::published()
                          ->latest('published_at')
                          ->take(3)
                          ->get();

        $services = Service::active()
                          ->ordered()
                          ->take(6)
                          ->get();

        return view('home', compact('doctors', 'articles', 'services'));
    }

    /**
     * Show the about page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Show the contact page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Show the services page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function services()
    {
        $services = Service::active()->ordered()->paginate(12);
        return view('services.index', compact('services'));
    }
}
