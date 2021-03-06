@extends('layouts.app')

@section('content')
    @component('layouts.components.auth')
        <h2 class="mb-3">
            {{ __('Бақайдгирӣ') }}
        </h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>

                    <input id="name" placeholder="Ному насаб" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-at"></i></span>
                    </div>

                    <input id="email" placeholder="Суроғаи электронӣ" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>

                    <input id="password" placeholder="Парол" type="password" class="form-control" name="password" value="{{ old('password') }}" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>

                    <input id="password-confirm" placeholder="Такрори парол" type="password" class="form-control" name="password_confirmation" value="{{ old('password') }}" required autofocus>
                </div>
            </div>
            <button type="submit" class="btn btn-success w-75">
                {{ __('Бақайдгиред') }}
            </button>
        </form>
        <div class="my-2">
            Суратҳисоб доред?
            <a href="{{ route('login') }}" style="color: #e3342f">
                Даромад
            </a>
        </div>
    @endcomponent
@endsection
