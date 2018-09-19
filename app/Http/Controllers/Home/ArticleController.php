<?php

namespace App\Http\Controllers\Home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class ArticleController extends Controller
{
    public function index(){
		return view('Article.index');
		
	}
	
	public function create(Request $request){
		if($request->request->isPost()){
			$this->validate($request, [
				'title' => 'required|unique:posts|max:255',
				'body' => 'required',
			]);

		}
	}
	
	
}
