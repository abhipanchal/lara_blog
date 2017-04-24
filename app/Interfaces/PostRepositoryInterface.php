<?php
namespace App\Interfaces;
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/2/16
 * Time: 11:30 AM
 */
use App\Post;
interface PostRepositoryInterface
{
	public function save(Post $post);
}