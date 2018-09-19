<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
	public $table = 'posts';
	
	//黑名单，该数组总的字段 在批量赋值赋值是会被过滤掉
	protected $guarded = ['views','user_id','updated_at','created_at'];
	
	//$fillable 中的属性可以通过批量赋值进行赋值
	//protected $guarded = ['views','user_id','updated_at','created_at'];
}
