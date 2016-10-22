@extends('layouts.guest')

@section('content')

	            <div id="wrap">
	                <div id="signin-box">
	                    <div id="signin-top">
	                        <p id="signin-title">Sign in</p>
	                    </div>
	                    <div id="signin-main">

	                        <p class="email-inForm-text">E-Mail Address</br>
	                        <input type="text" name="mail" size="30" maxlength="30"></p>
	                        <p class="pass-inForm-text">Password</br>
	                        <input type="password" name="password" size="30" maxlength="20"></p>
	                        <label><p class="rememberMe"><input type="checkbox" name="RememberFg" value="1"> Remember Me</p></label>
	                        <p><button type="button" name="signin">Sign in</button> <a href="#"> Forgot Your Password?</a></p>
	                    </div>
	                </div>
            	</div>
