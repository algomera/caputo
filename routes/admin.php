<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Schools\Index as SchoolIndex;


Route::middleware('auth', 'admin')->name('admin.')->group(function () {
    Route::get('/schools', [SchoolIndex::class, '__invoke'])->name('schools');
});
