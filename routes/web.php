<?php

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

Route::macro('setGroupNamespace', function ($namespace) {
    // Get last groupStack data and hard change the namespace value
    $lastGroupStack = array_pop($this->groupStack);
    if ($lastGroupStack !== null) {
        array_set($lastGroupStack, 'namespace', $namespace);
        $this->groupStack[] = $lastGroupStack;
    }
    return $this;
});

Route::get('/', 'HomeController@home');

Auth::routes(['register' => false]);

Route::get('/profile', 'HomeController@index')->name('profile');
Route::get('/train', 'HomeController@train')->name('train');

Route::group(['middleware' => ['auth']], function () {
    Route::setGroupNamespace('App\Http\Controllers\Admin');
    Route::resource('admin/permissions', 'PermissionController');
    Route::resource('admin/questions', 'QuestionController');
    Route::resource('admin/documents', 'DocumentController');
    Route::resource('admin/students', 'StudentController');
    Route::resource('admin/parts', 'PartController');
    Route::resource('admin/composite-tests', 'CompositeTestController');

    Route::get('admin/exercises/import/{id?}', 'ExerciseController@import')
        ->name('exercises.import');
    Route::post('admin/exercises/storeImport', 'ExerciseController@storeImport')
        ->name('exercises.storeImport');
    Route::resource('admin/exercises', 'ExerciseController');

});


// Display tests & exercises.
Route::resource('exercises', 'ExerciseController', [
    // Renamed routes due to Admin/ExerciseController.
    'names' => [
        'index' => 'student.exercises.index',
        'create' => 'student.exercises.create',
        'store' => 'student.exercises.store',
        'show' => 'student.exercises.show',
        'edit' => 'student.exercises.edit',
        'update' => 'student.exercises.update',
        'destroy' => 'student.exercises.destroy',
    ]
]);

Route::resource('composite-tests', 'CompositeTestController', [
    // Renamed routes due to Admin/ExerciseController.
    'names' => [
        'index' => 'student.composite-tests.index',
        'create' => 'student.composite-tests.create',
        'store' => 'student.composite-tests.store',
        'show' => 'student.composite-tests.show',
        'edit' => 'student.composite-tests.edit',
        'update' => 'student.composite-tests.update',
        'destroy' => 'student.composite-tests.destroy',
    ]
]);

Route::resource('trials', 'TrialController');


Route::group(['middleware' => ['auth']], function () {
    Route::get('games/play', 'GameController@play')->name('games.play');
    Route::get('games', 'GameController@index')->name('games');
    Route::post('games/continue', 'GameController@continue')->name('games.continue');
});

