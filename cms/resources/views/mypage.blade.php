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

        <!-- 本登録フォーム -->
        @if( Auth::check() )
        
        
        <form action="{{ url('users/update') }}" method="POST">
              
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Register') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
        
                                <!--/ title -->
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right" >{{ __('Name') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$users->name}}" required autocomplete="name" autofocus>
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
        
        
        
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$users->email}}" required autocomplete="email">
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
            
                                <div class="form-group row">
                                    <label for="mc_code" class="col-md-4 col-form-label text-md-right span8">{{ __('MC Personal Code') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="mc_code" type="text" class="form-control @error('mc_code') is-invalid @enderror" name="mc_code" value="{{$users->mc_code}}" required autocomplete="mc_code">
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
         
        
        <!--スキル-->
                               <div class="form-group row">
                                    <label for="skill" class="col-md-4 col-form-label text-md-right">{{ __('Skill') }}</label>
        
                                    <div class="col-md-6">
                                        <textarea id="skill" class="form-control @error('skill') is-invalid @enderror" name="skill" required autocomplete="skill" autofocus cols="40" rows="3" wrap="hard">{{$users->skill}}</textarea>
                                        @error('skill')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        <!--スキル-->
        
        <!--簡単な紹介文-->
                               <div class="form-group row">
                                    <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('Profile') }}</label>
        
                                    <div class="col-md-6">
                                        <textarea id="profile" class="form-control @error('profile') is-invalid @enderror" name="profile" required autocomplete="profile" autofocus cols="40" rows="5" wrap="hard">{{$users->profile}}</textarea>
        
                                        @error('profile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        <!--簡単な紹介文-->
        
        <!--//ニックネーム-->
                                 <div class="form-group row">
                                    <label for="nickname" class="col-md-4 col-form-label text-md-right">{{ __('Nickname') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="nickname" type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname" value="{{$users->nickname}}" required autocomplete="nickname" autofocus>
        
                                        @error('nickname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        <!--ニックネーム-->
        
        <!--PW-->
        <!--                       <div class="form-group row">-->
        <!--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>-->
        
        <!--                            <div class="col-md-6">-->
        <!--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="PWを変更する場合、記入してください">-->
        
        <!--                                @error('password')-->
        <!--                                    <span class="invalid-feedback" role="alert">-->
        <!--                                        <strong>{{ $message }}</strong>-->
        <!--                                    </span>-->
        <!--                                @enderror-->
        <!--                            </div>-->
        <!--                        </div>-->
        
        <!--                        <div class="form-group row">-->
        <!--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>-->
        
        <!--                            <div class="col-md-6">-->
        <!--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">-->
        <!--                            </div>-->
        <!--                        </div>-->
        
             
                                 <input type="hidden" name="id" value="{{$users->id}}">
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('変更する') }}
                                        </button>
                                    </div>
                                </div>
                                
                                  <div> 
                                  <a href='/img'  class="form-horizontal">
                                    プロフィール画像変更はこちら
                                  </a>
                                  </div>

                                  <div> 
                                  <a href='/img'  class="form-horizontal">
                                    パスワード変更はこちら（これから編集）
                                  </a>
                                  </div>

                                 
                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
        
 
                    </tbody>
                </table>
            </div>
        </div>
        
  </div>        
 </div>
</div>

        
        
  
    
@endsection