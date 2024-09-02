<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\DriverController;
use App\Http\Controllers\admin\BusController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\RouteController;
use App\Http\Controllers\admin\StopController;
use App\Http\Controllers\admin\ScheduleController;
use App\Http\Controllers\admin\LinkController;
use App\Http\Controllers\admin\GpsTrackingController;
use App\Http\Controllers\admin\CheckinController;
use App\Http\Controllers\admin\AnnouncementController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\Admin\ExternalBusController;
use App\Http\Controllers\User\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[HomeController::class,'index']);
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    //admin view driver
    Route::get('/view_driver', [DriverController::class, 'viewDriver'])->name('driver.view');
    Route::get('/add_driver', [DriverController::class, 'showAddDriverForm'])->name('driver.add');
    Route::post('/add_driver', [DriverController::class, 'addDriver'])->name('driver.store');
    Route::get('/edit_driver/{id}', [DriverController::class, 'editDriver'])->name('driver.edit');
    Route::delete('/delete_driver/{id}', [DriverController::class, 'deleteDriver'])->name('driver.delete');
    Route::put('/update_driver/{id}', [DriverController::class, 'updateDriver'])->name('driver.update');
    Route::get('/report_driver', [DriverController::class, 'viewReport'])->name('driver.report');
    Route::get('/help', function () { return view('admin.driver.help');})->name('driver.help');
    Route::get('/detail/{id}', [DriverController::class, 'viewDriverDetail'])->name('driver.detail');


    //admin view bus from driver
    Route::get('/driver/{id}/view-bus', [BusController::class, 'index'])->name('bus.view');
    Route::get('/driver/{id}/create-bus', [BusController::class, 'create'])->name('bus.add');
    Route::post('/driver/{id}/store-bus', [BusController::class, 'store'])->name('bus.store');
    Route::get('/driver/{id}/select-bus', [BusController::class, 'selectBus'])->name('bus.select');
    Route::post('/driver/{id}/attach-bus', [BusController::class, 'attachBusToDriver'])->name('bus.attach');
    Route::get('/bus/{id}/edit', [BusController::class, 'edit'])->name('bus.edit');
    Route::delete('/bus/{id}/delete', [BusController::class, 'destroy'])->name('bus.delete');
    Route::put('/bus/{id}', [BusController::class, 'update'])->name('bus.update');

    //admin view user
    Route::get('/users', [UserController::class, 'viewUsers'])->name('user.view');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/users/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/users/view', [UserController::class, 'viewUsersBeforeDelete'])->name('user.viewdelete');
    Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->name('user.delete');

    //admin view route
    Route::get('/view-routes', [RouteController::class, 'index'])->name('route.view');
    Route::get('/add-route', [RouteController::class, 'create'])->name('route.add');
    Route::delete('/routes/{id}', [RouteController::class, 'destroy'])->name('route.delete');
    Route::post('/store-route', [RouteController::class, 'store'])->name('route.store');

    //admin view stop
    Route::get('/view-stops', [StopController::class, 'index'])->name('stop.view');
    Route::get('/create-stop-schedule', [StopController::class, 'create'])->name('stop.add');
    Route::post('/store-stop-schedule', [StopController::class, 'store'])->name('stop.store');
    Route::delete('/stop/{id}', [StopController::class, 'delete'])->name('stop.delete');


    //admin view schedule
    Route::get('/view-schedules', [ScheduleController::class, 'index'])->name('schedule.view');
    Route::get('/view-schedules/delete', [ScheduleController::class, 'viewbeforedelete'])->name('schedule.beforedelete');
    Route::get('/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
    Route::put('/schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::get('/create-schedule', [ScheduleController::class, 'create'])->name('schedule.add');
    Route::post('/store-schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/admin/schedule/delete/{scheduleID}', [ScheduleController::class, 'delete'])->name('schedule.delete');

    //admin link schedule
    Route::get('/link', [LinkController::class, 'create'])->name('link.create');
    Route::post('/link', [LinkController::class, 'store'])->name('link.store');
    Route::delete('/link/{stop}/{schedule}', [LinkController::class, 'destroy'])->name('link.destroy');

    //admin view announcement
    Route::get('announcements', [AnnouncementController::class, 'index'])->name('announcement.view');
    Route::get('announcements/create', [AnnouncementController::class, 'create'])->name('announcement.create');
    Route::post('announcements', [AnnouncementController::class, 'store'])->name('announcement.store');
    Route::get('announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcement.edit');
    Route::put('announcements/{announcement}', [AnnouncementController::class, 'update'])->name('announcement.update');
    Route::delete('announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');


    //admin view bus for booking
    Route::get('/view_externalBus', [ExternalBusController::class, 'showBusSchedules'])->name('external_bus.view');
    Route::get('/external_bus/{bus}/edit', [ExternalBusController::class, 'edit'])->name('external_bus.edit');
    Route::delete('/external_bus/{bus}', [ExternalBusController::class, 'destroy'])->name('external_bus.destroy');
    Route::put('/external_bus/{bus}', [ExternalBusController::class, 'update'])->name('external_bus.update');
    Route::post('/external-bus/store', [ExternalBusController::class, 'store'])->name('external_bus.store');
    Route::get('/admin/external_bus/add', [ExternalBusController::class, 'create'])->name('external_bus.add');


});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {

    Route::get('/mainpage', function () { return view('user.mainpage');})->name('mainpage');
    Route::get('/view-schedule', [ScheduleController::class, 'viewSchedule'])->name('schedule.view');
    Route::get('/view-stop', [StopController::class, 'viewStop'])->name('stop.view');
    Route::get('/about', function () { return view('user.about_us');})->name('about');
    Route::get('/service', function () { return view('user.view_service');})->name('service');
    Route::get('/tracking', [GpsTrackingController::class, 'getLocationData'])->name('tracking');
    Route::get('/find-bus', [BusController::class, 'findBus'])->name('find.bus');
    Route::get('/profile',[ProfileController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/view-booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/{busId}/seats', [BookingController::class, 'getSeats'])->name('booking.seats');
    Route::post('/book-seat', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/ticket', [TicketController::class, 'show'])->name('ticket.show');

});
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
// Route to view the bus tracking map

Route::post('/update-location', [GpsTrackingController::class, 'updateLocation']);
Route::get('/location-data', [GpsTrackingController::class, 'getLocationData'])->middleware('auth');

Route::group(['prefix' => 'driver', 'as' => 'driver.'], function () {
    Route::get('/main', function () { return view('driver.main');})->name('main');
    Route::get('/about', function () { return view('driver.about');})->name('about');
    Route::post('/location', [GpsTrackingController::class, 'updateLocation'])->name('gps');
    Route::get('/tracking', function () {
        // Fetch location data or prepare necessary data for the view
        $locationDatas = []; // Example data retrieval, replace with actual data fetching logic

        return view('driver.tracking', compact('locationDatas'));
    })->name('tracking');

    Route::get('/checkin', [CheckinController::class, 'checkinIndex'])->name('checkin');
    Route::post('/checkin', [CheckinController::class, 'checkinStore'])->name('checkin.store');
    Route::get('/checkout', [CheckinController::class, 'checkoutIndex'])->name('checkout');
    Route::post('/checkout', [CheckinController::class, 'checkoutStore'])->name('checkout.store');
    Route::get('/events', [CheckinController::class, 'events'])->name('events');
    Route::get('/my_attendance', [CheckinController::class, 'view'])->name('attendance');
    Route::get('/profile',[ProfileController::class, 'driver_profile'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

});
