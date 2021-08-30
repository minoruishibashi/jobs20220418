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
                        Save
                    </button>
                </div>
            </div>
        </form>
    @endif
        
    
    
    <div class="card" >
        質問一覧
    </div>   
           <!-- 現在の本 -->
    @if (count($posts) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>投稿者</th>
                        <th>質問</th>
                        <th>内容</th>
                        <th>関連スキル（タグ）</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
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
                                <td class="table-text">
                                    <div>{{ $post->contents }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $post->skill }}</div>
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

                                <td>
                                    <form action="{{ url('postsdetail/'.$post ->id) }}" method="GET">
                                            {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">
                                            詳細
                                        </button>
                                    </form>
                                </td>

                                @if(auth()->user()->id == $post->user_id)  
                                <!--//ログインユーザーID ＝＝ $post tableのuser_idが一致している場合  -->
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
                                 </form>
                                </td>
                                @endif   
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