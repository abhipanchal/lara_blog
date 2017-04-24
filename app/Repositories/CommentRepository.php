<?php
namespace App\Repositories;

use App\Comment;

use App\Interfaces\CommentRepositoryInterface;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class CommentRepository implements CommentRepositoryInterface
{
	public function save(Comment $cmt)
	{
		$cmt->save();
		return  $cmt->comment_id;
	}
	public function getAllComment()
	{
		return Comment::paginate(5);
	}
	public function search($key)
	{
		return DB::table('comment')->where('comment_data', 'LIKE', '%' . $key . '%')->orwhere('username', 'LIKE', '%' . $key . '%')->paginate(5);
	}
	public function deleteById($ids)
	{
		return Comment::destroy($ids);

	}
	public function getCommentById($id)
	{
		return Comment::find($id);
	}

}