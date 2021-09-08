@extends('layouts.app')
@push('css')
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="card-body">
    <div class="col-md-12">
    @include('common.errors')

        <!-- 質問一覧に戻る -->
        <div class="well well-sm">
            <a class="btn btn-link pull-right" href="{{ url('/') }}">
                質問一覧に戻る
            </a>
        </div>

        <!-- name と写真-->
        <div class="form-group">
            <label for="item_name">投稿者</label>
                @if( $posts->nameor==1)
                <input type="text" name="nameor" class="form-control" style="width:auto" value="{{ $posts->user->name }}">
                <img src="/uploads/{{$posts->user->img_url }}" width="100" height="100" class="rounded-circle">
                @elseif( $posts->nameor==2)
                <input type="text" name="nameor" class="form-control" style="width:auto" value="{{ $posts->user->nickname}}">
                <img src="/uploads/{{$posts->user->img_url }}" width="100" height="100" class="rounded-circle">
                @elseif( $posts->nameor==3)
                <input type="text" name="nameor" class="form-control" value="匿名">
                @endif
        </div>
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
           <label for="item_amount">関連スキル</label>
        <input type="text" id="item_amount" name="skill" class="form-control" value="{{$posts->skill}}">
        </div>
        <p></p>
        <!--/ skill -->

        <!--/ Saveボタン/Backボタン -->
        
             <!-- CSRF -->
         {{ csrf_field() }}
         <!--/ CSRF -->
        
    
        <!-- コメントフォーム -->
        <form action="{{ url('details') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
        
        <p></p>
        <div class=class="form-control" style="width:auto">
            コメントを投稿してみよう！
        </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <p></p>
                    <input type="text" name="review_text" class="form-control" placeholder="コメントを入力する">
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
                        コメント投稿
                    </button>
                </div>
            </div>
        </form>
    </div>


 <div class="row mt-6">
  <div class="col-md-12 col-12">
   <div class="card">
    <div class="card-header bg-white border-bottom-0 py-4">
    　 <h class="mb-0">コメント一覧</h>
    </div>
     <!-- 現在の本 -->
    @if (count($reviews) > 0)
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table text-nowrap mb-0">
                    <!-- テーブルヘッダ -->
                    <thead class="table-light">
                    <thead>
                        <th></th>
                        <th>投稿者</th>  
                        <th>コメント</th>  
                        <th>&nbsp;</th>
                        <th></th>

                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($reviews as $review)
                            <tr>
                                <!-- 投稿者写真の表示 -->
                                <td class="table-text">
                                @if( $review->nameor==1)
                                <img src="/uploads/{{$review->user->img_url }}" width="100" height="100" class="rounded-circle"  >
                                @elseif( $review->nameor==2)
                                <img src="/uploads/{{$review->user->img_url }}" width="100" height="100" class="rounded-circle"  >
                                @elseif( $review->nameor==3)
                                                            
                                @endif
                                </td>
                                
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
                                
                              @if(auth()->user()->id == $review->user_id)  
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
                                 </form>
                                </td>
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
@endsection