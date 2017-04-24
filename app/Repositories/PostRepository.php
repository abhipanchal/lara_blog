<?php
namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/2/16
 * Time: 11:33 AM
 */
use App\Post;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class PostRepository implements PostRepositoryInterface
{
			public function save(Post $post)
			{
					return $post->save();
			}
			public function getAllPost()
			{
				return Post::paginate(5);
			}
			public function search($key)
			{
				return DB::table('post')->orwhere('post_title', 'LIKE', '%' . $key . '%')->orwhere('post_data','LIKE','%'. $key . '%')->orwhere('user_name', 'LIKE', '%' . $key . '%')->paginate(5);
			}
			public function deleteById($id)
			{
				$post= Post::find($id);
				return $post->delete();
			}
			public function getPostById($id)
			{
				return Post::find($id);
			}
			public function getPostWithComment()
			{
				return Post::with('comments')->paginate(5);
			}
			public function getPostWithCommentReplyById($id)
			{
				return Post::with(['comments','comments.reply'])->find($id);
			}
}