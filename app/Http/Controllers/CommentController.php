<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Interfaces\CommentRepositoryInterface;
use App\Http\Requests\CommentFormRequest;

class CommentController extends Controller
{

		protected $cmt_repo;

		public function __construct(CommentRepositoryInterface $cmt_repo){
			$this->cmt_repo= $cmt_repo;
		}
		public function create()
		{
			$data=$this->cmt_repo->getAllComment();
			$user=Auth::user();
			$name=$user->fname.' '.$user->lname;
			return view('comment',compact('data','name'));
		}

		public function delete($id=NULL)
		{
			if (isset($id)) {
				 $flag=$this->cmt_repo->deleteById($id);
			}
			else{
				$flag=$this->cmt_repo->deleteById(Input::get('check'));
			}
			if($flag){

				Session::flash('message', 'Comment Deleted SuccessFully');
				Session::flash('alert-class', 'alert-success');
				return Redirect::back();
			}
			else{

				Session::flash('message', 'Comment Not Deleted');
				Session::flash('alert-class', 'alert-danger');
				return Redirect::back();
			}
		}

		public function savecmt()
		{
				$cmt = Comment::find(Input::get('comment_id'));
				$cmt->comment_data = Input::get('comment_data');
				if($this->cmt_repo->save($cmt)){
					Session::flash('message', 'Comment Updated SuccessFully');
					Session::flash('alert-class', 'alert-success');
					return Redirect::back();
				}
				else{
					Session::flash('message', 'Comment Not Updated');
					Session::flash('alert-class', 'alert-danger');
					return Redirect::back();
				}
		}

		public function status($id,$sts)
		{
				$cmt=Comment::find($id);
				$cmt->is_approve=$sts;
				if($this->cmt_repo->save($cmt)){
					Session::flash('message', 'Comment Status  Changed SuccessFully');
					Session::flash('alert-class', 'alert-success');
					return Redirect::back();
				}
				else{
					Session::flash('message', 'Comment Status Not Updated');
					Session::flash('alert-class', 'alert-danger');
					return Redirect::back();
				}
		}

		public function savecomment()
		{
				$comment=new Comment();
				$comment->comment_data=Input::get('comment_data');
				$comment->username=Input::get('username');
				$comment->post_id=Input::get('post_id');
				$comment->reply_id=Input::get('reply_id');
				$cId=$this->cmt_repo->save($comment);
				if($cId){
					/*
				    Session::flash('message', 'Comment Inserted SuccessFully');
					Session::flash('alert-class', 'alert-success');
					*/

					return $cId;
				}
				else{
				/*  Session::flash('message', 'Comment Not Inserted');
					Session::flash('alert-class', 'alert-danger');
				*/
					return 0;
				}

		}

		public function search()
		{
			$key=Input::get('search');
			$data =$this->cmt_repo->search($key);
			$user=Auth::user();
			$name=$user->fname.' '.$user->lname;
			return view('comment',compact('data','name'));
		}

		public function edit($id)
		{
			$comment=$this->cmt_repo->getCommentById($id);
			return view('editcmt',compact('comment'));
		}

}
