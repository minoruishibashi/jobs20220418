@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
    @include('common.errors')

        <!-- name -->
        <div class="form-group">
            <label for="item_name">投稿者</label>
            <input type="text" name="name" class="form-control" value="{{$posts->user_id}}">
        </div>
         <!--/ id値を送信 -->
    
        <!-- title -->
        <div class="form-group">
           <label for="item_name">投稿タイトル</label>
           <input type="text" id="item_name" name="title" class="form-control" value="{{$posts->title}}">
        </div>
        <!--/ title -->
        
        <!-- contents -->
        <div class="form-group">
           <label for="item_number">内容</label>
        <input type="text" id="item_number" name="contents" class="form-control" value="{{$posts->contents}}">
        </div>
        <!--/ contents -->

        <!-- skill_ -->
        <div class="form-group">
           <label for="item_amount">スキル</label>
        <input type="text" id="item_amount" name="skill" class="form-control" value="{{$posts->skill}}">
        </div>
        <!--/ skill -->

        <!-- Saveボタン/Backボタン -->
        <div class="well well-sm">
            <a class="btn btn-link pull-right" href="{{ url('/') }}">
                Back
            </a>
        </div>
        <!--/ Saveボタン/Backボタン -->
        
             <!-- CSRF -->
         {{ csrf_field() }}
         <!--/ CSRF -->
        
    
        <!-- コメントフォーム -->
        <form action="{{ url('details') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-sm-6">
                    コメント
                    <input type="text" name="review_text" class="form-control">
                </div>
                <div class="col-sm-6">
                    匿名にしますか？
                <input type="text" name="nameor" class="form-control">
                </div>
                
                <input type="hidden" name="post_id" class="form-control" value="{{$posts->id}}">
            
                
            </div>

            <!-- コメント登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Comment Save
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    
           <!-- 現在の本 -->
    @if (count($reviews) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>コメント一覧</th>  //質問に紐づいて表示されない
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($reviews as $review)
                            <tr>
                                <!-- 投稿タイトルほか -->
                                <td class="table-text">
                                    <div>{{ $review->review_text }}</div>
                                </td>
                                
                                <!-- 匿名ほか -->
                                <td class="table-text">
                                    <div>{{ $review->nameor}}</div>
                                </td>


                                <!--更新ボタン-->
                                <td>
                                    <form action="{{ url('reviewsedit'.$review ->id) }}" method="GET">
                                            {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">
                                            更新
                                        </button>
                                    </form>
                                </td>
                                
                        
                                <!-- 本: 削除ボタン -->
                                
                                <td>
                                
                                <form action="{{ url('review/'.$review->id) }}" method="POST">
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
@endsection