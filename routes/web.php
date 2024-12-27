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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisaController;



Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
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
    Route::get('flight-details/self-create', [FlightController::class, 'selfcreate'])->name('flight-details.selfcreate');
    Route::post('flight-details/create-flight', [FlightController::class, 'createflight'])->name('flight-details.createflight');
    Route::post('flight-details/create', [FlightController::class, 'store'])->name('flight-details.store');



    Route::post('flight-details', [FlightController::class, 'store'])->name('flight-details.store');
    Route::get('flight-details/{flight_detail}', [FlightController::class, 'show'])->name('flight-details.show');
    Route::get('flight-details/{flight_detail}/edit', [FlightController::class, 'edit'])->name('flight-details.edit');
    Route::put('flight-details/{flight_detail}', [FlightController::class, 'update'])->name('flight-details.update');
    Route::delete('flight-details/{flight_detail}', [FlightController::class, 'destroy'])->name('flight-details.destroy');
    
    // status update
    Route::post('/users/{id}/approve', [DashboardController::class, 'approveUser'])->name('users.approve');
    Route::post('/users/{id}/reject', [DashboardController::class, 'rejectUser'])->name('users.reject');

    //visa route 
    Route::get('/visa', [VisaController::class, 'index'])->name('visa.index');
    Route::get('/visa/create', [VisaController::class, 'create'])->name('visa.create');
    Route::post('/visa', [VisaController::class, 'store'])->name('visa.upload');
    Route::get('/visa/{id}', [VisaController::class, 'visaShow'])->name('visa.show');
    Route::delete('/visa/{visa}', [VisaController::class, 'destroy'])->name('visa.destroy');


    Route::post('/visa/{id}/approve', [VisaController::class, 'approveVisa'])->name('visa.approve');
    Route::post('/visa/{id}/reject', [VisaController::class, 'rejectVisa'])->name('visa.reject');

});

Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');


// APIs for website forms
Route::post('/submit-national-visitor-form', [WebsiteFormController::class, 'submit_national_visitor_form'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/submit-international-visitor-form', [WebsiteFormController::class, 'submit_international_visitor_form'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/submit-exhibitor-form', [WebsiteFormController::class, 'submit_exhibitor_form'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/submit-buyer-form', [WebsiteFormController::class, 'submit_buyer_form'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);


require __DIR__.'/auth.php';
