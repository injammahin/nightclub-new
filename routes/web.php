<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ClubEventController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventPageController as AdminEventPageController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\EventPageController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\ReservationSubmissionController;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/events', [EventPageController::class, 'index'])->name('events');

Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/homepage', [HomepageController::class, 'edit'])->name('homepage.edit');
        Route::post('/homepage', [HomepageController::class, 'update'])->name('homepage.update');

        Route::get('/event-page', [AdminEventPageController::class, 'edit'])->name('event-page.edit');
        Route::post('/event-page', [AdminEventPageController::class, 'update'])->name('event-page.update');

        Route::resource('/events', ClubEventController::class)
            ->except(['show'])
            ->parameters(['events' => 'event']);

        Route::post('/events/{event}/toggle', [ClubEventController::class, 'toggle'])
            ->name('events.toggle');

        Route::get('/reservations', [ReservationSubmissionController::class, 'index'])->name('reservations.index');
        Route::get('/reservations/{reservation}', [ReservationSubmissionController::class, 'show'])->name('reservations.show');
        Route::post('/reservations/{reservation}/status', [ReservationSubmissionController::class, 'updateStatus'])->name('reservations.status');
        Route::delete('/reservations/{reservation}', [ReservationSubmissionController::class, 'destroy'])->name('reservations.destroy');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});