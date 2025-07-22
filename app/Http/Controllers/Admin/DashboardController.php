<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Article;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get statistics
        $stats = [
            'doctors' => Doctor::count(),
            'active_doctors' => Doctor::where('is_active', true)->count(),
            'articles' => Article::count(),
            'published_articles' => Article::published()->count(),
            'draft_articles' => Article::where('is_published', false)->count(),
            'services' => Service::count(),
            'active_services' => Service::where('is_active', true)->count(),
            'users' => User::count(),
        ];

        // Get recent articles
        $recent_articles = Article::with('user')
                                 ->latest()
                                 ->take(5)
                                 ->get();

        // Get recent doctors
        $recent_doctors = Doctor::latest()
                               ->take(5)
                               ->get();

        // Get monthly article stats (last 6 months)
        $monthlyStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyStats[] = [
                'month' => $date->format('M Y'),
                'articles' => Article::whereYear('created_at', $date->year)
                                   ->whereMonth('created_at', $date->month)
                                   ->count(),
                'published' => Article::published()
                                    ->whereYear('published_at', $date->year)
                                    ->whereMonth('published_at', $date->month)
                                    ->count(),
            ];
        }

        return view('admin.dashboard', compact(
            'stats',
            'recent_articles',
            'recent_doctors',
            'monthlyStats'
        ));
    }

    /**
     * Show admin profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        return view('admin.profile');
    }

    /**
     * Show system settings.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function settings()
    {
        return view('admin.settings');
    }
}
