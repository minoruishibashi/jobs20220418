<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@push('css')
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="card-body">

        <!-- バリデーションエラーの表示に使用-->
        @include('common.errors')
        <!-- バリデーションエラーの表示に使用-->


        

 <div class="row mt-6">
  <div class="col-md-12 col-12">
   <div class="card">
    <div class="card-header bg-white border-bottom-0 py-4">
          <h class="mb-0">KENMUメンバー一覧</h>
    </div>
  
           <!-- 現在の本 -->
    @if (count($users) > 0)
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table text-nowrap mb-0">
                    <!-- テーブルヘッダ -->
                    <thead class="table-light">
                        <th></th>
                        <th>Name</th>
                        <th>E-Mail Address</th>
                        <th>Skill</th>
                        <th>Profile</th>
                        <th>Nickname</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <!-- Name-->
                                <td class>
                                <img src="/uploads/{{$user->img_url }}" width="100" height="100" class="rounded-circle" >
                                </td>

                                <!-- Name-->
                                
                                <td class="table-text">
                                   <div>{{ $user->name }}</div>
                                </td>
                                
                                 <!--E-Mail Address -->
                                <td class="table-text">
                                    <div>{{ $user->email }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $user->skill }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $user->profile }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $user->nickname }}</div>
                                </td>
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
@endsection