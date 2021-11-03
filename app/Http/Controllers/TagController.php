<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index(Request $request): View
    {
        $tags           = Tag::query()->orderBy('name')->get();
        $message        = $request->session()->get('message');
        return view('tags.index', compact('tags', 'message'));
    }

    public function create(): View
    {
        return view('tags.form');
    }

    public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);
        if ($validated) {
            $tag = Tag::create([
                'name'              => $request->name,
            ]);
            $request->session()->flash('message', "Tag $tag->name criada com sucesso");
        }
        return redirect()->action([TagController::class, 'index']);
    }

    public function show(Request $request, Tag $tag) : View
    {
        $total = $tag->events()->sum('amount');
        return View('tags.show', compact('tag', 'total'));
    }
}
