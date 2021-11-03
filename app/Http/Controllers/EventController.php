<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\RecurringPattern;
use App\Services\ExtractDateFromRequest;
use App\ViewModels\EventsIndexViewModel;
use App\ViewModels\DetailsViewModel;
use App\ViewModels\RecurringViewModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        [$month, $date] = ExtractDateFromRequest::process($request);
        $viewModel      = new EventsIndexViewModel($month);
        return view('events.index', compact('viewModel', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create() : View
    {
        $categories = Category::query()->orderBy('name')->get();
        return view('events.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {
        $recurring  = isset($request->is_recurring);
        $event      = Event::create([
            'amount'        => str_replace(',', '.', $request->amount),
            'date'          => $request->date,
            'category_id'   => $request->category,
            'description'   => trim($request->description) ?? null,
            'is_recurring'  => $recurring,
        ]);
        if($recurring){
            RecurringPattern::create([
                'num_of_occurrences'    => $request->num_of_occurrences,
                'day_of_week'           => Carbon::createFromFormat('d/m/Y', $request->date)->day,
                'recurring_type_id'     => 3,
                'event_id'              => $event->id
            ]);
        }
        return redirect()->action([EventController::class, 'create']);
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return View
     */
    public function show(Event $event) : View
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return View
     */
    public function edit(Event $event) : View
    {
        $categories = Category::query()->orderBy('name')->get();
        return view('events.form', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Event $event
     * @return RedirectResponse
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        $recurring = isset($request->is_recurring);
        $event->amount          = str_replace(',', '.', $request->amount);
        $event->date            = $request->date;
        $event->category_id     = $request->category;
        $event->description     = trim($request->description) ?? null;
        $event->is_recurring    = $recurring;
        $event->save();
        if($recurring){
            $recurring_pattern                      = RecurringPattern::where('event_id', $event->id)->get();
            $recurring_pattern->num_of_ocurrences   = $request->num_of_ocurrences;
            $recurring_pattern->day_of_week         = Carbon::createFromFormat('d/m/Y', $request->date)->day;
            $recurring_pattern->save();
        }
        return redirect()->action([DashboardController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();
        return redirect()->action([EventController::class, 'index']);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function details(Request $request) : View
    {
        $day    = 0;
        $type   = 1;
        [$month, $date] = ExtractDateFromRequest::process($request);
        if(!is_null($request->query('d'))) {
            $day = $request->query('d');
        }
        if(!is_null($request->query('t'))) {
            $type = $request->query('t');
        }
        $viewModel      = new DetailsViewModel($month, $type, $day);
        return view('events.details', compact('viewModel', 'date'));
    }

    public function recurring() : View
    {
        $recurringEvents     = Event::with('pattern')->where('is_recurring', '=', '1')->get();
        return view('events.recurring', compact('recurringEvents'));
    }
}
