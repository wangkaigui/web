<?php

namespace App\Http\Controllers\Home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;
use App\Models\Post;

class TestController extends Controller
{
    public function index(){
		//DB::insert('insert into users (id, name, email, password) values (?, ?, ? , ? )',[1, 'Laravel','laravel@test.com','123']);
		//DB::insert('insert into users (id, name, email, password) values (?, ?, ?, ? )',[2, 'Academy','academy@test.com','123']);
		
		$re = DB::select("select * from users");
		dd($re);
		
		$affect = DB::update('update users set name="LaravelAcademy" where name = ?', ['Laravel']);
		echo $affect;
		
		//DDL
		//DB::statement('drop table users');
	}
	
	
	public function test(){
		DB::insert('insert into users (id, name, email, password) values (?, ?, ? , ? )',
		[3, 'LaravelAcademy','laravel-academy@test.com','123']);
		
		DB::listen(function($sql, $bindings, $time) {
			echo 'SQL语句执行：'.$sql.'，参数：'.json_encode($bindings).',耗时：'.$time.'ms';
		});
	}
	
	public function test1(){
		DB::transaction(function () {
			DB::table('users')->update(['name' => 'wangsan222']);
			DB::table('users')->where('id',4)->delete();
		});
	}
	
	public function test2(){
		//insert
		/*
		DB::table('users')->insert([
			['name'=>'Laravel','email'=>'laravel@test33.com','password'=>'1213'],
			['name'=>'Academy','email'=>'academy@test44.com','password'=>'1211'],
			['name'=>'LaravelAcademy1','email'=>'laravel1-academy@test44.com','password'=>'1231']
		]);
		*/
		//insertGetId
		//$insertId = DB::table('users')->insertGetId(['name'=>'Laravel-Academy','email'=>'laravelacademy@testr22.com','password'=>'456']);
		
		//update 
		$affected = DB::table('users')->where('name','Laravel-Academy')->update(['password'=>'123']);
		
		//delete
		$deleted = DB::table('users')->where('id', '>', 30)->delete();
		
		//truncate 删除所有
		//DB::table('users')->truncate();
		
		//get  查询所有
		$users = DB::table('users')->get();
		dd($users);
		
		//get select 查询指定字段
		$users = DB::table('users')->select('name','email')->get();
		dd($users);
		
		//get first 查询第一条数据
		$user = DB::table('users')->where('name','Laravel')->first();
		dd($user);
		
		//chunk 分块获取数据
		DB::table('users')->chunk(2,function($users){
			foreach($users as $user){
				// if($user->name=='LaravelAcademy')
				// return false;
				echo $user->name.'<br>';
			}
		});
		
		//lists 获取单列的只
		$users = DB::table('users')->lists('name');
		dd($users);
		
		//原生表达式 raw
		$users = DB::table('users')->select(DB::raw('name,email')->where('id','<',3)->get());
		dd($users);
	}
	
	public function test3(){
		//连接查询
		
		//内连接
		$users1 = DB::table('users')->join('posts','users.id','=','posts.user_id')->get();
		dd($users1);
		
		//左连接
		$users2 = DB::table('users')->leftJoin('posts','users.id','=','posts.user_id')->where('posts.id','>',1)->get();
		dd($users2);
		
		//JoinClause  连接查询
		$users3 = DB::table('users')->join('posts',function($join){
			$join->on('users.id','=','posts.user_id')->where('posts.id','>',1);
		})->get();
		dd($users3);
		
		//union 联合查询
		$users = DB::table('users')->where('id','<',3);
		$users = DB::table('users')->where('id','>',2)->union($users)->get();
		dd($users);
		
		//where子句
		$users4 = DB::table('users')->where('name','=','Laravel')->get();
		// =可简化
		$users4 = DB::table('users')->where('name','Laravel')->get();
		dd($users4);
		
		//使用多个where 指定or或and连接符
		$users = DB::table('users')->where('name','Laravel')->orWhere('name','Academy')->get();
		
		//排序orderBy
		$users = DB::table('users')->orderBy('id','desc')->get();
		
		//分组查询groupBy
		$users = DB::table('users')->select('cat_id',DB::raw('count(id) as num'))->groupBy('cat_id')->get();
		
		//having 分组查询groupBy
		$posts = DB::table('posts')->select('cat_id',DB::raw('SUM(view) as views'))->groupBy('cat_id')->having('views','>',500)->get();
		
		//分页 查询构造器中使用skip 和 take 对结果进行分页  等同limit 和 offset
		$posts = DB::table('users')->skip(0)->take(2)->get();
		dd($posts);
		
		$users = DB::table('users')
        ->offset(10)
        ->limit(5)
        ->get();
		
	}
	
	public function test4(){
		$posts = DB::table('users')->skip(0)->take(2)->get();
		dd($posts);
	}
	
	public function test_model(){
		$posts = Post::all();
		
		
		$post1 = Post::where('id',10)->first();
		foreach($posts as $key){
			echo $key['title'];
		}
		print_r($post1);
		$post2 = Post::find(1);
		
		
	}
	
	public function test_eloquent(){
		$post = new Post();
		$post->title = 'test title4';
		$post->content = 'test content';
		$post->user_id = '2';
		$post->created_at = date("Y-m-d H:i:s",time());
		if($post->save()){
			echo 'success';
		}else{
			echo 'error';
		}
		
	}
	public function test_eloquent1(){
		//$post = Post::create(Input::all());
		
		$input = [
			'title'=>'test 5',
			'content'=>'test content',
			'cat_id'=>1,
			'views'=>100,
			'user_id'=>2
		];
		$post = Post::create($input);
		dd($post);
	}
	
	public function viewtest(){
		$data=[
			'title'=>'测试页面标题',
		];
		return view('test.viewtest',$data);
	}
	
	public function tests($id,$name){
		echo "id is ".$id." my name is ".$name;
	}

	function edit(Request $request,$id,$name){
		$music = $request->input('music');
		$book  = request()->input('book');
		//dd($request);
		$str   = <<<php
id:$id <br/>
name:$name <br/>
music:$music <br/>
book:$book <br/>
php;
	var_dump($request->all());
	var_dump($request->except('music'));//排除music
	return $str;
	}


}
