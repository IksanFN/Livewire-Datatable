<?php

use Illuminate\Support\Facades\Route;


Route::get('/', \App\Livewire\Users\Index::class);
Route::get('/posts', \App\Livewire\Posts\Index::class)->name('posts');