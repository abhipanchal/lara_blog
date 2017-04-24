<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Http\Response;


Route::get('/',function(){
        return  \Illuminate\Support\Facades\Redirect::to('/login');
});

//Route::get('post','PostController@create');

/*Route::get('first/{id}','FirstDemo@display');
Route::get('firstdemo/{id?}','FirstDemo@display');

Route::get('home', function () {
    //return redirect()->route('firstdemo',array('id'=>4));

        return redirect('FirstDemo')->with('status','profile updated ');
});

Route::get('demo/{id}', function($id){
        $ans=array('1','2','3','4','5','6');
        return view('welcome',['name' =>$ans]);
});

Route::any('login','FirstDemo@save');

Route::get('foo', ['uses' => 'FirstDemo@index', 'as' => 'name2']);*/
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {

           Route::group(['middleware'=>'auth'],function(){

                    Route::get('post','PostController@show');
                    Route::get('addpost','PostController@create');
                    Route::post('addpost/{id?}','PostController@store');
                    Route::get('logout','SessionController@logout');
                    Route::get('comment','CommentController@create');
                    Route::get('deletepost/{id}','PostController@delete');
                    Route::get('deletecmt/{id}','CommentController@delete');
                    Route::get('status/{id}/{sts}','CommentController@status');
                    Route::get('editcmt/{id}','CommentController@edit');
                    Route::post('savecmt','CommentController@savecmt');
                    Route::any('cmtsearch','CommentController@search');
                    Route::any('postsearch','PostController@search');
                    Route::get('editpost/{id}','PostController@edit');
                    Route::post('deletecmt','CommentController@delete');

           });
                Route::get('register/{id?}','SessionController@register');
                Route::post('register','SessionController@doregister');
                Route::post('addcomment','CommentController@savecomment');
                Route::get('viewblog','PostController@viewblog');
                Route::get('login', 'SessionController@create');
                Route::post('login', 'SessionController@store');
                Route::get('viewmore/{id}','PostController@viewmore');

                // demo which i created
                Route::get('username','PostController@username');
                Route::get('getjson','PostController@getjson');
                Route::get('abhi_post','PostController@AbhiPost');
                Route::any('/{all}', function(){
                    return view('errors.503');
                })->where('all', '.*');
});