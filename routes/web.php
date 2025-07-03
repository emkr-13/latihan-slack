<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Notification;
use App\Notifications\exampleNotfikasiSlack;

Route::get('/', function () {
    // Notification::route('mail', 'recipient@example.com')->notify(new exampleNotfikasiSlack());
    Notification::route('slack', env('WEBHOOKS_URL_SlACK'))->notify(new exampleNotfikasiSlack());
    return view('welcome');
});
