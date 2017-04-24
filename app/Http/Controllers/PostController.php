<?php
namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PostFormRequest;

class PostController extends Controller
{
    protected $post_repository;

    public function __construct(PostRepositoryInterface $post_repo)
    {
        $this->post_repository = $post_repo;
    }

    public function username()
    {
        $post = Post::find(21);
        $firstName = $post->user_name;
        return $firstName;
    }

    public function getjson()
    {
        $post = Post::all();
        return $post->toJson();  // alternative method which call json itself return (string) $user;
    }

    public function create()
    {
        return view('addpost');
    }

    public function show()
    {
        $data = $this->post_repository->getAllPost();
        $user = Auth::user();
        $name = $user->fname . ' ' . $user->lname;
        return view('blog', compact('data', 'name'));
    }

    public function search()
    {
        $key = Input::get('search');
        $data = $this->post_repository->search($key);
        $user = Auth::user();
        $name = $user->fname . ' ' . $user->lname;
        return view('blog', compact('data', 'name'));
    }

    public function delete($id)
    {
        if ($this->post_repository->deleteById($id)) {
            Session::flash('message', 'Post Deleted SuccessFully');
            Session::flash('alert-class', 'alert-success');
            return Redirect::back();
        } else {
            Session::flash('message', 'Post Not Deleted');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::back();
        }
    }

    public function edit($id)
    {

        $data = $this->post_repository->getPostById($id);
        return view('addpost', compact('data'));
    }

    public function store(PostFormRequest $input, $id = null)
    {
        /*$rules = array(
            'post_title' => 'required | min:5 ',
            'post_data' => 'required | min:20',
            'post_date' => 'required',
            'post_image'=>'mimes:jpeg,png',
        );

        $validator = Validator::make(Input::all(),$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }*/

        if (isset($id)) {
            $post = Post::find($id);
        } else {
            $post = new Post();
        }
        $title = Input::get('post_title');
        $data = Input::get('post_data');
        $date = Input::get('post_date');

        if (Input::hasFile('post_image')) {
            $file = Input::file('post_image');
            $destination_path = 'uploads/';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $file->move($destination_path, $filename);
            $post->post_image = $filename;
            $user = Auth::User();
            $uid = $user->user_id;
            $name = $user->fname . $user->lname;
            $post->user_name = $name;
            $post->user_id = $uid;
        }
        $post->post_title = $title;
        $post->post_data = $data;
        $post->post_expire_date = $date;
        if ($this->post_repository->save($post)) {
            if (isset($id))
                Session::flash('message', 'Post Updated SuccessFully');
            else
                Session::flash('message', 'Post Inserted SuccessFully');
            Session::flash('alert-class', 'alert-success');
            return Redirect::back();
        } else {
            Session::flash('message', 'Try After Some Timess');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::back();
        }
    }

    public function viewblog()
    {
        $data = $this->post_repository->getPostWithComment();
        return view('viewblog', compact('data'));
    }

    public function viewmore($id)
    {
        $data = $this->post_repository->getPostWithCommentReplyById($id);
        if (!empty($data))
            return view('viewmore', compact('data'));
        else
            return view('errors.404');
    }

    public function abhiPost()
    {
        $data = $this->post_repository->getPostWithComment();
        return view('abhipost', compact('data'));
    }


}