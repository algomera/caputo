<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Schools\Index as SchoolIndex;
use App\Livewire\Admin\Courses\Index as CoursesIndex;



Route::middleware('auth', 'admin')->name('admin.')->group(function () {
    Route::get('/schools', [SchoolIndex::class, '__invoke'])->name('schools');
    Route::get('/courses', [CoursesIndex::class, '__invoke'])->name('courses');
});
