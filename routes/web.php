<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/iframe',function (){
    $includedLanguages = implode(",", filament('spatie-laravel-translatable')->getDefaultLocales());
    return view('filament-automatic-translation-for-spatie-laravel-translatable-plugin::iframe', compact('includedLanguages'));
});
