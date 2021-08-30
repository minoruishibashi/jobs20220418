@extends('layouts.app')

@section('content')
<div class="row">
        {{ Auth::user()->id  }}

    <div class="col-md-12">
    @include('common.errors')
    <form action="{{ url('reviews/update') }}" method="POST">


        <!-- title -->
        <div class="form-group">
           <label for="item_name">投稿者</label>
           <input type="text" id="item_name" name="title" class="form-control" value="{{$review->user->name}}">
        </div>
        <!--/ title -->
        <!-- title -->
        <div class="form-group">
           <label for="item_name">コメント</label>
           <input type="text" id="" name="review_text" class="form-control" value="{{$review->review_text}}">
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
        <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link pull-right" href="{{ url('/') }}">
                Back
            </a>
        </div>
        <!--/ Saveボタン/Backボタン -->
         
         {{$review->posts_id}};
         
         <input type="hidden" name="id" value="{{$review->id}}">
         <input type="hidden" name="posts_id" value="{{$review->posts_id}}">

         <!-- CSRF -->
         {{ csrf_field() }}
         <!--/ CSRF -->
         
    </form>
    </div>
</div>
@endsection