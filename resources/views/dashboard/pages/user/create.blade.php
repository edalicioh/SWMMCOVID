@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Criar um Usuario</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info card-outline">
                <div class="card-body">
                    <h2 class="text-center">Usuário</h2>

                    <form action="{{ isset($user) ? route('users.update', $user['id']) : route('users.store') }} "
                        method="POST">
                        @isset($user)
                            @method('PUT')
                        @endisset
                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" name="user_name"
                                class="form-control {{ $errors->has('user_name') ? 'is-invalid' : '' }}"
                        value="{{ old('user_name') }}{{$user['user_name'] ?? ''}}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>

                            @if ($errors->has('user_name'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('user_name') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" name="email"
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                value="{{ old('email') }}{{$user['email'] ?? ''}}" placeholder="{{ __('adminlte::adminlte.email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="password" name="password"
                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                        placeholder="{{ __('adminlte::adminlte.password') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="password" name="password_confirmation"
                                        class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                        placeholder="{{ __('adminlte::adminlte.retype_password') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ __('adminlte::adminlte.register') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop




@section('js')
    <script>
        /*   const selectPermission =  document.querySelector('#select-permission');
                                selectPermission.addEventListener('change', e => {
                                    if ( Number(e.target.value) === 2 ) {
                                        document.getElementById('isEmpresa').style.display = 'block'
                                    } else {

                                        document.getElementById('isEmpresa').style.display = 'none'
                                    }
                                }) */

    </script>
@stop
