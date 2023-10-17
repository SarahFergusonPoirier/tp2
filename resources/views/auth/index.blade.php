@extends('layouts.app')
@section('content')
    <main class="login-form">
        <div class="w-50 mx-auto">
            <div class="card">
                <h2 class="display-6 card-header text-center">@lang('lang.login')</h2>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors)
                        <ul>
                            @foreach($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <form action="{{ route('login.authentication') }}" method="post">
                        @csrf
                        <ul class="list-group list-group-flush">
                            <li  class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6>@lang('lang.email')</h6>
                                <input type="email" placeholder="email" class="form-control w-50" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <div class="text-danger mt-2">{{ $errors->first('email') }}</div>
                                @endif
                            </li>
                            <li  class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6>@lang('lang.password')</h6>
                                <input type="password" placeholder="password" class="form-control w-50" name="password">
                                @if ($errors->has('password'))
                                    <div class="text-danger mt-2">{{ $errors->first('password') }}</div>
                                @endif
                            </li>
                        </ul>
                        <div class="d-flex justify-content-center">
                            <input type="submit" class="btn btn-success mx-2" value="@lang('lang.send')">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection