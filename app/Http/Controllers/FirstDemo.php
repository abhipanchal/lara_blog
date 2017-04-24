<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\Post;
use DB;

use Illuminate\Support\Facades\Input;

class FirstDemo extends Controller
{
    //
		public function  display(Request $request,$id=12){


			//return $request->url();
			return session('status');
		}
	 function  index(){

		 	$data=DB::table('post')->get();
			 dd($data);
		 	/*$data=Post::where('post_id',16)->first();
		 	return view('display')->with('data',$data);*/
		 	//return view('demo');
	 }
	function  save()
	{
		dd(Input::all());
	}



}
