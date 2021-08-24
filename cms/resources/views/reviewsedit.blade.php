@extends('layouts.app')

@section('content')
<div class="row">
        {{ Auth::user()->id  }}

    <div class="col-md-12">
    @include('common.errors')
    <form action="{{ url('reviews/update') }}" method="POST">



        <!-- title -->
        <div class="form-group">
           <label for="item_name">コメント</label>
           <input type="text" id="item_name" name="title" class="form-control" value="{{$review->review_text}}">
        </div>
        <!--/ title -->
        
        <!-- contents -->
        <div class="form-group">
           <label for="item_number">匿名にしますか？</label>
        <input type="text" id="item_number" name="contents" class="form-control" value="{{$review->nameor}}">
        </div>
        <!--/ contents -->

        <!-- Saveボタン/Backボタン -->
        <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link pull-right" href="{{ url('/postsdetail') }}">
                Back
            </a>
        </div>
        <!--/ Saveボタン/Backボタン -->
         
         <input type="hidden" name="id" value="{{$review->id}}">

         <!-- CSRF -->
         {{ csrf_field() }}
         <!--/ CSRF -->
         
    </form>
    </div>
</div>
@endsection