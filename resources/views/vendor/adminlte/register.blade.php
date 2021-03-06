@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">{{ trans('adminlte::adminlte.register_message') }}</p>
            <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                           placeholder="{{ trans('adminlte::adminlte.full_name') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('firstname') ? 'has-error' : '' }}">
                    <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}"
                           placeholder="{{ trans('adminlte::adminlte.first_name') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('firstname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('street') ? 'has-error' : '' }}">
                    <input type="text" name="street" class="form-control"  value="{{old('street')}} "
                    placeholder="{{ trans('adminlte::adminlte.street') }}">
                    <span class="glyphicon glyphicon-home form-control-feedback"></span>
                    @if ($errors->has('street'))
                        <span class="help-block">
                            <strong>{{ $errors->first('street') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('streetNum') ? 'has-error' : '' }}">
                    <input type="text" name="streetNum" class="form-control" value="{{old('streetNum')}}"
                    placeholder="{{ trans('adminlte::adminlte.streetNum') }}">
                    <span class="glyphicon glyphicon-home form-control-feedback"></span>
                    @if ($errors->has('streetNum'))
                        <span class="help-block">
                            <strong>{{ $errors->first('streetNum') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('boxNum') ? 'has-error' : '' }}">
                    <input type="text" name="boxNum" class="form-control" value="{{ old('boxNum') }}"
                           placeholder="{{ trans('adminlte::adminlte.box') }}">
                    <span class="glyphicon glyphicon-home form-control-feedback"></span>
                    @if ($errors->has('boxNum'))
                        <span class="help-block">
                            <strong>{{ $errors->first('boxNum') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"
                    placeholder="{{ trans('adminlte::adminlte.phone') }}">
                    <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('cityId') ? 'has-error' : '' }}">
                    {!! Form::select('cityId',$cities, null,['class'=>"js-select2 form-control"] ) !!}
                    @if ($errors->has('cityId'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cityId') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                >{{ trans('adminlte::adminlte.register') }}</button>
            </form>
            <div class="auth-links">
                <a href="{{ url(config('adminlte.login_url', 'login')) }}"
                   class="text-center">{{ trans('adminlte::adminlte.i_already_have_a_membership') }}</a>
            </div>
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop

@section('adminlte_js')
    @yield('js')
    <script>
        $(document).ready(function(){
            $('.js-select2').select2()
        })
    </script>
@stop
