<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Schools\Index as SchoolIndex;
use App\Livewire\Admin\Courses\Index as CoursesIndex;
use App\Livewire\Admin\Service\Index as ServiceIndex;
use App\Livewire\Admin\Vehicle\Index as VehicleIndex;



Route::middleware('auth', 'admin')->name('admin.')->group(function () {
    Route::get('/schools', [SchoolIndex::class, '__invoke'])->name('schools');
    Route::get('/courses', [CoursesIndex::class, '__invoke'])->name('courses');
    Route::get('/services', [ServiceIndex::class, '__invoke'])->name('services');
    Route::get('/vehicles', [VehicleIndex::class, '__invoke'])->name('vehicles');
});
