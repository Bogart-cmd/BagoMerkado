<header>

    <div class="top-bar w-100 bg-light py-1 header-top-bar">
        <div class="text-center small">
            One Stop Shop for anything Artisan, GO BAGO!
        </div>
    </div>  

    <div class="container py-3">
        <!-- Row 2: Logo Left / Search Right -->
        <div class="row align-items-center">
            <div class="col-md-4 col-6">
                <a href="{{ route('xylo.home') }}" class="navbar-brand">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/0d/City_of_Bago_Logo.png?20151111093120" width="80" alt="Logo" />
                </a>
                <a href="{{ route('xylo.home') }}" class="navbar-brand fs-3 fw-bold text-primary">
                    Bago Merkado
                </a>
            </div>
            <div class="col-md-8 col-6 text-end">
                <form class="d-flex justify-content-end" action="{{ url('/search') }}" method="GET">
                    <div class="input-group search-input-width">
                        <input type="text" class="form-control" id="search-input"  name="q" placeholder="Search for a product">
                        <button type="submit" class="btn btn-outline-secondary search-style"><i class="fa fa-search"></i></button>
                        <div id="search-suggestions" class="dropdown-menu show w-100 mt-5 d-none"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container py-3">
        <!-- Row 3: Menu Left / Actions Right -->
        <div class="row align-items-center">
            <div class="col-md-8">
                <nav>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link menu-text-color" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-text-color" href="{{ url('/shop') }}">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-text-color" href="{{ url('/about') }}">About</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="col-md-4 d-flex justify-content-end align-items-center gap-3">
                <!-- Language Selector -->
                <!-- <form action="{{ route('change.store.language') }}" method="POST">
                    @csrf
                    <select name="lang" class="form-select form-select-sm font-style" onchange="this.form.submit()">
                        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>EN</option>
                        <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>FR</option>
                        <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>ES</option>
                        <option value="de" {{ app()->getLocale() == 'de' ? 'selected' : '' }}>DE</option>
                    </select>
                </form> -->

                <!-- Currency Selector -->
                <!-- <form action="{{ route('change.currency') }}" method="POST">
                    @csrf
                    <select name="currency_code" class="form-select form-select-sm font-style" onchange="this.form.submit()">
                        @foreach (\App\Models\Currency::all() as $currency)
                            <option value="{{ $currency->code }}" {{ session('currency', 'PHP') == $currency->code ? 'selected' : '' }}>
                                {{ strtoupper($currency->code) }}
                            </option>
                        @endforeach
                    </select>
                </form> -->

                <!-- Wishlist Icon -->
                <a href="{{ auth()->check() ? route('customer.wishlist.index') : route('customer.login') }}" class="text-dark homepage-icon">
                    <i class="fa-regular fa-heart"></i>
                </a>

                <!-- Account Icon -->
                <a href="#" class="text-dark dropdown-toggle homepage-icon" data-bs-toggle="dropdown">
                    <i class="fa-regular fa-user"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-2">
                    @guest
                        <li><a class="dropdown-item" href="{{ route('customer.login') }}">Sign In</a></li>
                        <li><a class="dropdown-item" href="{{ route('customer.register') }}">Sign Up</a></li>
                    @else
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('orders') }}">Orders</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>   

                <!-- Cart Icon -->
                <a href="{{ route('cart.view') }}" class="text-dark position-relative homepage-icon">
                    <i class="fa fa-shopping-bag"></i>
                    <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }}
                    </span>
                </a>
            </div>
        </div>
    </div>
</header>
