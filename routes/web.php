<?php

use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Client\GalleryController;
use App\Http\Controllers\Client\ProvidingController;
use App\Http\Controllers\Content\ContactAdminController;
use App\Http\Controllers\Content\GalleryingController;
use App\Http\Controllers\Content\OpenHoursController;
use App\Http\Controllers\Content\PricingFeatureController;
use App\Http\Controllers\Content\TariffController;
use App\Http\Controllers\Customerss\CustomerDashboardController;
use App\Http\Controllers\Facility\FacilityServiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Client\AboutController;
use App\Http\Controllers\Client\AppointmentController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\IndexController;
use App\Http\Controllers\Client\OpeningController;
use App\Http\Controllers\Client\PriceController;
use App\Http\Controllers\Client\ServiceController;
use App\Http\Controllers\Client\TeamController;
use App\Http\Controllers\Client\TestimonialController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Facility\FacilityController;
use App\Http\Controllers\Facility\ServicePricingController;
use App\Http\Controllers\Facility\ServiceTypeController;
use App\Http\Controllers\Appointment\AppointController;
use App\Http\Controllers\Appointment\AcceptedAppointmentController;
use App\Http\Controllers\Content\HomeContentController;
use App\Http\Controllers\Content\HomeCarouselController;
use App\Http\Controllers\Content\AboutingController;
use App\Http\Controllers\Content\ProvideController;
use App\Http\Controllers\Content\PricingPlanController;
use App\Http\Controllers\Content\AdminPricingDisplayController;
use App\Http\Controllers\Content\TeamingController;
use App\Http\Controllers\Content\TestimController;
use App\Http\Controllers\Administrator\UserManagementController;




// ---------------------------Public Front Client-------------------------------------

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/opening', [OpeningController::class, 'index'])->name('opening');
Route::get('/price', [PriceController::class, 'index'])->name('price');
Route::get('/service', [ServiceController::class, 'index'])->name('service');
Route::get('/team', [TeamController::class, 'index'])->name('team');
Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimonial');
Route::get('/tariffs', [TariffController::class, 'index'])->name('tariffs.index');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');



Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment.index');
Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointment.store');
Route::get('/get-service-types/{serviceId}', [AppointmentController::class, 'getServiceTypes']);

Route::get('/provides', [ProvidingController::class, 'index'])->name('client.provide.index');

// Show details of a specific service
Route::get('/provide/{id}', [ProvidingController::class, 'show'])->name('client.provide.show');

// ---------------------------Auth-------------------------------------

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('auth.register');

Route::post('/register', [RegisterController::class, 'register'])->name('auth.register.submit');

//LoginController
// Show the login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');

// Handle the login submission

Route::post('/login', [LoginController::class, 'login'])->name('auth.login.submit');


Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route to update password
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});



// Super Admin Dashboard

Route::get('/dashboard/superadmin', [SuperAdminController::class, 'index'])
    ->middleware('role:Super Admin')
    ->name('superadmin.dashboard');

Route::get('/test/superadmin', function () {
    return view('admin.admins.blank');
})->middleware('role:Super Admin')->name('blank.pages');


// Admin Dashboard
Route::get('/dashboard/admin', function () {
    return view('admin.admins.admin');
})->middleware('role:Admin')->name('admin.dashboard');

// Manager Dashboard
Route::get('/dashboard/manager', function () {
    return view('admin.manager.manager');
})->middleware('role:Manager')->name('manager.dashboard');

// Staff Dashboard
Route::get('/dashboard/staff', function () {
    return view('admin.staff.staff');
})->middleware('role:Staff')->name('staff.dashboard');



// Super Admin Dashboard
Route::middleware('role:Super Admin')->prefix('admin')->group(function () {
    // Admin facility routes
    Route::get('/facilities', [FacilityController::class, 'index'])->name('facilities.index');
    Route::get('/facilities/create', [FacilityController::class, 'create'])->name('facilities.create');
    Route::post('/facilities', [FacilityController::class, 'store'])->name('facilities.store');
    Route::get('/facilities/{facility}/edit', [FacilityController::class, 'edit'])->name('facilities.edit');
    Route::put('/facilities/{facility}', [FacilityController::class, 'update'])->name('facilities.update');
    Route::delete('/facilities/{facility}', [FacilityController::class, 'destroy'])->name('facilities.destroy');


    // Pricing routes
    Route::get('/pricing', [ServicePricingController::class, 'index'])->name('pricing.index');
    Route::post('/pricing', [ServicePricingController::class, 'store'])->name('pricing.store');
    Route::get('/pricing/{pricing}/edit', [ServicePricingController::class, 'edit'])->name('pricing.edit');
    Route::put('/pricing/{pricing}', [ServicePricingController::class, 'update'])->name('pricing.update');
    Route::delete('/pricing/{pricing}', [ServicePricingController::class, 'destroy'])->name('pricing.destroy');


    // Service Type routes
    Route::get('/service-types', [ServiceTypeController::class, 'index'])->name('service_types.index');
    Route::get('/service-types/create', [ServiceTypeController::class, 'create'])->name('service_types.create');
    Route::post('/service-types', [ServiceTypeController::class, 'store'])->name('service_types.store');
    Route::get('/service-types/{serviceType}/edit', [ServiceTypeController::class, 'edit'])->name('service_types.edit');
    Route::put('/service-types/{serviceType}', [ServiceTypeController::class, 'update'])->name('service_types.update');
    Route::delete('/service-types/{serviceType}', [ServiceTypeController::class, 'destroy'])->name('service_types.destroy');
    // list
    Route::get('/facility-services', [FacilityServiceController::class, 'index'])->name('facility.services.index');



    // Appointment routes
    Route::get('/appointments', [AppointController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointController::class, 'store'])->name('appointments.store');
    //Route::get('/appointments/{appointment}/edit', [AppointController::class, 'edit'])->name('appointments.edit');
    //Route::put('/appointments/{appointment}', [AppointController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{appointment}', [AppointController::class, 'destroy'])->name('appointments.destroy');

    Route::post('/appointments/{id}/accept', [AppointController::class, 'accept'])->name('appointments.accept');
    Route::delete('/appointments/{id}/decline', [AppointController::class, 'decline'])->name('appointments.decline');

    Route::get('/appointments/accepted', [AcceptedAppointmentController::class, 'index'])->name('appointments.accepted');


    // Route to generate a report
    Route::get('/appointments/accepted/report', [AcceptedAppointmentController::class, 'generateReport'])->name('appointments.report');




    // Routes for home content management
    Route::get('/admin/homecontent', [HomeContentController::class, 'index'])->name('homecontent.index');
    Route::put('/admin/homecontent/update', [HomeContentController::class, 'update'])->name('homecontent.update');



    //courrsel route
    Route::get('/home/carousel', [HomeCarouselController::class, 'index'])->name('home.carousel.index');
    Route::get('/home/carousel/create', [HomeCarouselController::class, 'create'])->name('home.carousel.create');
    Route::post('/home/carousel/store', [HomeCarouselController::class, 'store'])->name('home.carousel.store');
    Route::get('/home/carousel/edit/{id}', [HomeCarouselController::class, 'edit'])->name('home.carousel.edit');
    Route::post('/home/carousel/update/{id}', [HomeCarouselController::class, 'update'])->name('home.carousel.update');
    Route::delete('/home/carousel/delete/{id}', [HomeCarouselController::class, 'destroy'])->name('home.carousel.destroy');
    Route::put('home/carousel/{id}', [HomeCarouselController::class, 'update'])->name('home.carousel.update');


    //About courrsel
    Route::get('about', [AboutingController::class, 'index'])->name('about.index');
    Route::get('about/edit', [AboutingController::class, 'edit'])->name('about.edit');
    Route::put('about/update', [AboutingController::class, 'update'])->name('about.update');


    //provider

    Route::get('/provides', [ProvideController::class, 'index'])->name('provide.index');
    Route::get('/provides/create', [ProvideController::class, 'create'])->name('provide.create');
    Route::post('/provides', [ProvideController::class, 'store'])->name('provide.store');
    Route::get('/provides/{id}/edit', [ProvideController::class, 'edit'])->name('provide.edit');
    Route::put('/provides/{id}', [ProvideController::class, 'update'])->name('provide.update');
    Route::delete('/provides/{id}', [ProvideController::class, 'destroy'])->name('provide.destroy');


    //hours open
    Route::get('openhours', [OpenHoursController::class, 'index'])->name('openhours.index'); // View Open Hours
    Route::get('openhours/edit', [OpenHoursController::class, 'edit'])->name('openhours.edit'); // Edit Open Hours
    Route::put('openhours/update', [OpenHoursController::class, 'update'])->name('openhours.update'); // Update Open Hours


    //pricing
    // Show all pricing plans
    Route::get('pricingplan', [PricingPlanController::class, 'index'])->name('pricingplan.index');
    Route::get('pricingplan/create', [PricingPlanController::class, 'create'])->name('pricingplan.create');
    Route::post('pricingplan/store', [PricingPlanController::class, 'store'])->name('pricingplan.store');
    Route::get('pricingplan/edit/{id}', [PricingPlanController::class, 'edit'])->name('pricingplan.edit');
    Route::put('pricingplan/update/{id}', [PricingPlanController::class, 'update'])->name('pricingplan.update');
    Route::delete('pricingplan/delete/{id}', [PricingPlanController::class, 'destroy'])->name('pricingplan.destroy');


    //features
    Route::get('pricingfeatures', [PricingFeatureController::class, 'index'])->name('pricingfeatures.index');
    Route::get('pricingfeatures/create', [PricingFeatureController::class, 'create'])->name('pricingfeatures.create');
    Route::post('pricingfeatures/store', [PricingFeatureController::class, 'store'])->name('pricingfeatures.store');
    Route::get('pricingfeatures/edit/{id}', [PricingFeatureController::class, 'edit'])->name('pricingfeatures.edit');
    Route::put('pricingfeatures/update/{id}', [PricingFeatureController::class, 'update'])->name('pricingfeatures.update');
    Route::delete('pricingfeatures/delete/{id}', [PricingFeatureController::class, 'destroy'])->name('pricingfeatures.destroy');

    // pricing features
    Route::get('admin/pricing', [AdminPricingDisplayController::class, 'index'])->name('admin.pricing.index');
    Route::get('admin/pricing/{id}', [AdminPricingDisplayController::class, 'show'])->name('admin.pricing.show');


    //Teaming
    Route::get('/team', [TeamingController::class, 'index'])->name('team.index');
    Route::get('/team/create', [TeamingController::class, 'create'])->name('team.create');
    Route::post('/team/store', [TeamingController::class, 'store'])->name('team.store');
    Route::get('/team/{id}/edit', [TeamingController::class, 'edit'])->name('team.edit');
    Route::put('/team/{id}/update', [TeamingController::class, 'update'])->name('team.update');
    Route::delete('/team/{id}', [TeamingController::class, 'destroy'])->name('team.destroy');


    //test
    Route::get('/testimonials', [TestimController::class, 'index'])->name('testimonials.index');
    Route::get('/testimonials/create', [TestimController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials', [TestimController::class, 'store'])->name('testimonials.store');
    Route::get('/testimonials/{id}/edit', [TestimController::class, 'edit'])->name('testimonials.edit');
    Route::put('/testimonials/{id}', [TestimController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{id}', [TestimController::class, 'destroy'])->name('testimonials.destroy');


    Route::get('/contacts', [ContactAdminController::class, 'index'])->name('admin.contacts.index');
    Route::delete('/contacts/{id}', [ContactAdminController::class, 'destroy'])->name('admin.contacts.destroy');


    Route::post('/contacts/bulk-delete', [ContactAdminController::class, 'bulkDelete'])->name('admin.contacts.bulkDelete');



    //tarriff
    Route::get('tariffs', [TariffController::class, 'index'])->name('tariffs.index');
    Route::get('tariffs/create', [TariffController::class, 'create'])->name('tariffs.create');
    Route::post('tariffs', [TariffController::class, 'store'])->name('tariffs.store');
    Route::delete('tariffs/{tariff}', [TariffController::class, 'destroy'])->name('tariffs.destroy');


    //gallery
    Route::get('gallery', [GalleryingController::class, 'index'])->name('gallery.index');
    Route::get('gallery/create', [GalleryingController::class, 'create'])->name('gallery.create');
    Route::post('gallery/store', [GalleryingController::class, 'store'])->name('gallery.store');
    Route::delete('gallery/{id}', [GalleryingController::class, 'destroy'])->name('gallery.destroy');
    // For bulk delete of gallery images
    Route::post('gallery/bulk-delete', [GalleryingController::class, 'bulkDelete'])->name('gallery.bulkDelete');



    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index'); // List users
    Route::get('/users/create', [UserManagementController::class, 'create'])->name('users.create'); // Create user form
    Route::post('/users', [UserManagementController::class, 'store'])->name('users.store'); // Store new user
    Route::get('/users/{id}/edit', [UserManagementController::class, 'edit'])->name('users.edit'); // Edit user form
    Route::put('/users/{id}', [UserManagementController::class, 'update'])->name('users.update'); // Update user
    Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy'); // Delete user


});

// ---------------------------Customer -------------------------------------
Route::get('/dashboard/customer', [CustomerDashboardController::class, 'index'])
    ->middleware('role:Customer')
    ->name('customer.dashboard');