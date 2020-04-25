<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Article;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
| */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); 

Route::get('/', function() {
    return json_encode(["value"=> 555], 200);
});

Route::get('/test-route', function() {
    return json_encode(["message"=>"this works!"], 200);
});

Route::get('/adder', function(Request $request) {
     $validatedData = $request->validate([
         'value1' => 'required',
         'value2' => 'required'
     ]);


    $value1 = $request->value1;
    $value2 = $request->value2;

    if ($validatedData->fails()) {
        return Response::json(["error" => $validatedData->errors()], 405);
    }

    $result = $value1 + $value2;
    return Response::json(["result" => $result],200);

});

Route::post('/authors', 'AuthorController@store');
Route::get('/authors', 'AuthorController@index');
Route::get('/authors/{id}', 'AuthorController@show');
Route::put('/authors/{id}', 'AuthorController@update');

Route::delete('/authors/{id}', function($id) {
    Author::find($id)->delete();
    return response(204)->header('Content-Type', 'application-json');
});

Route::get('articles', function() {
    return Article::all();
});

Route::get('/books', 'BookController@index');
Route::delete('/books/{id}', 'BookController@delete');

Route::post('/register', 'Auth\PassportController@register');
Route::post('/login', 'Auth\PassportController@login');

