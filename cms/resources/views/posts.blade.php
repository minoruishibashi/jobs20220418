<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@push('css')
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="card-body">

        <!-- バリデーションエラーの表示に使用-->
        @include('common.errors')
        <!-- バリデーションエラーの表示に使用-->
        
        <!-- 本登録フォーム -->
        @if( Auth::check() )
        <form action="{{ url('posts') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- 本のタイトル -->
            <div class="form-group">
                <div class="col-sm-6">
                    質問
                    <input type="text" name="title" class="form-control" placeholder="何について質問・ディスカッションしたいですか？">
                </div>
                <div class="col-sm-6">
                    内容
                <textarea name="contents" class="form-control" cols="40" rows="5" wrap="hard" placeholder="質問背景等、具体的に記入してください"></textarea> 
                </div>
                <div class="col-sm-6">
                    関連スキル
                    <input type="text" name="skill" class="form-control" placeholder="例:新規事業開発、海外市場、事業投資、人事 etc">
                </div>
                <div class="col-sm-6">
                   <label for="radio01" class="col-sm-6">投稿方法</label>
                   <div class="col--6">
                      <div class="form-check form-check-inline">
                         <input class="form-check-input" type="radio" id="inlineRadio01" name="nameor" value="1" checked="checked">
                         <label class="form-check-label" for="inlineRadio01">本名</label>
                      </div>
                      <div class="form-check form-check-inline">
                         <input class="form-check-input" type="radio" id="inlineRadio02"  name="nameor" value="2" >
                         <label class="form-check-label" for="inlineRadio02">ニックネーム</label>
                      </div>
                      <div class="form-check form-check-inline">
                         <input class="form-check-input" type="radio" id="inlineRadio03"  name="nameor" value="3" >
                         <label class="form-check-label" for="inlineRadio03">匿名</label>
                      </div>
                   </div>
                </div>

            </div>

            <!-- 本 登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        質問投稿
                    </button>
                </div>
            </div>
        </form>
    @endif

        <!--↓↓ 検索フォーム ↓↓-->
        <div class="col-sm-4" style="padding:20px 0; padding-left:0px;">
        <form class="form-inline" action="{{url('/posts/search')}}">
          <div class="form-group">
          <input type="text" name="keyword" value="" class="form-control" placeholder="検索したい言葉を入力してください" >
          </div>
          <input type="submit" value="検索" class="btn btn-info">
        </form>
        </div>
        <!--↑↑ 検索フォーム ↑↑-->

 <!--<div class="col-sm-8" style="text-align:right;">--> 

 <div class="row mt-6">
  <div class="col-md-12 col-12">
   <div class="card">
    <div class="card-header bg-white border-bottom-0 py-4">
          <h class="mb-0">質問一覧</h>
    </div>
  
           <!-- 現在の本 -->
    @if (count($posts) > 0)
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table text-wrap mb-0">
                    <!-- テーブルヘッダ -->
                    <thead class="table-light">
                        <th></th>
                        <th>NAME</th>
                        <th>QUESTION</th>
                        <th>CONTENTS</th>
                        <th>RELATED AREAS</th>
                        <th>DATE</th>                        
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <!-- 投稿者写真の表示 -->
                                <td class>
                                @if( $post->nameor==1)
                                <img src="/uploads/{{$post->user->img_url }}" width="100" height="100" class="rounded-circle" >
                                @elseif( $post->nameor==2)
                                <img src="/uploads/{{$post->user->img_url }}" width="100" height="100" class="rounded-circle" >
                                @elseif( $post->nameor==3)
                                @endif
                                </td>
                                 <!-- 投稿者名の表示 -->
                                
                                <td class="table-text">
                                @if( $post->nameor==1)
                                   <div>{{ $post->user->name }}</div>
                                @elseif( $post->nameor==2)
                                   <div>{{ $post->user->nickname }}</div>
                                @elseif( $post->nameor==3)
                                   <div>匿名</div>
                                @endif
                                </td>
                                
                                <!-- 投稿タイトルほか -->
                                <td class="table-text">
                                    <div>{{ $post->title }}</div>
                                </td>
                                <td class="table-text" >
                                    <div>{{ $post->contents }}</p></div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $post->skill }}</div>
                                </td>
                                <td class="table-text">
                                    <div> {{ $post->created_at->format('Y/m/d') }}</div>
                                </td>  
                                
                                <!--<td class="table-text">-->
                                <!--    <form action="{{ url('post/'.$post->id) }}" method="POST">-->
                                <!--    	{{ csrf_field() }}-->
                                <!--    	<button type="submit" class="btn btn-danger">-->
                                <!--    	お気に入り-->
                                <!--    	</button>-->
                                <!--    </form>-->
                                <!--</td>-->


                                
                                <!--質問詳細遷移ボタン -->

                        <div>
                                <td>
                                    <form action="{{ url('postsdetail/'.$post ->id) }}" method="GET">
                                            {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary" style="width: 100%; margin: 5px; padding: 5px;">
                                            Detail
                                        </button>
                                    </form>
                               

                                @if(auth()->user()->id == $post->user_id)  
                                <!--//ログインユーザーID ＝＝ $post tableのuser_idが一致している場合  -->
                                <!--更新ボタン-->
                                
                                    <form action="{{ url('postsedit/'.$post ->id) }}" method="POST">
                                            {{ csrf_field() }}
                                        <button type="submit" class="btn btn-secondary" style="width: 100%; margin: 5px; padding: 5px;">
                                            Edit
                                        </button>
                                    </form>
                                
                
                                
                                
                                <!-- 本: 削除ボタン -->
                                
                                
                                
                                <form action="{{ url('post/'.$post->id) }}" method="POST">
                                     {{ csrf_field() }}
                                     {{ method_field('delete') }}
                                    
                                    <button type="submit" class="btn btn-danger" style="width: 100%; margin: 5px; padding: 5px;">
                                        Delete
                                    </button>
                                 </form>
                                </td>
                            </div>
                                @endif   
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
  </div>        
 </div>
</div>

    @endif
        
        
        
    </div>
    <!-- Book: 既に登録されてる本のリスト -->
    <!--@if( Auth::check() )-->
    <!--    @if (count($favo_posts) > 0)-->
    <!--        <div class="card-body">-->
    <!--            <div class="card-body">-->
    <!--                <table class="table table-striped task-table">-->
                        <!-- テーブルヘッダ -->
    <!--                    <thead>-->
    <!--                        <th>お気に入り一覧</th>-->
    <!--                        <th>&nbsp;</th>-->
    <!--                    </thead>-->
                        <!-- テーブル本体 -->
    <!--                    <tbody>-->
    <!--                        @foreach ($favo_posts as $favo_post)-->
    <!--                            <tr>-->
                                    <!-- 投稿タイトル -->
    <!--                                <td class="table-text">-->
    <!--                                    <div>{{ $favo_post->title }}</div>-->
    <!--                                </td>-->
                                     <!-- 投稿詳細 -->
    <!--                                <td class="table-text">-->
    <!--                                    <div>{{ $favo_post->contents }}</div>-->
    <!--                                </td>-->
                                    <!-- 投稿者名の表示 -->
    <!--                                <td class="table-text">-->
    <!--                                    <div>{{ $favo_post->user->name }}</div>-->
    <!--                                </td>-->
    <!--                            </tr>-->
    <!--                        @endforeach-->
    <!--                    </tbody>-->
    <!--                </table>-->
    <!--            </div>-->
    <!--        </div>		-->
    <!--    @endif-->
        	
    <!--@endif-->
    
@endsection
