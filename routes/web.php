<?php

use Illuminate\Support\Facades\Route;

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

$backend_path = config('app.BACKEND_PATH');

Route::get("/$backend_path/{any?}", function () {
    return view('backend.application');
})->where('any', '.*');


Route::get('/test', function () {
    $settings = new \App\Models\Setting;
    // return \App\Models\Setting::get('app_name');
    // $types = config('field_type');
    // return collect(config('default_settings'))->pluck('elements')->flatten(1);

    // foreach ($types as $key => $value) {
    //     $filtered = Arr::where($value, function (string|int $value, string|int $key) {
    //         return is_string($value);
    //     });
    // }
    return setting('app_name');
});

Route::get('/user', function (\App\Services\FilterQueryBuilder $filters) {
    $users = $filters->buildQuery(\App\Models\User::all());
    // $users = \App\Models\User::all();

    $result = $users;

    return response()->json($result);
});

Route::get('/userL/{s}', function ($s) {
    // $users = $filters->buildQuery(\App\Models\User::all());
    // $users = \App\Models\User::all();

    $result = \App\Models\User::where('email', 'LIKE', "%{$s}%")->get();

    return response()->json($result);
});
