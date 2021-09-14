<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@push('css')
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')

        <!--↓↓ 検索フォーム ↓↓-->
        <div class="col-sm-4" style="padding:20px 0; padding-left:0px;">
        <form class="form-inline" action="{{url('/posts/search')}}">
          <div class="form-group">
          <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="検索したい言葉を入力してください">
          </div>
          <input type="submit" value="検索" class="btn btn-info">
        </form>
        </div>
        <!--↑↑ 検索フォーム ↑↑-->
          <div class="col-sm-8" style="text-align:right;">

     <div class="table-responsive">
            <div class="table-responsive">
                <table class="table text-wrap mb-0">
                    <!-- テーブルヘッダ -->
                    <thead class="table-light">
                        <th></th>
                        <th>NAME</th>
                        <th>QUESTION</th>
                        <th>CONTENTS</th>
                        <th>RELATED AREAS</th>
                        <th>DATE</th>                        
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($data_post as $d)
                            <tr>
                                <!-- 投稿者写真の表示 -->
                                <td class>
                                @if( $d->nameor==1)
                                <img src="/uploads/{{$d->user->img_url }}" width="100" height="100" class="rounded-circle" >
                                @elseif( $d->nameor==2)
                                <img src="/uploads/{{$d->user->img_url }}" width="100" height="100" class="rounded-circle" >
                                @elseif( $d->nameor==3)
                                @endif
                                </td>
                                 <!-- 投稿者名の表示 -->
                                
                                <td class="table-text">
                                @if( $d->nameor==1)
                                   <div>{{ $d->user->name }}</div>
                                @elseif( $d->nameor==2)
                                   <div>{{ $d->user->nickname }}</div>
                                @elseif( $d->nameor==3)
                                   <div>匿名</div>
                                @endif
                                </td>
                                
                                <!-- 投稿タイトルほか -->
                                <td class="table-text">
                                    <div>{{ $d->title }}</div>
                                </td>
                                <td class="table-text" >
                                    <div>{{ $d->contents }}</p></div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $d->skill }}</div>
                                </td>
                                <td class="table-text">
                                    <div> {{ $d->created_at->format('Y/m/d') }}</div>
                                </td>  
                                


                                
                                <!--質問詳細遷移ボタン -->

                                <td>
                                    <form action="{{ url('postsdetail/'.$d ->id) }}" method="GET">
                                            {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">
                                            Detail
                                        </button>
                                    </form>
                                </td>

                                @if(auth()->user()->id == $d->user_id)  
                                <!--//ログインユーザーID ＝＝ $post tableのuser_idが一致している場合  -->
                                <!--更新ボタン-->
                                <td>
                                    <form action="{{ url('postsedit/'.$d ->id) }}" method="POST">
                                            {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">
                                            Edit
                                        </button>
                                    </form>
                                </td>
                
                                
                                
                                <!-- 本: 削除ボタン -->
                                
                                <td>
                                
                                <form action="{{ url('post/'.$d->id) }}" method="POST">
                                     {{ csrf_field() }}
                                     {{ method_field('delete') }}
                                    
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                 </form>
                                </td>
                                @endif   
                            </tr>
                        @endforeach
                    </tbody>
                    
                    
                    
                     <tbody>
                        @foreach ($data_user as $du)
                            @foreach($du->posts as $post)
                     <tr>
                                <!-- 投稿者写真の表示 -->
                                <td class>
                                @if( $post->nameor==1)
                                <img src="/uploads/{{$post->user->img_url }}" width="100" height="100" class="rounded-circle" >
                                @elseif( $post->nameor==2)
                                <img src="/uploads/{{$post->user->img_url }}" width="100" height="100" class="rounded-circle" >
                                @elseif( $post->nameor==3)
                                @endif
                                </td>
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
                                <td class="table-text" >
                                    <div>{{ $post->contents }}</p></div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $post->skill }}</div>
                                </td>
                                <td class="table-text">
                                    <div> {{ $post->created_at->format('Y/m/d') }}</div>
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
                                            Detail
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
                                            Edit
                                        </button>
                                    </form>
                                </td>
                
                                
                                
                                <!-- 本: 削除ボタン -->
                                
                                <td>
                                
                                <form action="{{ url('post/'.$post->id) }}" method="POST">
                                     {{ csrf_field() }}
                                     {{ method_field('delete') }}
                                    
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                 </form>
                                </td>
                                @endif   
                            </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
        
        
  </div>        
 </div>
</div>

    
@endsection