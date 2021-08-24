<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;  //Review
use App\Post;  //Review
use Validator;
use Auth;

class ReviewsController extends Controller
{
  //コンストラクタ
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    // index
    public function index(){
       $userid = Auth::user()->id;
    //   $posts = Post::orderBy('created_at', 'asc')->paginate(3);
       $reviews = Post::where("user_id",Auth::user()->id)->orderBy('created_at', 'asc')->paginate(3);
        return view('postsdetail', [
            'posts' => $posts,
            'userid'=> $userid
        ]);
        
        
        //return view('books',compact('books')); //も同じ意味
    }
    
    //store
    public function store(Request $request){
    
    //バリデーション
    $validator = Validator::make($request->all(), [
        'review_text' => 'required|max:255',
        'nameor' => 'required|max:6'
    ]);

    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/postsdetail')
            ->withInput()
            ->withErrors($validator);
    }
    //以下に登録処理を記述（Eloquentモデル）

    $reviews = new Review;
    $reviews->review_text = $request->review_text;
    $reviews->user_id = Auth::user()->id;
    $reviews->posts_id = ->id;
    $reviews->nameor = $request->nameor;
    $reviews->save(); 
    return redirect('/postsdetail');
        
    }
    
    
    
    //Update:　更新処理
    public function update(Request $request){
        
      //バリデーション
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'title' => 'required|max:255',
                'contents' => 'required|max:255',
                'skill' => 'required|max:255',
                'nameor' => 'required|max:6'
        ]);
        //バリデーション:エラー
            if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
        }
        //データ更新
        // $posts = Post::find($request->id);
        $posts = Post::where("user_id",Auth::user()->id)->find($request->id);
        $posts->title = $request->title;
        $posts->contents = $request->contents;
        $posts->skill = $request->skill;
        $posts->nameor = $request->nameor;
        $posts->save();
        return redirect('/postsdetail');
            
        }
    
    // 削除　destroy
    
    public function destroy (Post $post){
            $post->delete();       //追加
            return redirect('/');  //追加

        
    }
}
