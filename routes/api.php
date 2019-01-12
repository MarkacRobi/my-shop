<?php

use Illuminate\Http\Request;
use App\Http\Resources\ItemsResource;
use App\Item;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/items', function (Request $request) {
    return collect(Item::orderBy('created_at', 'desc')->get());
});
Route::get('/items/{id}', function ($id) {
    return collect(Item::find($id));
});
