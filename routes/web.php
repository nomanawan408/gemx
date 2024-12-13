<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorsController;
use App\Http\Controllers\InternationalVisitorsController;
use App\Http\Controllers\BuyersController;
use App\Http\Controllers\ExhibitorsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransportDepController;
use App\Http\Controllers\HospitalityDepController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\WebsiteFormController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('visitors', VisitorsController::class);
Route::resource('international-visitors', InternationalVisitorsController::class);
Route::resource('buyers', BuyersController::class);
Route::resource('transports', TransportDepController::class);
Route::resource('exhibitors', ExhibitorsController::class);
Route::resource('hospitality', HospitalityDepController::class);

Route::get('flight-details', [FlightController::class, 'index'])->name('flight-details.index');
Route::get('flight-details/buyers', [FlightController::class, 'buyersDetails'])->name('flight-details.buyers');
Route::get('flight-details/visitors', [FlightController::class, 'visitorsDetails'])->name('flight-details.visitors');
Route::get('flight-details/select-buyer', [FlightController::class, 'buyerSelection'])->name('flight-details.buyer_selection');
Route::get('flight-details/create', [FlightController::class, 'create'])->name('flight-details.create');
Route::post('flight-details/create', [FlightController::class, 'store'])->name('flight-details.store');



Route::post('flight-details', [FlightController::class, 'store'])->name('flight-details.store');
Route::get('flight-details/{flight_detail}', [FlightController::class, 'show'])->name('flight-details.show');
Route::get('flight-details/{flight_detail}/edit', [FlightController::class, 'edit'])->name('flight-details.edit');
Route::put('flight-details/{flight_detail}', [FlightController::class, 'update'])->name('flight-details.update');
Route::delete('flight-details/{flight_detail}', [FlightController::class, 'destroy'])->name('flight-details.destroy');


Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

Route::post('/submit-elementor-form', [WebsiteFormController::class, 'store'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::post('/api/submit-visitor-form', [WebsiteFormController::class, 'submitVisitorForm']);
Route::post('/api/submit-exhibitor-form', [WebsiteFormController::class, 'submitExhibitorForm']);


require __DIR__.'/auth.php';
