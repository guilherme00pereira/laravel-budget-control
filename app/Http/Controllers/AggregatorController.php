<?php

namespace App\Http\Controllers;

use App\Models\Aggregator;
use App\ViewModels\AggregatorIndexViewModel;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class AggregatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $viewModel = new AggregatorIndexViewModel();
        return view('aggregators.index', compact('viewModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create() : View
    {
        return view('aggregators.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);
        if ($validated) {
            $category = Aggregator::create([
                'name'              => $request->name,
            ]);
        }
        return redirect()->action([AggregatorController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param Aggregator $aggregator
     * @return View
     */
    public function show(Aggregator $aggregator): View
    {
        return view('aggregators.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Aggregator $aggregator
     * @return View
     */
    public function edit(Aggregator $aggregator): View
    {
        return view('aggregators.form', compact('aggregator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Aggregator $aggregator
     * @return RedirectResponse
     */
    public function update(Request $request, Aggregator $aggregator): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);
        if ($validated) {
            $aggregator->name = $request->name;
            $aggregator->save();
        }
        return redirect()->action([AggregatorController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Aggregator $aggregator
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Aggregator $aggregator): RedirectResponse
    {
        $aggregator->delete();
        return redirect()->action([AggregatorController::class, 'index']);
    }
}
