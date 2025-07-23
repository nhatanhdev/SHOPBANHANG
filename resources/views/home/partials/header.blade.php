<header class="{{ Request::is('/') ? 'three' : '' }}">
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-slid">
                <div>
                    <div class="phone-data">
                        <div class="phone">
                            <i>
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                    style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <path
                                        d="M0,81v350h512V81H0z M456.952,111L256,286.104L55.047,111H456.952z M30,128.967l134.031,116.789L30,379.787V128.967z
                     M51.213,401l135.489-135.489L256,325.896l69.298-60.384L460.787,401H51.213z M482,379.788L347.969,245.756L482,128.967V379.788z">
                                    </path>
                                </svg>
                            </i><a href="mallto:username@domain.com">{{Setting_key('email')}}</a>
                        </div>
                        <div class="phone d-flax align-items-center">
                            <i>
                                <svg height="112" viewBox="0 0 24 24" width="112"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-rule="evenodd" fill="rgb(255255,255)" fill-rule="evenodd">
                                        <path
                                            d="m7 2.75c-.41421 0-.75.33579-.75.75v17c0 .4142.33579.75.75.75h10c.4142 0 .75-.3358.75-.75v-17c0-.41421-.3358-.75-.75-.75zm-2.25.75c0-1.24264 1.00736-2.25 2.25-2.25h10c1.2426 0 2.25 1.00736 2.25 2.25v17c0 1.2426-1.0074 2.25-2.25 2.25h-10c-1.24264 0-2.25-1.0074-2.25-2.25z">
                                        </path>
                                        <path
                                            d="m10.25 5c0-.41421.3358-.75.75-.75h2c.4142 0 .75.33579.75.75s-.3358.75-.75.75h-2c-.4142 0-.75-.33579-.75-.75z">
                                        </path>
                                        <path
                                            d="m9.25 19c0-.4142.33579-.75.75-.75h4c.4142 0 .75.3358.75.75s-.3358.75-.75.75h-4c-.41421 0-.75-.3358-.75-.75z">
                                        </path>
                                    </g>
                                </svg>
                            </i>
                            <a class="me-3" href="callto:+02101283492">+{{Setting_key('phone')}} </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="time">
                        @if (auth()->check())
                            <div class="ordering">
                                <a href="#">Đặt hàng</a>
                                <div class="line"></div>
                                <a href="#">Đang chuyển hàng</a>
                                <div class="line"></div>
                                <a href="">Trả lại</a>
                            </div>
                        @endif
                        <div class="login">
                            @if (auth()->check())
                                <div class="login-in">
                                    <i class="fa-solid fa-user"></i>
                                    <a href="javascip:void">
                                        {{ auth()->user()->name }}
                                    </a>
                                    <ul class="login-in__sub">
                                        <li><a href="/my-account">Tài Khoản </a></li>
                                        <li><a href="/order">Đơn Hàng </a></li>
                                        <li><a href="/wishlist">Sản Phẩm Yêu Thích </a></li>
                                        <li><a href="{{ route('logout') }}">Đăng Xuất</a></li>
                                    </ul>
                                </div>
                            @else
                                <div class="login-out d-flex align-items-center">
                                    <i class="fa-solid fa-sign-in"></i>
                                    <a href="{{ route('login') }}">Đăng Nhập</a>
                                    <i class="fa-solid fa-user-plus"></i>
                                    <a href="{{ route('register') }}">Đăng Ký</a>

                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="bottom-bar">
            <a href="{{route('home.index')}}"><img src="{{ asset('home/assets/img/logo-w.png') }}" alt="logo"></a>
            <nav class="navbar">
                <ul class="navbar-links">
                    <li class="navbar-dropdown">
                        <a href="{{ route('home.index') }}">
                            {{-- <i><img alt="home" src="{{asset('home/assets/img/home-svgrepo-com.svg')}}" width="25px"></i> --}}
                            Trang Chủ
                        </a>

                    </li>
                    <li class="navbar-dropdown">
                        <a href="{{ route('home.product') }}">Sản Phẩm</a>
                    </li>
                    <li class="navbar-dropdown menu-item-children">
                        <a href="javascript:void(0)">Dịch Vụ</a>
                        <div class="dropdown">
                            <a href="{{ route('home.service') }}">Dịch Vụ</a>
                            <a href="{{ route('home.pricing_package') }}">Báo Giá</a>
                        </div>
                    </li>
                    <li class="navbar-dropdown">
                        <a href="{{ route('home.contact') }}">Liên Hệ</a>
                    </li>
                    <li class="navbar-dropdown menu-item-children">
                        <a href="javascript:void(0)">Giới Thiệu</a>
                        <div class="dropdown">
                            <a href="{{ route('home.about') }}">Về Chúng Tôi</a>
                            <a href="team-details.html">Team Chúng Tôi</a>
                            <a href="how-we-works.html">how we works</a>
                            <a href="photo-gallery.html">Ảnh Triển Lãm</a>
                        </div>
                    </li>
                    <li class="navbar-dropdown menu-item-children">
                        <a href="javascript:void(0)">Tin Tức</a></a>
                        <div class="dropdown">
                            <a href="{{ route('home.blog') }}">Blog</a>
                            <a href="{{route('home.history')}}">Lịch Sử Phát Triển</a>
                        </div>
                    </li>

                </ul>
            </nav>
            <div class="menu-end">
                <div class="bar-menu">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="header-search-button search-box-outer">
                    <a href="javascript:void(0)" class="search-btn">
                        <svg height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg">
                            <g id="_12" data-name="12">
                                <path
                                    d="m21.71 20.29-2.83-2.82a9.52 9.52 0 1 0 -1.41 1.41l2.82 2.83a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zm-17.71-8.79a7.5 7.5 0 1 1 7.5 7.5 7.5 7.5 0 0 1 -7.5-7.5z">
                                </path>
                            </g>
                        </svg>
                    </a>
                </div>
                <div class="line"></div>

                <a href="{{ route('wishlist.index') }}"><i class="fa-regular fa-heart"></i></a>
                <div class="hamburger-icon">
                    <div class="donation">

                        <a href="JavaScript:void(0)" class="mx-0" id="show">
                            <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path
                                        d="m452 120h-60.946c-7.945-67.478-65.477-120-135.054-120s-127.109 52.522-135.054 120h-60.946c-11.046 0-20 8.954-20 20v352c0 11.046 8.954 20 20 20h392c11.046 0 20-8.954 20-20v-352c0-11.046-8.954-20-20-20zm-196-80c47.484 0 87.019 34.655 94.659 80h-189.318c7.64-45.345 47.175-80 94.659-80zm176 432h-352v-312h40v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h192v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h40z">
                                    </path>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-nav hmburger-menu" id="mobile-nav" style="display:block;">
        <div class="res-log">
            <a href="{{route('home.index')}}">
                <img src="{{ asset('home/assets/img/logo-w.png') }}" alt="Responsive Logo">
            </a>
        </div>
        <ul>

            <li><a href="{{route('home.index')}}">Trang Chủ</a></li>

            <li><a href="{{route('home.product')}}">Sản Phấm</a></li>

            <li class="menu-item-has-children"><a href="JavaScript:void(0)">Dịch Vụ</a>
                <ul class="sub-menu">
                    <li><a href="{{route('home.service')}}">Dịch Vụ</a></li>
                    <li><a href="{{route('home.pricing_package')}}">Báo Giá</a></li>
                </ul>

            </li>
            <li><a href="{{route('home.contact')}}">Liên Hệ</a></li>

            <li class="menu-item-has-children"><a href="JavaScript:void(0)">Giới Thiệu</a>
                <ul class="sub-menu">
                    <li><a href="{{route('home.about')}}">Về Chúng Tôi</a></li>
                    <li><a href="">team details</a></li>
                    <li><a href="how-we-works.html">how we works</a></li>
                    <li><a href="photo-gallery.html">photo gallery</a></li>
                </ul>

            </li>

            <li class="menu-item-has-children"><a href="JavaScript:void(0)">Tin Tức</a>

                <ul class="sub-menu">
                    <li><a href="{{route('home.blog')}}">Blog</a></li>
                    <li><a href="{{route('home.history')}}">Lịch Sử Phát Triển</a></li>
                </ul>
            </li>
            <li><a href="{{route('login')}}">Đăng Nhập</a></li>

        </ul>
        <ul class="social-icon">
            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
        </ul>

        <a href="JavaScript:void(0)" id="res-cross"></a>
    </div>
</header>
