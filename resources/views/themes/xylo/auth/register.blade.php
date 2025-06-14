@extends('themes.xylo.layouts.auth')  

@section('content')
    <div class="login-page vh-100">
            <div class="row_login">
                <div class="loginpage">
                    <div class="loginstar">*</div>
                    <div class="logintext">Signup Now</div>
                    <div class="loginundertext">
                        <p>Welcome to Bago Merkado! A one stop shop for anything artisan.
                            Please Sign In<br> Have a Great Day!</p>
                    </div>
                    <div class="loginfooter">
                        <p>@2025 BCC rights reserved.</p>
                    </div>

                </div>
                <div class="login-foam">

                    <div class="logo-login mb-2 md-md-5">
                        <img src="assets/images/logo-main.png" width="200px" alt="logo main">
                    </div>

                    <h2>Welcome Back</h2>
                    <p>To craft an effective marketing message, keep it concise, relevant to your target audience</p>
                    
                    <form class="formmain" method="POST" action="{{ route('customer.register') }}">

                        @csrf

                        <div class="form-group">
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Name">
                            @error('name') <span>{{ $message }}</span> @enderror
                        </div>
    
                    
                        <div class="form-group">
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email">
                            @error('email') <span>{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" required>
                            @error('password') <span>{{ $message }}</span> @enderror
                        </div>

                      
                        <div class="form-group">
                            <input  type="password" name="password_confirmation" placeholder="Confirm Password" required>
                        </div>
                       
                        <button class="login-btn" type="submit">Sign up</button>

                    </form>
                    <br />

                    <p>Already have an account?
                        <a href="{{ route('customer.login') }}">Login here</a>
                    </p>

                </div>

            </div>
    </div>
@endsection
