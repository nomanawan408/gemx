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
use App\Http\Controllers\PKGJSSalesController;
use App\Http\Controllers\PKGJSPurchaseController;
use App\Http\Controllers\FloorPlanController;
use App\Http\Controllers\FBRTaxController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\SalePurchaseController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\OnspotEntryController;
use App\Http\Controllers\EntryPassController;


use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Middleware\CheckPendingStatus;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/mypass', function () {
    return view('entrypass.entrypass_templete');
});
Route::middleware(['auth', CheckPendingStatus::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.index');

    Route::get('/profile/{id?}', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/personal-profile/{id?}', [ProfileController::class, 'personalProfile'])->name('profile.personal');

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
    Route::get('/entry-pass/{uuid}', [InvitationController::class, 'entryPassShow'])->name('entry-pass.show');
    Route::delete('/entry-pass/{id}', [InvitationController::class, 'entryPassDestroy'])->name('entry-pass.destroy');

    // PKGJS routes
    Route::get('/pkgjs-sales', [PKGJSSalesController::class, 'index'])->name('pkgjs-sales.index');
    Route::get('/pkgjs-sales/create', [PKGJSSalesController::class, 'create'])->name('pkgjs-sales.create');
    Route::post('/pkgjs-sales', [PKGJSSalesController::class, 'store'])->name('pkgjs-sales.store');
    Route::get('/pkgjs-sales/{id}', [PKGJSSalesController::class, 'show'])->name('pkgjs-sales.show');
    Route::delete('/pkgjs-sales/{id}', [PKGJSSalesController::class, 'destroy'])->name('pkgjs-sales.destroy');

    // Floor Plan routes
    Route::get('/floor-plan', [FloorPlanController::class, 'index'])->name('floor-plan.index');
    Route::get('/floor-plan/create', [FloorPlanController::class, 'create'])->name('floor-plan.create');
    Route::post('/floor-plan', [FloorPlanController::class, 'store'])->name('floor-plan.store');
    Route::get('/floor-plan/{id}', [FloorPlanController::class, 'show'])->name('floor-plan.show');
    Route::delete('/floor-plan/{id}', [FloorPlanController::class, 'destroy'])->name('floor-plan.destroy');

    // FBR Tax routes
    Route::get('/fbr-tax', [FbrTaxController::class, 'index'])->name('fbr-tax.index');
    Route::get('/fbr-tax/create', [FbrTaxController::class, 'create'])->name('fbr-tax.create');
    Route::post('/fbr-tax', [FbrTaxController::class, 'store'])->name('fbr-tax.store');
    Route::get('/fbr-tax/{id}', [FbrTaxController::class, 'show'])->name('fbr-tax.show');
    Route::delete('/fbr-tax/{id}', [FbrTaxController::class, 'destroy'])->name('fbr-tax.destroy');

    // PKGJS Purchase routes
    Route::get('/pkgjs-purchase', [PKGJSPurchaseController::class, 'index'])->name('pkgjs-purchase.index');
    Route::get('/pkgjs-purchase/create', [PKGJSPurchaseController::class, 'create'])->name('pkgjs-purchase.create');
    Route::post('/pkgjs-purchase', [PKGJSPurchaseController::class, 'store'])->name('pkgjs-purchase.store');
    Route::get('/pkgjs-purchase/{id}', [PKGJSPurchaseController::class, 'show'])->name('pkgjs-purchase.show');
    Route::delete('/pkgjs-purchase/{id}', [PKGJSPurchaseController::class, 'destroy'])->name('pkgjs-purchase.destroy');

    // Export CSV
    Route::get('/buyers-details/export-csv', [FlightController::class, 'exportBuyersCsv'])->name('buyers.export.csv');
    Route::get('/visitors-details/export-csv', [FlightController::class, 'exportVisitorsCsv'])->name('visitors.export.csv');

    // Sale Purchase Controller
    Route::get('sale-purchase', [SalePurchaseController::class, 'index'])->name('sale-purchase.index');
    Route::get('sale-purchase/sales', [SalePurchaseController::class, 'viewSales'])->name('sale-purchase.sales');
    Route::get('sale-purchase/purchases', [SalePurchaseController::class, 'viewPurchase'])->name('sale-purchase.purchase');
    Route::get('sale-purchase/{id}/upload', [SalePurchaseController::class, 'create'])->name('sale-purchase.create');
    Route::post('sale-purchase/store', [SalePurchaseController::class, 'store'])->name('sale-purchase.store');
    Route::delete('sale-purchase/destroy', [SalePurchaseController::class, 'deleteSalePurchase'])->name('sale-purchase.delete');

    // Onspot Entry
    Route::get('/onspot-users', [OnspotEntryController::class, 'index'])->name('onspot-entry.index');
    Route::get('/onspot-users/create', [OnspotEntryController::class, 'create'])->name('onspot-entry.create');
    Route::post('/onspot-users', [OnspotEntryController::class, 'store'])->name('onspot-entry.store');
    Route::get('/onspot-users/{id}', [OnspotEntryController::class, 'show'])->name('onspot-entry.show');
    Route::delete('onspot-users/{id}', [OnspotEntryController::class, 'destroy'])->name('users.delete');

    Route::get('/invitation/download', function () {
        $pdf = Pdf::loadView('invitation.index'); // 'invitation' is your Blade file
        return $pdf->download('invitation.pdf');
    })->name('invitation.download');

    Route::get('/entry-pass/download/{user_id}', [EntryPassController::class, 'generatePDF'])->name('entry-pass.download');




    Route::get('/pending', function () {
        return view('auth.pending'); // Create this view file
    })->name('pending.default');
    
    Route::get('/rejected', function () {
        return view('auth.rejected'); // Create a Blade view for this route
    })->name('rejected.default');
    
});

Route::middleware(['auth'])->group(function () {
    Route::get('/change-password/form', [ChangePasswordController::class, 'index'])->name('auth.password.change');
    Route::put('/change-password/update', [ChangePasswordController::class, 'update'])->name('auth.password.update');
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
