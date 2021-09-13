@extends('layouts.app')
@push('css')

@section('content')

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

        <!-- Masthead-->
        <header class="masthead" style ="padding-top: 100px; padding-bottom: 50px;">
            
            



            <!--<div class="container">-->
            <div class="masthead-subheading">Register Now!</div>

            <div class="card"> </div> 
            <br><br>

                  <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

<!---->
                         <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="XXX@mitsubishicorp.com">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                          <div class="form-group row">
                                <label for="mc_code" class="col-md-4 col-form-label text-md-right">{{ __('MC Personal Code') }}</label>
    
                                <div class="col-md-6">
                                    <input id="mc_code" type="text" class="form-control @error('mc_code') is-invalid @enderror" name="mc_code" value="{{ old('mc_code') }}" required autocomplete="mc_code" placeholder="MCXXXXXX(半角)" pattern="^[0-9A-Za-z]+$" minlength="8" maxlength="8">
    
                                    @error('mc_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
    
    
    <!--スキル-->
                           <div class="form-group row">
                                <label for="skill" class="col-md-4 col-form-label text-md-right">{{ __('Skill') }}</label>
    
                                <div class="col-md-6">
                                    <!--<input id="skill" type="text" class="form-control @error('skill') is-invalid @enderror" name="skill" value="{{ old('skill') }}" required autocomplete="skill" autofocus>-->
                                    <textarea id="skill" class="form-control @error('skill') is-invalid @enderror" name="skill" value="{{ old('skill') }}" required autocomplete="skill" autofocus cols="40" rows="3" wrap="hard"></textarea>

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
                                    <textarea id="profile" class="form-control @error('profile') is-invalid @enderror" name="profile" value="{{ old('profile') }}" required autocomplete="profile" autofocus cols="40" rows="5" wrap="hard"></textarea>
    
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
                                    <input id="nickname" type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname" value="{{ old('nickname') }}" required autocomplete="nickname" autofocus>
    
                                    @error('nickname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    <!--ニックネーム-->
    <!--Register登録-->
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
    <!--Register登録-->
                        </form>
            </div>


<!---->
<!---->
<!---->
<!---->
            </div>


            
        </header>    

@endsection

@endpush









