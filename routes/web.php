<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Services\Index as ServiceIndex;
use App\Livewire\Services\Service\ServiziAlConducente\Index as DriverIndex;
use App\Livewire\Services\Commons\StepRegister as StepRegister;
use App\Livewire\MedicalVisits\Index as MedicalVisitIndex;
use App\Livewire\MedicalVisits\Calendar as CalendarVisit;
use App\Livewire\Registry\Index as RegistryIndex;
use App\Livewire\Registry\Show as RegistryShow;
use App\Livewire\Theory\Trainings\Index as TrainingIndex;
use App\Livewire\Theory\Lessons\Index as LessonsIndex;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::group(['middleware' => ['role:admin|responsabile sede|segretaria']], function () {
        Route::get('/service', [ServiceIndex::class, '__invoke'])->name('service');
        Route::get('/service/servizi_al_conducente/{course:slug}', [DriverIndex::class, '__invoke'])->name('service.driver');
        Route::get('/service/patenti/{course:slug}/register', [StepRegister::class, '__invoke'])->name('service.step.register');
        Route::get('/anagrafica', [RegistryIndex::class, '__invoke'])->name('registry.index');
        Route::get('/anagrafica/{customer}', [RegistryShow::class, '__invoke'])->name('registry.show');
    });

    Route::group(['middleware' => ['role:admin|responsabile sede|segretaria|insegnante']], function () {
        Route::get('/gestione-corsi', [TrainingIndex::class, '__invoke'])->name('theory.trainings.index');
        Route::get('/gestione-lezioni/{training}', [LessonsIndex::class, '__invoke'])->name('theory.lessons.index');
    });

    Route::group(['middleware' => ['role:admin|responsabile sede|segretaria|medico']], function () {
        Route::get('/visite-mediche', [MedicalVisitIndex::class, '__invoke'])->name('visits.index');
        Route::get('/visite-mediche/calendario', [CalendarVisit::class, '__invoke'])->name('visits.calendar');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
