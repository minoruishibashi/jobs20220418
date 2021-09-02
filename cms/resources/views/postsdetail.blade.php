@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
    @include('common.errors')

        <!-- name -->
        <div class="form-group">
            <label for="item_name">投稿者</label>
                @if( $posts->nameor==1)
                <input type="text" name="nameor" class="form-control" value="{{ $posts->user->name }}">
                @elseif( $posts->nameor==2)
                <input type="text" name="nameor" class="form-control" value="{{ $posts->user->nickname}}">
                @elseif( $posts->nameor==3)
                <input type="text" name="nameor" class="form-control" value="匿名">
                @endif
         <!--/ id値を送信 -->
    
        <!-- title -->
        <div class="form-group">
           <label for="item_name">質問</label>
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
           <label for="item_amount">関連スキル（タグ）</label>
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
                   <label for="radio01" class="col-sm-6">投稿方法</label>
                   <div class="col-sm-6">
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
    
    
    
    <div class="card" >
        質問投稿
    </div>

     <!-- 現在の本 -->
    @if (count($reviews) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>投稿者</th>  
                        <th>コメント</th>  
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($reviews as $review)
                            <tr>
                                <!-- 投稿者名の表示 -->
                                <td class="table-text">
                                @if( $review->nameor==1)
                                   <div>{{ $review->user->name }}</div>
                                @elseif( $review->nameor==2)
                                   <div>{{ $review->user->nickname }}</div>
                                @elseif( $review->nameor==3)
                                   <div>匿名</div>
                                @endif                       
                                </td>
                                <!-- 投稿タイトルほか -->
                                <td class="table-text">
                                    <div>{{ $review->review_text }}</div>
                                </td>
                                

                                <!--更新ボタン-->
                                <td>
                                    <form action="{{ url('reviewsedit/'.$review->id) }}" method="POST">
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