    <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/images/logo.svg" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto mb-3">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/categories">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/categories">Daftar Toko</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-success nav-link px-4 text-white" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest
                </ul>
                @auth
                    <ul>
                        <ul class="navbar-nav ml-auto d-none d-lg-flex">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <img src="/images/icon-user.png" alt="" class="rounded-circle mr-2 profile-picture" />
                                    Hi, {{ Auth::user()->nama }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                                    <a class="dropdown-item" href="{{ route('dashboard-settings-account') }}">Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                                                        document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>

                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-inline-block mt-2" href="#">
                                    @php
                                        $carts = \App\Models\Cart::where('user_id', Auth::user()->id)->count();
                                    @endphp
                                    @if ($carts > 0)
                                        <a class="navbar-brand" href="{{ route('cart') }}">
                                            <img src="/images/icon-cart-filled.svg" alt="" />
                                            <div class="cart-badge">{{ $carts }}</div>
                                        @else
                                            <img src="/images/icon-cart-empty.svg" alt="" />
                                    @endif
                                </a>
                            </li>
                        </ul>
                        <!-- Mobile Menu -->
                        <ul class="navbar-nav d-block d-lg-none mt-3">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Hi, Angga
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-inline-block" href="#">
                                    Cart
                                </a>
                            </li>
                        </ul>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
