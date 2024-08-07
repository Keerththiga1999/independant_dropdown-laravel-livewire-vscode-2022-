<?php

use App\Livewire\CategorySubcategory;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/category-dropdown',CategorySubcategory::class)->name('category.dropdown');