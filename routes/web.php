<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use App\Livewire\Dashboard;
use App\Livewire\SettingsPage;
use App\Livewire\Task\EditPage;
use App\Livewire\Task\ExpiredTasksPage;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::view('/', 'welcome')->name('home');

    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');

});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::get('health', HealthCheckResultsController::class);

/* auth */
Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');

    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('app/expired', ExpiredTasksPage::class)->name('task.expired');
    Route::get('app/{list?}', Dashboard::class)
        ->name('dashboard');

    Route::get('task/{task}', EditPage::class)->name('task.edit');

    Route::get('settings', SettingsPage::class)->name('settings');
});


Route::get('force-refresh', function(TaskService $taskService) {
    foreach(Task::all() as $task) {
        $taskService->updateScore($task);
    }
});