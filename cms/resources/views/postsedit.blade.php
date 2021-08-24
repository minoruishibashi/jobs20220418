@extends('layouts.app')

@section('content')
<div class="row">
        {{ Auth::user()->id  }}

    <div class="col-md-12">
    @include('common.errors')
    <form action="{{ url('posts/update') }}" method="POST">

        <!-- title -->
        <div class="form-group">
           <label for="item_name">投稿タイトル</label>
           <input type="text" id="item_name" name="title" class="form-control" value="{{$post->title}}">
        </div>
        <!--/ title -->
        
        <!-- contents -->
        <div class="form-group">
           <label for="item_number">内容</label>
        <input type="text" id="item_number" name="contents" class="form-control" value="{{$post->contents}}">
        </div>
        <!--/ contents -->

        <!-- skill_ -->
        <div class="form-group">
           <label for="item_amount">スキル</label>
        <input type="text" id="item_amount" name="skill" class="form-control" value="{{$post->skill}}">
        </div>
        <!--/ skill -->
        
        <!-- nameor -->
        <div class="form-group">
           <label for="published">匿名にしますか？</label>
            <input type="test" id="published" name="nameor" class="form-control" value="{{$post->nameor}}"/>
        </div>
        <!--/ published -->
        
        <!-- Saveボタン/Backボタン -->
        <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link pull-right" href="{{ url('/') }}">
                Back
            </a>
        </div>
        <!--/ Saveボタン/Backボタン -->
         
          id値を送信 
         <input type="hidden" name="id" value="{{$post->id}}">
         / id値を送信 
         
         <!-- CSRF -->
         {{ csrf_field() }}
         <!--/ CSRF -->
         
    </form>
    </div>
</div>
@endsection