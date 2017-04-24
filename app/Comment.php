<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected  $primaryKey='comment_id';
	protected  $table='comment';
	public  $timestamps=false;


	public function post()
	{
		return $this->belongsTo('App\Post');
	}

	public  function reply()
	{
		return $this->hasMany(Comment::class,'reply_id')->whereIsApprove('1');
	}
}
