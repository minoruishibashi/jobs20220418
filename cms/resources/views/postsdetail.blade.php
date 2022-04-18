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
                Job一覧に戻る
            </a>
        </div>

        <!-- name と写真-->
        <div class="form-group">
           <div class="col-sm-6">            
            <label for="item_name">登録者</label>
            </div>
                @if( $posts->nameor==1)
                <div class="yokonarabi">
                <img src="/uploads/{{$posts->user->img_url }}" width="100" height="100" class="rounded-circle">
                <input type="text" name="nameor" class="form-control" style="width:auto" value="{{ $posts->user->name }}" readonly>
                </div>
                @elseif( $posts->nameor==2)
                <div class="yokonarabi">
                <img src="/uploads/{{$posts->user->img_url }}" width="100" height="100" class="rounded-circle">
                <input type="text" name="nameor" class="form-control" style="width:auto" value="{{ $posts->user->nickname}}" readonly>
                </div>
                @elseif( $posts->nameor==3)
                <div class="col-sm-6">            
                <input type="text" name="nameor" class="form-control" style="width:auto" value="匿名" readonly>
                </div>
                @endif
        </div>
         <!--/ id値を送信 -->
    
        <!-- title -->
        <div class="form-group">
        　<div class="col-sm-6">
           <label for="item_name">Job Title</label>
           <input type="text" id="item_name" name="title" class="form-control" value="{{$posts->title}}" readonly>
         </div>
        </div>
        <!--/ title -->
        
        <!-- contents -->
        <div class="form-group">
           <div class="col-sm-6">
           <label for="item_number">Mission</label>
          　<textarea readonly id="item_number" name="contents" class="form-control" cols="40" rows="5" wrap="hard">{{$posts->contents}}</textarea>
        </div>
        <!--/ contents -->

        <!-- skill_ -->
        <div class="form-group">
        　<div class="col-sm-6">
           <label for="item_amount">Candidate</label>
        <input type="text" id="item_amount" name="skill" class="form-control" value="{{$posts->skill}}" readonly>
          </div>
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
           <div class="col-sm-6" style="color:blue">            
            備忘・オフレコ情報　ほか
        </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <p></p>
                    <textarea name="review_text" class="form-control" cols="40" rows="5" wrap="hard" placeholder="コメントを入力する"></textarea> 
                </div>

                   <div class="col-sm-6">
                   <label for="radio01" class="col-sm-6">投稿方法</label>
                   <div class="col-sm-6">
                      <div class="form-check form-check-inline">
                         <input class="form-check-input" type="radio" id="inlineRadio01" name="nameor" value="1" checked="checked">
                         <label class="form-check-label" for="inlineRadio01">本人</label>
                      </div>
                      <div class="form-check form-check-inline">
                         <input class="form-check-input" type="radio" id="inlineRadio02"  name="nameor" value="2" >
                         <label class="form-check-label" for="inlineRadio02">代理</label>
                      </div>
                      <div class="form-check form-check-inline">
                         <input class="form-check-input" type="radio" id="inlineRadio03"  name="nameor" value="3" >
                         <label class="form-check-label" for="inlineRadio03">代理２</label>
                      </div>
                   </div>
                   </div>
                
                <input type="hidden" name="post_id" class="form-control" value="{{$posts->id}}">
            </div>

            <!-- コメント登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        登録
                    </button>
                </div>
            </div>
        </form>
    </div>


 <div class="row mt-6">
  <div class="col-md-12 col-12">
   <div class="card">
    <div class="card-header bg-white border-bottom-0 py-4">
    　 <h class="mb-0">Job一覧</h>
    </div>
     <!-- 現在の本 -->
    @if (count($reviews) > 0)
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table text-wrap mb-0">
                    <!-- テーブルヘッダ -->
                    <thead class="table-light">
                    <thead>
                        <th></th>
                        <th>NAME</th>  
                        <th>COMMENTS</th>  
                        <th>DATE</th>  
                        <th>&nbsp;</th>

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
                                   <div>代理２</div>
                                @endif                       
                                </td>
                                <!-- 投稿タイトルほか -->
                                <td class="table-text">
                                    <div>{{ $review->review_text }}</div>
                                </td>
                                <td class="table-text">
                                    <div> {{ $review->created_at->format('Y/m/d') }}</div>
                                </td>                                  
                                
                              @if(auth()->user()->id == $review->user_id)  
                                <!--更新ボタン-->
                             <div>   
                                <td>
                                    <form action="{{ url('reviewsedit/'.$review->id) }}" method="POST">
                                            {{ csrf_field() }}
                                        <button type="submit" class="btn btn-secondary" style="width: 50%; margin: 5px; padding: 5px;">
                                            Edit
                                        </button>
                                    </form>
                                
                                
                        
                                <!-- 本: 削除ボタン -->
                                
                                
                                
                                <form action="{{ url('review/'.$review->id) }}" method="POST">
                                     {{ csrf_field() }}
                                     {{ method_field('delete') }}
                                    
                                    <button type="submit" class="btn btn-danger" style="width: 50%; margin: 5px; padding: 5px;">
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
@endsection
