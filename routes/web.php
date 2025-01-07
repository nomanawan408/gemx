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
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisaController;
use App\Http\Controllers\InvitationController;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Middleware\CheckPendingStatus;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', CheckPendingStatus::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.index');

    Route::get('/profile/{id?}', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    
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
    Route::post('flight-details', [FlightController::class, 'store'])->name('flight-details.store');



    Route::get('flight-details/{flight_detail}', [FlightController::class, 'show'])->name('flight-details.show');
    Route::get('flight-details/{flight_detail}/edit', [FlightController::class, 'edit'])->name('flight-details.edit');
    Route::put('flight-details/{flight_detail}', [FlightController::class, 'update'])->name('flight-details.update');
    Route::delete('flight-details/{flight_detail}', [FlightController::class, 'destroy'])->name('flight-details.destroy');
    
    // Accommodation
    Route::get('accommodation', [AccommodationController::class, 'index'])->name('accommodation.index');
    Route::delete('accommodation/{accommodation}', [AccommodationController::class, 'destroy'])->name('accommodation.destroy');
    Route::get('accommodation/{accommodation}/edit', [AccommodationController::class, 'edit'])->name('accommodation.edit');
    Route::get('accommodation/select-user', [AccommodationController::class, 'select_user'])->name('accommodation.select_user');
    Route::get('accommodation/create', [AccommodationController::class, 'create'])->name('accommodation.create');
    Route::post('accommodation/store', [AccommodationController::class, 'store'])->name('accommodation.store');
    Route::get('accommodation/self-create', [FlightController::class, 'selfcreate'])->name('accommodation.selfcreate');

    // Route::get('accommodation/{accommodation}', [AccommodationController::class, 'show'])->name('accommodation.view');
    // Route::get('accommodation/{accommodation}/edit', [AccommodationController::class, 'accommodationEdit'])->name('accommodation.edit');
    // Route::put('accommodation/{accommodation}/update', [AccommodationController::class, 'accommodationUpdate'])->name('accommodation.update');

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

    // invitation letter
    Route::get('/invitation-letter', [InvitationController::class, 'index'])->name('invitation.index');
    Route::get('/invitation-letter/create', [InvitationController::class, 'create'])->name('invitation-letter.create');
    Route::post('/invitation-letter', [InvitationController::class, 'store'])->name('invitation-letter.store');
    Route::get('/invitation-letter/{id}', [InvitationController::class, 'show'])->name('invitation-letter.show');
    Route::delete('/invitation-letter/{id}', [InvitationController::class, 'destroy'])->name('invitation-letter.destroy');

    // For Entry Pass
    Route::get('/entry-pass', [InvitationController::class, 'entryPass'])->name('entry-pass.index');
    Route::get('/entry-pass/create', [InvitationController::class, 'entryPassCreate'])->name('entry-pass.create');
    Route::post('/entry-pass', [InvitationController::class, 'entryPassStore'])->name('entry-pass.store');
    Route::get('/entry-pass/{id}', [InvitationController::class, 'entryPassShow'])->name('entry-pass.show');
    Route::delete('/entry-pass/{id}', [InvitationController::class, 'entryPassDestroy'])->name('entry-pass.destroy');


    Route::get('/invitation/download', function () {
        $pdf = Pdf::loadView('invitation.index'); // 'invitation' is your Blade file
        return $pdf->download('invitation.pdf');
    })->name('invitation.download');

    Route::get('/pending', function () {
        return view('auth.pending'); // Create this view file
    })->name('pending.default');
    
    Route::get('/rejected', function () {
        return view('auth.rejected'); // Create a Blade view for this route
    })->name('rejected.default');
    
});



Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('https://pkgjs.com');
})->middleware('auth')->name('logout');


// APIs for website forms
Route::post('/submit-national-visitor-form', [WebsiteFormController::class, 'submit_national_visitor_form'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/submit-international-visitor-form', [WebsiteFormController::class, 'submit_international_visitor_form'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/submit-exhibitor-form', [WebsiteFormController::class, 'submit_exhibitor_form'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/submit-buyer-form', [WebsiteFormController::class, 'submit_buyer_form'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);


require __DIR__.'/auth.php';
