@extends('layouts.guest')
@section('Title')
    <h1 id="title">Login Page</h1>
    </div>

@endsection
@section('content')

            <div id="wrap">
                <div id="signin-box">
                    <div id="signin-top">
                        <p id="signin-title">Log in</p>
                    </div>
                          <form role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                    <div id="signin-main">

                        <p class="email-inForm-text">E-Mail Address</br>
                        <input type="text" name="email" value="{{ old('email') }}"  size="30" maxlength="30"></p>
                        <p class="pass-inForm-text">Password</br>
                        <input type="password" name="password" size="30" maxlength="20"></p>
                        <label><p class="rememberMe"><input type="checkbox" name="RememberFg" value="1"> Remember Me</p></label>
                        <p><button type="submit" name="signin">Log in</button> <a href="{{ url('/password/reset') }}"> Forgot Your Password?</a></p>
                    </div>
            </form>

                </div>
            </div>


@endsection
