<?php

use Illuminate\Http\Request;
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

Route::get('/', function () {
    // return view('welcome');
    $links = \App\Link::all();
    return view('welcome', ['links' => $links]);
});


Route::get('/list/index', 'ListController@index');


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/submit', function () {
    return view('submit');
});
Route::post('/submit', function(Request $request) {
    $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'url' => 'required|max:255',
        'description' => 'required|max:255',
    ]);
    if ($validator->fails()) {
        return back()
            ->withInput()
            ->withErrors($validator);
    }
    $link = new \App\Link;
    $link->title = $request->title;
    $link->url = $request->url;
    $link->description = $request->description;
    $link->save();
    return redirect('/');
});

Route::get('/list/create', 'ListController@create');
Route::post('/list/create', 'ListController@create');
