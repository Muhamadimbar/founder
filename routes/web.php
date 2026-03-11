<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminPortfolioController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProfileController;

// ── PUBLIC ROUTES ──
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');
Route::get('/layanan', [ServiceController::class, 'index'])->name('services');
Route::get('/layanan/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
Route::get('/portofolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/pesan', [OrderController::class, 'index'])->name('order');
Route::post('/pesan', [OrderController::class, 'store'])->name('order.store');
Route::get('/pesan/sukses/{orderNumber}', [OrderController::class, 'success'])->name('order.success');
Route::get('/harga', fn() => view('pricing'))->name('pricing');

// ── AUTH ROUTES ──
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');

// ── ADMIN ROUTES ──
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Services
    Route::resource('services', AdminServiceController::class);

    // Contacts
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
    Route::patch('/contacts/{contact}/read', [AdminContactController::class, 'markRead'])->name('contacts.read');

    // Testimonials
    Route::resource('testimonials', AdminTestimonialController::class);

    // Portfolio
    Route::resource('portfolio', AdminPortfolioController::class);

    // Orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

    // Profile
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');
});
