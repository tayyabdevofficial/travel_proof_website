<?php

use App\Http\Controllers\Admin\PricingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\VisaConsultationController as AdminVisaConsultationController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\VisaConsultationController;
use App\Models\Pricing;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $pricing = Pricing::first();
    return view('home', compact('pricing'));
})->name('home');

Route::get('/flight-booking', function () {
    $pricing = Pricing::first();
    return view('flight-booking', compact('pricing'));
})->name('flight.booking');

Route::get('/hotel-booking', function () {
    $pricing = Pricing::first();
    return view('hotel-booking', compact('pricing'));
})->name('hotel.booking');

Route::get('/combo-booking', function () {
    $pricing = Pricing::first();
    return view('combo-booking', compact('pricing'));
})->name('combo.booking');

Route::get('/how-it-works', function () {
    return view('how-it-works');
})->name('how.it.works');

Route::get('/sample', function () {
    return view('sample');
})->name('sample');

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/track', [BookingController::class, 'track'])->name('track.index');
Route::get('/track/{trackingId}', [BookingController::class, 'track'])->name('track.show');
Route::get('/track/{trackingId}/updates/{update}/download/{index}', [BookingController::class, 'downloadUpdateAttachment'])
    ->name('track.updates.download');

Route::redirect('/login', '/admin/login')->name('login');

Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('payment/{trackingId}', [BookingController::class, 'showPayment'])->name('payment.show');
Route::post('payment/{trackingId}', [BookingController::class, 'processPayment'])->name('payment.process');
Route::get('payment/flutterwave/callback/{trackingId}', [BookingController::class, 'flutterwaveCallback'])->name('payment.flutterwave.callback');
Route::get('payment/korapay/callback/{trackingId}', [BookingController::class, 'korapayCallback'])->name('payment.korapay.callback');
Route::post('payment/flutterwave/webhook', [BookingController::class, 'flutterwaveWebhook'])->name('payment.flutterwave.webhook');
Route::post('payment/korapay/webhook', [BookingController::class, 'korapayWebhook'])->name('payment.korapay.webhook');
Route::get('thank-you', [BookingController::class, 'thankYou'])->name('payment.thankyou');

Route::get('/visa-consultation', [VisaConsultationController::class, 'index'])->name('visa.consultation');
Route::post('/visa-consultation', [VisaConsultationController::class, 'store'])->name('visa.consultation.store');
Route::get('/visa-consultation/payment/{trackingId}', [VisaConsultationController::class, 'showPayment'])->name('visa.consultation.payment');
Route::post('/visa-consultation/payment/{trackingId}', [VisaConsultationController::class, 'processPayment'])->name('visa.consultation.payment.process');
Route::get('/visa-consultation/payment/flutterwave/callback/{trackingId}', [VisaConsultationController::class, 'flutterwaveCallback'])->name('visa.consultation.flutterwave.callback');
Route::get('/visa-consultation/payment/korapay/callback/{trackingId}', [VisaConsultationController::class, 'korapayCallback'])->name('visa.consultation.korapay.callback');
Route::post('/visa-consultation/payment/flutterwave/webhook', [VisaConsultationController::class, 'flutterwaveWebhook'])->name('visa.consultation.flutterwave.webhook');
Route::post('/visa-consultation/payment/korapay/webhook', [VisaConsultationController::class, 'korapayWebhook'])->name('visa.consultation.korapay.webhook');
Route::get('/visa-consultation/thank-you', [VisaConsultationController::class, 'thankYou'])->name('visa.consultation.thankyou');
Route::get('/visa-consultation/track', [VisaConsultationController::class, 'track'])->name('visa.consultation.track');
Route::get('/visa-consultation/track/{trackingId}', [VisaConsultationController::class, 'track'])->name('visa.consultation.track.show');
Route::get('/visa-consultation/track/{trackingId}/replies/{reply}/download/{index}', [VisaConsultationController::class, 'downloadReplyAttachment'])
    ->name('visa.consultation.replies.download');

Route::middleware(['auth', 'verified', 'can:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('pricing', [PricingController::class, 'edit'])
            ->name('pricing.edit');
        Route::put('pricing', [PricingController::class, 'update'])
            ->name('pricing.update');

        Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::get('bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
        Route::post('bookings/{booking}/updates', [AdminBookingController::class, 'storeUpdate'])->name('bookings.updates.store');
        Route::get('bookings/{booking}/updates/{update}/download/{index}', [AdminBookingController::class, 'downloadAttachment'])
            ->name('bookings.updates.download');

        Route::get('contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
        Route::get('contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('contact-messages.show');
        Route::post('contact-messages/{contactMessage}/replies', [ContactMessageController::class, 'storeReply'])
            ->name('contact-messages.replies.store');
        Route::get('contact-messages/{contactMessage}/replies/{reply}/download/{index}', [ContactMessageController::class, 'downloadAttachment'])
            ->name('contact-messages.replies.download');

        Route::get('visa-consultations', [AdminVisaConsultationController::class, 'index'])->name('visa-consultations.index');
        Route::get('visa-consultations/{visaConsultation}', [AdminVisaConsultationController::class, 'show'])->name('visa-consultations.show');
        Route::post('visa-consultations/{visaConsultation}/replies', [AdminVisaConsultationController::class, 'storeReply'])
            ->name('visa-consultations.replies.store');
        Route::get('visa-consultations/{visaConsultation}/replies/{reply}/download/{index}', [AdminVisaConsultationController::class, 'downloadAttachment'])
            ->name('visa-consultations.replies.download');

        Route::get('blogs', [AdminBlogController::class, 'index'])->name('blogs.index');
        Route::get('blogs/create', [AdminBlogController::class, 'create'])->name('blogs.create');
        Route::post('blogs', [AdminBlogController::class, 'store'])->name('blogs.store');
        Route::get('blogs/{blog}/edit', [AdminBlogController::class, 'edit'])->name('blogs.edit');
        Route::put('blogs/{blog}', [AdminBlogController::class, 'update'])->name('blogs.update');
        Route::delete('blogs/{blog}', [AdminBlogController::class, 'destroy'])->name('blogs.destroy');
    });


require __DIR__.'/settings.php';
