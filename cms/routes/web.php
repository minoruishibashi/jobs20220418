<?php

use App\Post;  //Book->Post
use App\Review;  //Book->Post
use App\User;  //Book->Post
use Illuminate\Http\Request;

/**
* 本のダッシュボード表示(books.blade.php) 
* -> 質問のダッシュボード表示(post.blade.php)
*/

Route::get('/', 'PostsController@index');


/**
* 新「本」を追加 ・投稿を追加
*/
Route::post('/posts', 'PostsController@store');


// 編集更新画面
Route::post(' /postsedit/{posts} ', 'PostsController@edit');


//更新処理
Route::post('/posts/update', 'PostsController@update');




/**
* 本を削除 
*/

Route::delete('/post/{post}', 'PostsController@destroy');

//コメント一覧表示
Route::get('/', 'PostsController@index');

//お気に入り
Route::post('post/{post_id}', 'PostsController@favo');




// //postsdetail index
// Route::get('/postsdetail', 'PostsController@postsdetailindex');


// Route::post('/reviews', 'ReviewsController@store');

//質問詳細画面(postsdetail.blade.php)
Route::get(' /postsdetail/{posts} ', 'PostsController@detail');

/**
* コメントを追加
*/
Route::post('/details', 'PostsController@storecomment');

// コメント編集更新画面
Route::post('/reviewsedit/{reviews}/', 'PostsController@reviewsedit');


//更新処理
Route::post('/reviews/update', 'PostsController@reviewsupdate');   //ここうまくいってない

/**
* コメントを削除 
*/
Route::delete('/review/{review}', 'PostsController@reviewdestroy');



///ログイン
Auth::routes();

Route::get('/home', 'PostsController@index')->name('home');


//画像アップロード画面表示
Route::get('/img','ImgController@index');

//画像アップロード処理
Route::post('/img/upload','ImgController@upload');