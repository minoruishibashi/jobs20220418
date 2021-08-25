<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="card-body">
    {{ Auth::user()->id  }}


        <div class="card" >
            質問投稿
        </div>

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
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="col-sm-6">
                    内容
                    <input type="text" name="contents" class="form-control">
                </div>
                <div class="col-sm-6">
                    関連スキル（タグ）
                    <input type="text" name="skill" class="form-control">
                </div>
                <div class="col-sm-6">
                    匿名にしますか？
                    <input type="text" name="nameor" class="form-control">
                </div>

            </div>

            <!-- 本 登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
    @endif
        
        
           <!-- 現在の本 -->
    @if (count($posts) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>質問一覧</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                 <!-- 投稿者名の表示 -->
                                <td class="table-text">
                                   <div>{{ $post->user->name }}</div>
                                </td>
                                <!-- 投稿タイトルほか -->
                                <td class="table-text">
                                    <div>{{ $post->title }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $post->contents }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $post->skill }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $post->nameor }}</div>
                                </td>
                                <td class="table-text">
                                    <form action="{{ url('post/'.$post->id) }}" method="POST">
                                    	{{ csrf_field() }}
                                    	<button type="submit" class="btn btn-danger">
                                    	お気に入り
                                    	</button>
                                    </form>
                                </td>

                                
                                <!--質問詳細遷移ボタン -->

                                <td>
                                    <form action="{{ url('postsdetail/'.$post ->id) }}" method="GET">
                                            {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">
                                            詳細
                                        </button>
                                    </form>
                                </td>

                                <!--更新ボタン-->
                                <td>
                                    <form action="{{ url('postsedit/'.$post ->id) }}" method="POST">
                                            {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">
                                            更新
                                        </button>
                                    </form>
                                </td>
                                
                                
                                
                                <!-- 本: 削除ボタン -->
                                
                                <td>
                                
                                <form action="{{ url('post/'.$post->id) }}" method="POST">
                                     {{ csrf_field() }}
                                     {{ method_field('delete') }}
                                    
                                    <button type="submit" class="btn btn-danger">
                                        削除
                                    </button>
                                 </form
                                </td>
                   
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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