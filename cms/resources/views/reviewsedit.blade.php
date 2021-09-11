@extends('layouts.app')
@push('css')
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="card-body">

    <div class="col-md-12">
    @include('common.errors')
    <form action="{{ url('reviews/update') }}" method="POST">

        <!-- 質問一覧に戻る -->
        <div class="well well-sm">
            <a class="btn btn-link pull-right" href="{{ url('/') }}">
                コメント一覧に戻る
            </a>
        </div>

        <!-- title -->
        <div class="form-group">
           <div class="col-sm-6">            
           <label for="item_name">投稿者</label>
           <input type="text" id="item_name" name="title" class="form-control" value="{{$review->user->name}}">
           </div>        
        </div>
        <!--/ title -->
        <!-- title -->
        <div class="form-group">
           <div class="col-sm-6">            
           <label for="item_name">コメント</label>
           <textarea name="contents" class="form-control" cols="40" rows="5" wrap="hard" value="{{$review->review_text}}"></textarea>
           </div>
        </div>
        <!--/ title -->
        
        <!-- contents -->
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
        <!--/ contents -->

        <!-- Saveボタン/Backボタン -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-primary">
                    更新する
                </button>
            </div>
        </div>
        <!--/ Saveボタン/Backボタン -->
         
         <input type="hidden" name="id" value="{{$review->id}}">
         <input type="hidden" name="posts_id" value="{{$review->posts_id}}">

         <!-- CSRF -->
         {{ csrf_field() }}
         <!--/ CSRF -->
         
    </form>
    </div>
</div>
@endsection