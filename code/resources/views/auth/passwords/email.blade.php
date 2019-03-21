@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex flex-wrap justify-content-center flex-row-reverse my-2">
            <div class="px-5">
                <img class="w-100" src="{{URL::asset('/img/login-image.png')}}">
            </div>
            <div class="col col-lg-4">
                <div class="col text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2 class="py-3">Ирсоли парол</h2>
                    <form method="POST" action="{{ route('password.email') }}">

                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>

                                <input id="email" placeholder="Сурогаи электрони" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success my-4 w-75" style="border-radius: 20px">
                            {{ __('Паролро равон кунед') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
