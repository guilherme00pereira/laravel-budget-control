<?php

use App\Http\Controllers\{AggregatorController,
    CategoryController,
    DashboardController,
    EventController,
    RecurringTypeController,
    TagController,
    PaymentOptionsController,
    OptionsController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index']);

Route::get('/events/details', [EventController::class, 'details'])->name('events.details');
Route::get('/events/recurring', [EventController::class, 'recurring'])->name('events.recurring');
Route::post('/aggregators/associate', [AggregatorController::class, 'associateCategory'])->name('aggregators.associate');

Route::resources([
    'categories'        => CategoryController::class,
    'recurring_types'   => RecurringTypeController::class,
    'events'            => EventController::class,
    'aggregators'       => AggregatorController::class,
    'tags'              => TagController::class,
    'payment_options'   => PaymentOptionsController::class,
    'options'           => OptionsController::class,
]);
