<?php

namespace App\Http\Controllers;

use App\ViewModels\DashboardViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $viewModel = new DashboardViewModel();
        return view('dashboard', compact('viewModel'));
    }
}
