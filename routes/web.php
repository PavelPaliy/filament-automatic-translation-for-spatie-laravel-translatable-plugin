<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/iframe',function (){
    return view('automatic-translation::iframe');
});
