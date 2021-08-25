@extends('layouts.app')

@section('content')
<div class="row">
        {{ Auth::user()->id  }}

    <div class="col-md-12">
    @include('common.errors')
    <form action="{{ url('posts/update') }}" method="POST">

        <!-- title -->
        <div class="form-group">
           <label for="item_name">投稿者</label>
           <input type="text" id="item_name" name="title" class="form-control" value="{{$post->user->name}}">
        </div>
        <!--/ title -->

        <!-- title -->
        <div class="form-group">
           <label for="item_name">質問</label>
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
           <label for="item_amount">関連スキル（タグ）</label>
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
            <button type="submit" class="btn btn-primary">
                Save
            </button>
            <a class="btn btn-link pull-right" href="{{ url('/') }}">
                Back
            </a>
        </div>
        <!--/ Saveボタン/Backボタン -->
         
         <input type="hidden" name="id" value="{{$post->id}}">

         <!-- CSRF -->
         {{ csrf_field() }}
         <!--/ CSRF -->
         
    </form>
    </div>
</div>
@endsection