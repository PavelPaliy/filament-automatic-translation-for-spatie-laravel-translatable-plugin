<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/iframe',function (){
    if(json_validate($_GET['locales'])){
        $includedLanguages = implode(",", json_decode($_GET['locales']));
        return view('filament-automatic-translation-for-spatie-laravel-translatable-plugin::iframe', compact('includedLanguages'));
    }
    return '';
});
