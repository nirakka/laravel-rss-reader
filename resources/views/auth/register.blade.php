@extends('layouts.guest')

@section('content')

	            <div id="wrap">
                    <div id="signin-box">
                        <div id="signin-top">
                            <p id="signin-title">Sign in</p>
                        </div>
                        <div id="signin-main">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                                {{ csrf_field() }}
                                <!-- .if-has-error は未定義 -->
                                <div class="{{ $errors->has('name') ? ' if-has-error' : '' }}">
                                <p class="uname-inForm-text">User Name
                                    @if ($errors->has('name'))
                                        <!-- form error 未定義 -->
                                        <span class="form-error">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    </br>
                                    <input type="text" name="name" size="30" maxlength="30" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                                </p>
                                </div>
                                <div class="{{ $errors->has('email') ? ' if-has-error' : '' }}">
                                    <p class="email-inForm-text">E-Mail Address
                                        @if ($errors->has('email'))
                                            <span class="form-error">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                        </br>
                                        <input type="text" size="30" maxlength="30" id="email" type="email" name="email" value="{{ old('email') }}" required>
                                    </p>
                                </div>
                                <div class="{{ $errors->has('password_confirmation') ? ' if-has-error' : '' }}">
                                    <p class="pass-inForm-text">Password
                                        @if ($errors->has('password'))
                                            <span class="form-error">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                        </br>
                                        <input type="password" name="password" size="30" maxlength="20" id="password" required>
                                    </p>
                                </div>
                                <div class="{{ $errors->has('password_confirmation') ? ' if-has-error' : '' }}">
                                    <p class="pass-again-inForm-text">Confirm Password
                                        @if ($errors->has('password_confirmation'))
                                            <span class="form-error">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                        </br>
                                        <input type="password" size="30" maxlength="20" id="password-confirm" name="password_confirmation" required>
                                    </p>
                                </div>
                                <div>
                                    <p class="submit-button"><button type="submit" name="signin">Sign in</button></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

<!--
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-default">
                                <div class="panel-heading">Register</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class="col-md-4 control-label">Name</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="col-md-4 control-label">Password</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control" name="password" required>

                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                                @if ($errors->has('password_confirmation'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Register
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
-->
@endsection
