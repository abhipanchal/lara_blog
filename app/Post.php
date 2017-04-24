<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
		protected  $primaryKey='post_id';
		protected  $table='post';
		public $timestamps = false;

		public function comments()
		{
			return $this->hasMany('App\Comment')->whereReplyId('0')->whereIsApprove('1');
		}

		/**
		*	Defined Accessor which manipulate user NAme And return first name in Capital
		* @param $value
		* @return string
		*/
		public function getUserNameAttribute($value)
		{
				return ucfirst($value);
		}

}