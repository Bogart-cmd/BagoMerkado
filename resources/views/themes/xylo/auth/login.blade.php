@extends('themes.xylo.layouts.auth')  

@section('content')
    <div class="login-page vh-100">
            <div class="row_login">
                <div class="loginpage">
                    <div class="loginstar">*</div>
                    <div class="logintext">Hello <br>User! 👋</div>
                    <div class="loginundertext">
                        <p>Welcome to Bago Merkado! A one stop shop for anything artisan.
                            Please Sign In<br> Have a Great Day!</p>
                    </div>


                    <div class="loginfooter">
                        <p>@2025 BCC rights reserved.</p>
                    </div>

                </div>
                <div class="login-foam">

                    <div class="logo-login mb-2 mb-md-5">
                        <img src="assets/images/logo-main.png" width="200px" alt="logo main">
                    </div>

                    <h2>Welcome Back</h2>
                    <p>To craft an effective marketing message, keep it concise, relevant to your target audience</p>
                    
                    <form class="formmain" method="POST" action="{{ route('customer.login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                        </div>
                      
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password">
                        </div>
                       
                        <button type="submit" class="login-btn" type="submit">login now</button>

                    </form>

                    <p class="text-center mt-3">Don't have Account <a href="{{ route('customer.register') }}" class="bnlink">Signup</a> OR <a href="{{ route('customer.password.request') }}">Forgot Password?</a></p>

                </div>

            </div>
    </div>
@endsection
