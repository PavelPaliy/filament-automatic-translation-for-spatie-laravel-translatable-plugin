<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/iframe',function (){
    $includedLanguages = implode(",", filament('spatie-laravel-translatable')->getDefaultLocales());
    return view('automatic-translation::iframe', compact('includedLanguages'));
});
