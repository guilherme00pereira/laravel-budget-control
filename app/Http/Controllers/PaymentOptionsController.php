<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\PaymentOptions;

class PaymentOptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $payment_options    = PaymentOptions::query()->orderBy('name')->get();
        $message            = $request->session()->get('message');
        return view('payment_options.index', compact('payment_options', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create() : View
    {
        return view('payment_options.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);
        if ($validated) {
            $payment_option = PaymentOptions::create([
                'name'              => $request->name,
            ]);
            $request->session()->flash('message', "Método de pagamento $payment_option->name criado com sucesso");
        }
        return redirect()->action([PaymentOptionsController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PaymentOptions $payment_option
     * @return View
     */
    public function edit(PaymentOptions $payment_option) : View
    {
        return view('payment_options.form', compact('payment_option'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PaymentOptions $payment_option
     * @return RedirectResponse
     */
    public function update(Request $request, PaymentOptions $payment_option): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);
        if ($validated) {
            $payment_option->name = $request->name;
            $payment_option->save();
            $request->session()->flash('message', "Método de pagamento $payment_option->name editado com sucesso");
        }
        return redirect()->action([PaymentOptionsController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
