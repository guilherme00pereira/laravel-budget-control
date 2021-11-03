<?php

namespace App\Http\Controllers;

use App\Models\CategoryType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Category;
use App\ViewModels\CategoryShowEventsViewModel;
use Carbon\Carbon;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $categories     = Category::query()->orderBy('name')->get();
        $message        = $request->session()->get('message');
        return view('categories.index', compact('categories', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $categoryTypes  = CategoryType::all();
        return view('categories.form', compact('categoryTypes'));
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
            $category = Category::create([
                'name'              => $request->name,
                'category_type_id'  => $request->categoryType
            ]);
            $request->session()->flash('message', "Categoria $category->name criada com sucesso");
        }
        return redirect()->action([CategoryController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Category $category
     * @return View
     */
    public function show(Request $request, Category $category): View
    {
        $month      = Carbon::now()->month;
        if(!is_null($request->query('m'))){
            $month  = intval(substr($request->query('m'), 0, 2));
        }
        $viewModel  = new CategoryShowEventsViewModel($category, $month);
        return view('categories.show', compact('viewModel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        $categoryTypes  = CategoryType::all();
        return view('categories.form', compact('category', 'categoryTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);
        if ($validated) {
            $category->name             = $request->name;
            $category->category_type_id = $request->categoryType;
            $category->save();
            $request->session()->flash('message', "Categoria $category->name editada com sucesso");
        }
        return redirect()->action([CategoryController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Category $category): RedirectResponse
    {
        $category->delete();
        $request->session()->flash('message', "Categoria $category->name removida com sucesso");
        return redirect()->action([CategoryController::class, 'index']);
    }
}
