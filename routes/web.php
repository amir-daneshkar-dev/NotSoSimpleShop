<?php

use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/login', Login::class)->name('login');
