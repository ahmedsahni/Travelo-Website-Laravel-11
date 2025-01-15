<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OpenAIController;


Route::get('/', [UserController::class, 'index'])->name('index');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes (with auth middleware)
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/dashboard/delete', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::get('/edit-user', [AdminController::class, 'editUser'])->name('admin.edit-user');
    Route::post('/edit-users/{id}', [AdminController::class, 'updateUser']);
    Route::get('/manage-booking', [AdminController::class, 'manageBooking'])->name('admin.manage-booking');
    // In routes/web.php
Route::get('admin/countries', [AdminController::class, 'countries'])->name('admin.countries');

    Route::post('/countries', [AdminController::class, 'storeCountry']);
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
    Route::post('/notifications', [AdminController::class, 'storeNotification']);

    // Delete user route (POST method for form submission)


});

// User Routes (with auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/main', [UserController::class, 'mainPage'])->name('user.main');
    Route::get('/countries', [UserController::class, 'viewCountries'])->name('user.countries');
    Route::get('booking/{country_id}', [BookingController::class, 'indexBooking'])->name('user.booking');

    // Store the booking details (POST route)
    Route::post('/booking', [BookingController::class, 'storeBooking'])->name('booking.store');
    Route::delete('/booking/{id}/delete', [BookingController::class, 'deleteBooking'])->name('delete.booking');
    Route::get('/myTravels', [UserController::class, 'myTravels'])->name('user.myTravels');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/notifications', [UserController::class, 'notifications'])->name('user.notifications');
});


// Routes for Join and Home
Route::get('/join', [UserController::class, 'join'])->name('traveller.join');
Route::get('/home', [UserController::class, 'home'])->name('home');



Route::get('/admin/manage-booking', [AdminController::class, 'manageBooking'])->name('admin.manage-booking');
Route::get('/admin/edit-booking/{id}', [AdminController::class, 'editBooking'])->name('admin.edit-booking');
Route::post('/admin/edit-booking/{id}', [AdminController::class, 'updateBooking']);

Route::get('/admin/edit-user/{id}', [AdminController::class, 'editUser'])->name('admin.edit-user');

Route::put('/admin/update-user/{id}', [AdminController::class, 'updateUser'])->name('update.user');
Route::get('admin/countries', [AdminController::class, 'countries'])->name('admin.countries');
Route::post('admin/countries', [AdminController::class, 'storeCountry']);
Route::post('admin/countries', [CountryController::class, 'store'])->name('countries.store');

// routes/web.php
Route::get('admin/countries/delete/{id}', [CountryController::class, 'destroy'])->name('countries.delete');

Route::get('admin/countries', [CountryController::class, 'index'])->name('country.index');




// Route to display the list of bookings
Route::get('admin/manage-booking', [BookingController::class, 'index'])->name('admin.manage-booking.index');

// Route to display the edit form for a specific booking
Route::get('admin/manage-booking/edit/{id}', [BookingController::class, 'edit'])->name('admin.manage-booking.edit');

// Route to handle the update of a specific booking
Route::put('admin/manage-booking/update/{id}', [BookingController::class, 'update'])->name('admin.manage-booking.update');

// Route to delete a booking
Route::delete('admin/manage-booking/delete/{id}', [BookingController::class, 'destroy'])->name('admin.manage-booking.delete');



Route::get('admin/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('admin/notifications', [NotificationController::class, 'store'])->name('notifications.store');
Route::delete('admin/notifications/delete/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');




Route::get('profile', [UserController::class, 'profile'])->name('user.profile');

Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');


Route::get('/chat', function () {
    return view('user.chat');
})->name('chat');
Route::post('/send-message', [OpenAIController::class, 'sendMessage'])->name('send.message');

