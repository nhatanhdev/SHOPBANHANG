@extends('layouts.home')
@section('title')
<title>Trang Chủ</title>
@endsection
@section('content')
<section class="hero-three" style="background-image:url({{asset('home/assets/img/background-3.jpg')}})">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 item">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-three-text">
                            <h2>Hãy Quan Tâm Đến Thú Cưng ^^!</h2>
                            <ul class="list">
                                <li><i class="fa-solid fa-check"></i>Dịch Vụ Chăm Sóc</li>
                                <li><i class="fa-solid fa-check"></i>Mua Thức Ăn</li>
                            </ul>
                            <a href="{{route('home.product')}}" class="button">Mua Ngay</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-three-img">
                            <img src="{{asset('home/assets/img/all-100.png')}}" class="all-100" alt="all-100">
                            <img src="{{asset('home/assets/img/hero-three-1.jpg')}}" class="hero-three-img" alt="hero-three">
                            <img src="{{asset('home/assets/img/slide-2.png')}}" alt="hero-three" width="60%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="{{asset('home/assets/img/haddi.png')}}" alt="hero-shaps" class="img-2">
    <img src="{{asset('home/assets/img/dabal-foot-2.png')}}" alt="hero-shaps" class="img-3">
    <img src="{{asset('home/assets/img/line.png')}}" alt="hero-shaps" class="img-4">
</section>
<div class="gap no-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="offers-banner">
                    <div>
                        <h3>30% Off</h3>
                        <h5>Natural Food and Treats for Small Pets</h5>
                        <a href="{{route('home.product')}}">Start Shopping</a>
                    </div>
                    <img src="{{asset('home/assets/img/offers-banner-1.png')}}" class="offers-banner" alt="offers-banner">
                    <img src="{{asset('home/assets/img/animal-feed-4.png')}}" alt="animal-feed">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="offers-banner two">
                    <div>
                        <h3>40% Off</h3>
                        <h5>Best Food for your Loving Dog</h5>
                        <a href="{{route('home.product')}}">Start Shopping</a>
                    </div>
                    <img src="{{asset('home/assets/img/offers-banner-2.png')}}" class="offers-banner" alt="offers-banner">
                    <img src="{{asset('home/assets/img/food-1.png')}}" alt="animal-feed">
                </div>
            </div>
        </div>
    </div>
</div>
<section class="gap no-top section-healthy-product">
    <div class="container">
        <div class="heading">
            <img src="{{asset('home/assets/img/heading-img.png')}}" alt="heading-img">
            <h6>TÌM SẢN PHẨM LÀNH MẠNH THEO DANH MỤC</h6>
            <h2>Tất Cả Danh Mục</h2>
        </div>
        <div class="row slider-categorie owl-carousel owl-theme">
            <div class="col-lg-12 item">
                <div class="food-categorie">
                    <img src="{{asset('home/assets/img/food-categorie-1.png')}}" alt="food-categorie">
                    <a href="our-products.html">Cat Supplies</a>
                </div>
            </div>
            <div class="col-lg-12 item">
                <div class="food-categorie">
                    <img src="{{asset('home/assets/img/food-categorie-2.png')}}" alt="food-categorie">
                    <a href="our-products.html">Dog Supplies</a>
                </div>
            </div>
            <div class="col-lg-12 item">
                <div class="food-categorie">
                    <img src="{{asset('home/assets/img/food-categorie-3.png')}}" alt="food-categorie">
                    <a href="our-products.html">Animal Feed</a>
                </div>
            </div>
            <div class="col-lg-12 item">
                <div class="food-categorie">
                    <img src="{{asset('home/assets/img/food-categorie-4.png')}}" alt="food-categorie">
                    <a href="our-products.html">Accessories</a>
                </div>
            </div>
            <div class="col-lg-12 item">
                <div class="food-categorie">
                    <img src="{{asset('home/assets/img/food-categorie-5.png')}}" alt="food-categorie">
                    <a href="our-products.html">Horse Care</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="gap no-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="looking position-relative">
                    <form class="looking-form">
                        <h3>Đặt Lịch Dịch VỤ</h3>
                        <span>
                            Bạn đang tìm kiếm một dịch vụ cho:
                        </span>
                        <ul>
                          <li>
                            <input type="radio" id="f-option" name="selector">
                            <label for="f-option">Chó</label>
                            <div class="check"></div>
                          </li>
                          <li>
                            <input type="radio" id="s-option" name="selector">
                            <label for="s-option">Mèo</label>
                            <div class="check"><div class="inside"></div></div>
                          </li>
                          <li>
                            <input type="radio" id="b-option" name="selector">
                            <label for="b-option">Khác</label>
                            <div class="check"><div class="inside"></div></div>
                          </li>
                        </ul>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="Complete Name" placeholder="Complete Name">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="Email Address" placeholder="Email Address">
                            </div>
                            <div class="col-lg-6">
                                <select class="nice-select Advice">
                                    <option>Chọn Dịch Vụ</option>
                                    <option>Services 1</option>
                                    <option>Services 2</option>
                                    <option>Services 3</option>
                                    <option>Services 4</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <select class="nice-select Advice">
                                    <option>Kích Thước Thú Cưng</option>
                                    <option>Services 1</option>
                                    <option>Services 2</option>
                                    <option>Services 3</option>
                                    <option>Services 4</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Mô tả yêu cầu của bạn"></textarea>
                            </div>
                        </div>
                        <button class="button">Đặt Ngay</button>
                    </form>
                    <div class="video">
                        <svg class="golo" width="530" height="530" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"/>
                        </svg>
                        <a data-fancybox="" href="https://www.youtube.com/watch?v=xKxrkht7CpY">
                            <i>
                              <svg width="11" height="17" viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M11 8.49951L0.5 0.27227L0.5 16.7268L11 8.49951Z" fill="#000"></path>
                              </svg>
                            </i>
                        </a>
                        <img src="{{asset('home/assets/img/dog-video.jpg')}}" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="gap" style="background-image: url({{asset('home/assets/img/healthy-product.png')}}); background-color: #f5f5f5;">
    <div class="container">
        <div class="heading">
            <img src="{{asset('home/assets/img/heading-img.png')}}" alt="heading-img">
            <h6>
                TÌM SẢN PHẨM LÀNH MẠNH
            </h6>
            <h2>Sản Phẩm Lành Mạnh</h2>
        </div>
        <div class="row">
            @foreach ( $products  as $item )
            <div class="col-xl-4 col-md-6">
                <div class="products">
                    <div class="products-img">
                        <a href="{{route('home.product_single',['id' => $item->id])}}"><img src="{{asset($item->feature_image)}}" alt="food"></a>
                    </div>
                    @if($item->price_old)
                    <h6>-{{round((($item->price_old - $item->price))*100  /($item->price_old),0) }}%</h6>
                    @endif
                    <span>{{$item->category->name ?? ''}}</span>
                    <a href="{{route('home.product_single',['id' => $item->id])}}">{{$item->name}}</a>
                    <div class="products-text">
                        <h4>{{number_format($item->price)}} đ</h4>
                        <div class="d-flex align-items-center">
                            <ul class="star">
                                @php
                                    $rate_avg = rate_single_product($item->id);
                                @endphp
                                @for ($i = 1; $i <= $rate_avg; $i++)
                                    <li><i class="fa-solid fa-star"></i></li>
                                @endfor
                                @for ($k = 1; $k <= 5 - $rate_avg; $k++)
                                    <li><i class="fa-regular fa-star"></i></li>
                                @endfor
                            </ul>
                            <div class="cart">
                               <a href="{{route('home.product_single',['id' => $item->id])}}">
                                <svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--twemoji" preserveAspectRatio="xMidYMid meet" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#E1E8ED" d="M35.059 18c0 3.304-7.642 11-17.067 11C8.566 29 .925 22.249.925 18c0-3.314 34.134-3.314 34.134 0z"></path><path fill="#292F33" d="M35.059 18H.925c0-3.313 7.642-11 17.067-11s17.067 7.686 17.067 11z"></path><path fill="#F5F8FA" d="M33.817 18c0 2.904-7.087 9.667-15.826 9.667c-8.74 0-15.825-5.935-15.825-9.667c0-2.912 7.085-9.666 15.825-9.666C26.73 8.333 33.817 15.088 33.817 18z"></path><circle fill="#8B5E3C" cx="18" cy="18" r="8.458"></circle><circle fill="#292F33" cx="18" cy="18" r="4.708"></circle><circle fill="#F5F8FA" cx="14.983" cy="15" r="2"></circle></g></svg>                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="btn-center">
                <a href="{{route('home.product')}}" class="button">Xem thêm</a>
            </div>
    </div>
</section>
<section class="gap">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="heading two">
                    <h6>give your pets high-quality products</h6>
                    <h2>We Provide The Pet Care Services.</h2>
                </div>
            </div>
            <div class="offset-lg-1 col-lg-5">
                <p>Lorem ipsum dolor sit amet,consectetur adipi usmod tempor incididunt ut labore et.Lorem ip amet,consectetur adipiscing elibore et.</p>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-6">
                            <div class="pet-grooming">
                            <i><img src="{{asset('home/assets/img/welcome-to-3.png')}}" alt="icon"></i>
                            <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"></path>
                            </svg>
                            <a href="#"><h4>Online Order</h4></a>
                            <p>Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiu incididunt ut labore et.</p>
                            </div>
                    </div>
                    <div class="col-md-6">
                            <div class="pet-grooming">
                            <i><img src="{{asset('home/assets/img/welcome-to-1.png')}}" alt="icon"></i>
                            <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"></path>
                            </svg>
                            <a href="#"><h4>Pet Grooming</h4></a>
                            <p>Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiu incididunt ut labore et.</p>
                            </div>
                    </div>
                    <div class="col-md-6">
                            <div class="pet-grooming mt-5">
                            <i><img src="{{asset('home/assets/img/welcome-to-4.png')}}" alt="icon"></i>
                            <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"></path>
                            </svg>
                            <a href="#"><h4>Pet Boarding</h4></a>
                            <p>Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiu incididunt ut labore et.</p>
                            </div>
                    </div>
                    <div class="col-md-6">
                            <div class="pet-grooming mt-5">
                            <i><img src="{{asset('home/assets/img/welcome-to-2.png')}}" alt="icon"></i>
                            <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"></path>
                            </svg>
                            <a href="#"><h4>Dog Walking</h4></a>
                            <p>Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiu incididunt ut labore et.</p>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="dogs-img">
                    <img src="{{asset('home/assets/img/dogs.png')}}" alt="dogs">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="gap no-top">
    <div class="container">
        <div class="heading">
            <img src="{{asset('home/assets/img/heading-img.png')}}" alt="heading-img">
            <h6>Find Healthy Product</h6>
            <h2>Deal of the Week</h2>
        </div>
        <div class="deal-of-the-week two">
                    <div class="healthy-product-img">
                        <img src="{{asset('home/assets/img/food-6.png')}}" alt="food">
                        <ul class="star">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                        </ul>
                    </div>
                    <div class="healthy-product">
                        <span>12 Reviews</span>
                        <a href="#">Healthy Dog Food Roaster Chicken</a>
                        <ul class="list">
                            <li><i class="fa-solid fa-check"></i>Free Online Shipping</li>
                            <li><i class="fa-solid fa-check"></i>Your Pets Are 100% Safe at Our Care</li>
                        </ul>
                        <h6><del>$32.00</del>$22.00</h6>
                        <h5>up to 14% off</h5>
                        <div class="add-to-cart">
                          <a href="#" class="button">Add to Cart</a>
                          <a href="#" class="heart-wishlist">
                            <i class="fa-regular fa-heart"></i>
                          </a>
                        </div>
                        <div id="countdown">
                            <ul>
                              <li><span id="days">9</span>days</li>
                              <li><span id="hours">61</span>Hour</li>
                              <li><span id="minutes">51</span>Min</li>
                              <li class="mb-0"><span id="seconds">54</span>Sec</li>
                            </ul>
                           </div>
                    </div>
        </div>
    </div>
</section>
<section class="gap" style="background-image:url({{asset('home/assets/img/client-b.jpg')}})">
    <div class="container">
        <div class="heading">
            <img src="{{asset('home/assets/img/heading-img.png')}}" alt="heading-img">
            <h6>Find Healthy Product</h6>
            <h2>How it Works</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="works">
                    <div class="works-img">
                        <svg width="230" height="230" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"></path>
                                </svg>
                        <i><img src="{{asset('home/assets/img/works-1.png')}}" alt="works"></i>
                        <span>1</span>
                    </div>
                    <h4>Search Service</h4>
                    <p>Lorem ipsum dolor sit ametur adipis elit sed do eiu incididunt ut labore et adipisco eiu incididunt ut</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="works">
                    <div class="works-img">
                        <svg width="230" height="230" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"></path>
                                </svg>
                        <i><img src="{{asset('home/assets/img/works-2.png')}}" alt="works"></i>
                        <span>2</span>
                    </div>
                    <h4>Book and Pay</h4>
                    <p>Lorem ipsum dolor sit ametur adipis elit sed do eiu incididunt ut labore et adipisco eiu incididunt ut</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="works mb-0">
                    <div class="works-img">
                        <svg width="230" height="230" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"></path>
                                </svg>
                        <i><img src="{{asset('home/assets/img/works-3.png')}}" alt="works"></i>
                        <span>3</span>
                    </div>
                    <h4>Relax</h4>
                    <p>Lorem ipsum dolor sit ametur adipis elit sed do eiu incididunt ut labore et adipisco eiu incididunt ut</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="what-our">
                    <h2>What Our Client’s Say</h2>
                    <ul class="star position-relative">
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                    </ul>
                    <h5>Rated 4.5 Out of 5.0</h5>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="quotation-slider owl-carousel owl-theme">
                    <div class="item">
                        <div class="quotation">
                            <i class="quotat">
                                <img src="{{asset('home/assets/img/quotation.png')}}" alt="quotation">
                            </i>
                            <ul class="star position-relative">
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                            </ul>
                            <h4>Excepteur sint occaecat cupidatat ni deserunt mollit anim Lorem set dolo li dolor sit amet, consectetur adipiscin nuliems elit sed incididunt</h4>
                            <h5>Willimes Marko</h5>
                            <span>Health Advisor</span>
                            <img src="{{asset('home/assets/img/quotation-1.jpg')}}" alt="quotation-1" class="quotation-girl">
                        </div>
                    </div>
                    <div class="item">
                        <div class="quotation">
                            <i class="quotat">
                                <img src="{{asset('home/assets/img/quotation.png')}}" alt="quotation">
                            </i>
                            <ul class="star position-relative">
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                            </ul>
                            <h4>cupidatat ni deserunt mollit anim Lorem set dolo li dolor sit amet, consectetur adipiscin Excepteur sint occaecat nuliems elit sed incididunt</h4>
                            <h5>Qlark Domous</h5>
                            <span>Health Advisor</span>
                            <img src="{{asset('home/assets/img/quotation-2.jpg')}}" alt="quotation-1" class="quotation-girl">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <div class="gap no-top">
        <div class="container">
            <div class="mockup">
                <h3>Register your pet with us and <span>Get 5% off</span> their next order</h3>
                <div class="mockup-img">
                    <img src="{{asset('home/assets/img/mockup.png')}}" alt="mockup">
                </div>
                <div class="mockup-text">
                    <p>We are your local dog home boarding service giving you complete</p>
                    <a href="#" class="button">Register Now</a>
                </div>
            </div>
    </div>
</div>
@endsection
