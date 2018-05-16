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
use Illuminate\Http\Request;
Route::get('/', function () {
    return view('welcome');
});
Route::get("/getLastPosts",function(){
    header("Access-Control-Allow-Origin:*");
    $iem=App\Item::take(2)->get();
    return $iem;
});
Route::get("/getFoundPosts",function(){
    header("Access-Control-Allow-Origin:*");
    $iem=App\Item::where('found', 1)->get();
    return $iem;
});
Route::get("/getLostPosts",function(){
    header("Access-Control-Allow-Origin:*");
    $iem=App\Item::where('lost', 1)->get();
    return $iem;
});
Route::get("/search",function(Request $req){
    header("Access-Control-Allow-Origin:*");
    $sear=App\Item::where('title', 'like', $req->searching)->orWhere('description','like',$req->searching)->get();
    return $sear;
});

