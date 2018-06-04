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
    $iem=App\Item::take(2)->where("done",0)->orderBy('created_at', 'desc')->get();
    return $iem;
});
Route::get("/getFoundPosts",function(){
    header("Access-Control-Allow-Origin:*");
    $iem=App\Item::where('status', 0)->where("done",0)->orderBy('created_at', 'desc')->get();
    return $iem;
});
Route::get("/getLostPosts",function(){
    header("Access-Control-Allow-Origin:*");
    $iem=App\Item::where('status', 1)->where("done",0)->orderBy('created_at', 'desc')->get();
    return $iem;
});
Route::get("/search",function(Request $req){
    header("Access-Control-Allow-Origin:*");
    $sear=App\Item::where('title', 'like', "%".$req->searching."%")->where("done",0)->orWhere('description','like', "%".$req->searching."%")->where("done",0)->get();
    return $sear;
});
Route::get("/getDB",function(Request $req){
    
    header("Access-Control-Allow-Origin:*");
    $itm=App\Item::create([
        "title"=>$req->title,
        "contact"=>$req->contact,
        "description"=>$req->description,
        "status"=>$req->status,
        "done"=>0
     
    ]);
    return $itm;
});
Route::get("/getMyPosts",function(Request $req){
    header("Access-Control-Allow-Origin:*");
    $iem=App\Item::where('id',$req->storage)->where("done",0)->orderBy('created_at', 'desc')->get();
    return $iem;
});
Route::get("/delete",function(Request $req){
    header("Access-Control-Allow-Origin:*");
    $iem1=App\Item::where('id',$req->storage)->update(['done' => 1]);
    return $iem1;
});