<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::get('{any}', function () {
    return view('welcome');
})->where('any','.*');
