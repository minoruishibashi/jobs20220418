<?php

namespace App\Http\Controllers;

use App\Post;  //Book->Post
use App\User;//この行を上に追加
use App\Review;  //Book->Post
use Illuminate\Http\Request;
use Validator;
use Auth;



class PostsController extends Controller
{
    //
    //コンストラクタ
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    // posts.blade.php index
    public function index(){
   
        // 全ての投稿を取得
        $posts = Post::get();
        
        if (Auth::check()) {
             //ログインユーザーのお気に入りを取得
             $favo_posts = Auth::user()->favo_posts()->get();
             
              return view('posts',[
                'posts'=> $posts,
                'favo_posts'=>$favo_posts
                ]);
            
        }else{
            
            return view('posts',[
            'posts'=> $posts
            ]);
            
        }
        
        // $posts = Post::get();
        
        // return view('posts',[
        //     'posts'=> $posts
        //     ]);
   
    //   $userid = Auth::user()->id;
    // //   $posts = Post::orderBy('created_at', 'asc')->paginate(3);
    //   $posts = Post::where("user_id",Auth::user()->id)->orderBy('created_at', 'asc')->paginate(3);
    //     return view('posts', [
    //         'posts' => $posts,
    //         'userid'=> $userid
            
    //     ]);
        
        
        //return view('books',compact('books')); //も同じ意味
    }
    

    //postsedit
    
    public function edit(Post $posts){
        // 塚田先生コードはこれ 引数が$post_id、$posts = Post::where("user_id",Auth::user()->id)->find($post_id);
    
            // {books}id 値を取得 => Book $books id 値の １レコード取得
        return view('postsedit', ['post' => $posts]);
    
    }
    
    
    //postのstore
    public function store(Request $request){
    
    //バリデーション
    $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'contents' => 'required|max:255',
        'skill' => 'required|max:255',
        'nameor' => 'required|max:6'
    ]);

    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    //以下に登録処理を記述（Eloquentモデル）

    $posts = new Post;
    $posts->title = $request->title;
    $posts->user_id = Auth::id();
    $posts->contents = $request->contents;
    $posts->skill = $request->skill;
    $posts->nameor = $request->nameor;
    $posts->save(); 
    return redirect('/');
        
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
        $posts = Post::where("user_id",Auth::user()->id)->find($request->id);  //posts tableのuser_id=Authのid これをfindしてrequestでidに入れる
        $posts->title = $request->title;
        $posts->user_id = Auth::id();
        $posts->contents = $request->contents;
        $posts->skill = $request->skill;
        $posts->nameor = $request->nameor;
        $posts->save();
        return redirect('/');
            
        }
    
    // 削除　postをdestroy
    
    public function destroy (Post $post){
            $post->delete();       //追加
            return redirect('/');  //追加
    }
    
    
    //postdetailindex（これは使えているか不明。多分使えていない）
    
    public function postsdetailindex(){
   
        // 全ての投稿を取得
        $posts = Post::get();
        $reviews = Post::get();
    
        
        return view('postsdetail',[
            'posts'=> $posts,
            'reviews'=> $reviews
            ]);
            
        }
   
    //detail
    
    public function detail(Post $posts){
        $userid = Auth::user()->id;
        // $posts = Post::where("user_id",Auth::user()->id)->find($post_id);   
        $reviews = Review::where("posts_id",$posts->id)->orderBy('created_at', 'asc')->get();  //$review tableに対して、 Review tableのposts_idが$posts\id(=引数)と一致している  －＞  作成順に 取得する。
        return view('postsdetail', 
        [
            'posts' => $posts,
            'reviews' =>$reviews,
            'userid'=> $userid
            
        ]);
        
        // $reviews = Review::where("user_id",Auth::user()->id)->find($review_id);
        // return view('postsdetail', ['review' => $reviews]);

    }
    
    //storecomment（コメント投稿内容を保存）
    
    public function storecomment(Request $request){
    
    //バリデーション
    $validator = Validator::make($request->all(), [
        'review_text' => 'required|max:255',
        'nameor' => 'required|max:6'
    ]);

    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    //以下に登録処理を記述（Eloquentモデル）

    $reviews = new Review;
    $reviews->review_text = $request->review_text;
    $reviews->user_id = Auth::user()->id;
    $reviews->posts_id = $request->post_id;  
    $reviews->nameor = $request->nameor;
    $reviews->save(); 
    
    // return redirect()->route('postsdetail')->with(compact('posts'));
    // return redirect(route('postsdetail', 
    // ['posts' => $request->post_id]
    // ));
    
    return back();
    
    }
    
    
    //お気に入り （中野先生の授業テキスト通り）
    public function favo($post_id)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();
        
        //お気に入りする記事
        $post = Post::find($post_id);
        
        //リレーションの登録
        $post->favo_user()->attach($user);
        
        return redirect('/');
        
    }
    
    
    //reviewsedit（コメントの編集画面）
    public function reviewsedit(Review $reviews)
    {
    return view('reviewsedit',
    ['review' => $reviews]
    );
    }
    
    //Update:　更新処理 （コメントの更新→うまくできていない）
    public function reviewsupdate(Request $request){

      //バリデーション
         $validator = Validator::make($request->all(), [
            'review_text' => 'required|max:255',
            'nameor' => 'required|max:6'
        ]);
        //バリデーション:エラー
            if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
        }
        
        //テータ更新
        // $posts = Post::find($request->id);
        $reviews = Review::where("user_id",Auth::user()->id)->find($request->id);  //Reviewのtableから検索→whereで条件指定 user_id→”, ”= ＝→Auth user id→ find(>whereと同じ）posts tableのuser_id=Authのid これをfindしてrequestでidに入れる
        $reviews->review_text = $request->review_text;
        $reviews->user_id =  Auth::id();
        $reviews->nameor = $request->nameor;
        $reviews->save(); 
        return redirect('/postsdetail/'.$request->posts_id);
    }
    
    //↑The review text field is required.The nameor field is required.とエラーが出てしまう
      
      
    //コメント削除  
    public function reviewdestroy (Review $review){
            $review->delete();       //追加
             return back();
        
    }

}
