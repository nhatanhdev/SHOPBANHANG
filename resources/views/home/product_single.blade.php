@extends('layouts.home')
@section('title')
    <title>Chi tiết sản phẩm</title>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('adminlte/css/rate.css')}}">

    <style>
        .list__attr {
            margin-top: 20px;
        }

        .detail-sidebar__text {
            color: #3a3a3a;
            font-size: 18px;
            font-weight: 600;
            line-height: 24px;
            letter-spacing: 0.72px;
            margin-bottom: 16px;
        }

        .detail-sidebar__btn {
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            align-items: center;
            margin-bottom: 0;
            flex-flow: row wrap;
        }

        .detail-sidebar__btn>button {
            width: auto;
        }

        .detail-sidebar__btn>button,
        .detail-sidebar__btn>a {
            color: #000000;
            font-size: 16px;
            font-weight: 700;
            line-height: 24px;
            letter-spacing: 0.48px;
            padding: 0 8px;
            background-color: transparent;
            border-radius: 50px;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
            align-items: center;
            min-width: 52px;
            height: 52px;
            border: 1px solid rgba(58, 58, 58, 0.1);
            box-shadow: 0px 8px 16px 0px rgba(96, 97, 112, 0.02), 0px 2px 4px 0px rgba(40, 41, 61, 0.04);
            margin: 0 16px 16px 0;
        }

        .detail-sidebar__btn>button:hover,
        .detail-sidebar__btn>button.active,
        .detail-sidebar__btn>a:hover,
        .detail-sidebar__btn>a.active {
            color: #fff;
            border: 3px solid #fff;
            background-color: #fa441d;
            box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.1) inset, 0px 4px 4px 0px rgba(0, 0, 0, 0.15);
        }
        ul.reviews li .star i {
            color: #ff6f14;
        }
    </style>
@endsection
@section('content')

    @include('home.partials.banner')

    <section class="gap no-bottom">
        <div class="container">
            <div class="row product-info-section">
                <div class="col-lg-7 p-0">
                    <div class="pd-gallery">
                        @if (count($productImages) > 0)
                            <ul class="pd-imgs">
                                @foreach ($productImages as $key => $image)
                                    <li class="li-pd-imgs {{ $key == 0 ? 'nav-active' : '' }}">
                                        <a href="JavaScript:void(0)">
                                            <img alt="toys" src="{{ asset($image->image_path) }}">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="pd-main-img">
                            <img id="NZoomImg" alt="toys" src="{{ asset($product->feature_image) }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="product-info p-60">
                        <div class="d-flex align-items-center">
                            <div class="start d-flex align-items-center">
                                @for($i = 1; $i <= $rate_avg; $i++)
                                <i class="fa-solid fa-star"></i>
                                @endfor
                                @for($k = 1; $k <= 5-$rate_avg; $k++)
                                <i class="fa-regular fa-star"></i>
                                @endfor
                            </div>
                            <span>{{($count_rate)}} Đánh Giá</span>
                        </div>
                        <h3>{{ $product->name }}</h3>
                        <div class="variations_form">
                            <div class="stock">
                                <span class="price">
                                    <del>
                                        <span class="woocommerce-Price-amount">
                                            <bdi>
                                                <span
                                                    class="woocommerce-Price-currencySymbol"></span>{{ $product->price_old ? number_format($product->price_old) . ' đ' : '' }}</bdi>
                                        </span>
                                    </del>
                                    <ins>
                                        <span class="woocommerce-Price-amount amount">
                                            <bdi>
                                                <span
                                                    class="woocommerce-Price-currencySymbol"></span>{{ number_format($product->price) }}
                                                đ</bdi>
                                        </span>
                                    </ins>
                                </span>
                                <h6
                                    class="{{ $product->inventories->quantity + total_quantity($product->id) > 0 ? 'available' : 'unavailable' }}">
                                    <span>
                                        {!! $product->inventories->quantity + total_quantity($product->id) > 0
                                            ? 'Còn <strong>' . ($product->inventories->quantity + total_quantity($product->id)) . '</strong> sản phẩm'
                                            : 'Hết hàng' !!}
                                    </span>
                                </h6>
                            </div>
                            @if (count($variants) > 0)
                                <div class="list__attr">
                                    @if (isset($parent_ids))
                                        @foreach ($parent_ids as $parent)
                                            <p class="detail-sidebar__text">{{ Get_attribute_parent($parent)->name }} :</p>
                                            <div class="detail-sidebar__btn {{ Get_attribute_parent($parent)->name }}">
                                                @foreach ($chil_ids as $chil)
                                                    @php
                                                        $childAttribute = Get_attribute_parent($chil, $parent);
                                                    @endphp
                                                    @if ($childAttribute)
                                                        <button class="product-item__btn item{{ $childAttribute->id }}"
                                                            data-id="{{ $childAttribute->id }}"
                                                            onclick="chooseValue({{ $product->id }},this)">

                                                            {{ $childAttribute->name }}
                                                        </button>
                                                    @endif
                                                @endforeach

                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            @endif
                            <div class="quantity">
                                <h6>Số Lượng</h6>
                                <input type="number" class="input-text" min="1" name="quantity" value="1">
                            </div>
                            <div class="add-to-cart">
                                <a href="#" class="button" onclick="addToCart(event,{{ $product->id }} )">Add to Cart </a>

                                    @if(auth()->check())
                                    @if(in_array($product->id,$arr_wishlist))
                                        <a href="#" class="heart-wishlist" onclick="addToWishList(event,{{ $product->id }})">
                                            <i class="fa-regular fa-heart" style="color: red; font-weight: bold" id="{{ $product->id }}"></i>
                                        </a>
                                    @else
                                        <a href="#" class="heart-wishlist" onclick="addToWishList(event,{{ $product->id }})">
                                            <i class="fa-regular fa-heart" id="{{ $product->id }}"></i>
                                        </a>
                                    @endif

                                @else
                                <a href="#" class="heart-wishlist" onclick="Checklogin(event)">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                                @endif
                            </div>
                            <ul class="product_meta">
                                <li><span class="theme-bg-clr">Danh Mục:</span>
                                    <ul class="pd-cat">
                                        <li>
                                            <a href="#">{{$product->category->name}}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><span class="theme-bg-clr">Tags:</span>
                                    <ul class="pd-tag">
                                        <li>
                                            @foreach ( $tags as $item )
                                            <a href="#">{{$item}}</a>,
                                            @endforeach

                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="gap">
        <div class="container">
            <div class="information">
                <h3>Mô Tả</h3>
                <div class="boder-bar"></div>
                {!! $product->description !!}
            </div>
            <div class="row mt-5">
                <div class="col-lg-7">
                    <div class="information">
                        <h3>Thông Tin Chi Tiết</h3>
                        <div class="boder-bar"></div>
                        <p>Lorem ipsum dolor sit amet,consectetur adipiscing elit do eiusmosed do eiusmod teincididunt ut la
                            amet,consectetur adipiscing elib incididunt ut labore et.Lorem ipsumsit amet, consec</p>
                        <div class="row mt-md-5">
                            <div class="col-lg-6 col-md-6">
                                <div class="pet-grooming">
                                    <i><img src="{{ asset('home/assets/img/welcome-to-1.png') }}" alt="icon"></i>
                                    <svg width="138" height="138" viewBox="0 0 673 673"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z"
                                            fill="#940c69"></path>
                                    </svg>
                                    <a href="#">
                                        <h4>Pet Grooming</h4>
                                    </a>
                                    <p>Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiu incididunt ut labore et.
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="pet-grooming">
                                    <i><img src="{{ asset('home/assets/img/welcome-to-2.png') }}" alt="icon"></i>
                                    <svg width="138" height="138" viewBox="0 0 673 673"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z"
                                            fill="#940c69"></path>
                                    </svg>
                                    <a href="#">
                                        <h4>Dog Walking</h4>
                                    </a>
                                    <p>Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiu incididunt ut labore et.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="looking video position-relative">
                        <svg class="golo" width="510" height="510" viewBox="0 0 673 673"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z"
                                fill="#000" />
                        </svg>
                        <a data-fancybox="" href="https://www.youtube.com/watch?v=rQ_agtEFI5E">
                            <i>
                                <svg width="11" height="17" viewBox="0 0 11 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 8.49951L0.5 0.27227L0.5 16.7268L11 8.49951Z" fill="#000"></path>
                                </svg>
                            </i>
                        </a>
                        <img src="{{ asset('home/assets/img/dog-video-1.jpg') }}" alt="img">
                    </div>
                </div>
            </div>
            <div class="information mt-70">
                <h3>Thông Tin Dinh Dưỡng</h3>
                <div class="boder-bar"></div>
                <ul class="specification">
                    <li>
                        <h6>Vitamin E</h6>100 IU/kg
                    </li>
                    <li>
                        <h6>Glucosamine</h6>350 mg/kg*
                    </li>
                    <li>
                        <h6>Crude Protein</h6>21.0%
                    </li>
                    <li>
                        <h6>Moisture </h6>12.0%
                    </li>
                </ul>
            </div>
            <div class="information mt-70">
                <h3>Hướng Dẫn Cho Ăn</h3>
                <div class="boder-bar"></div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Cân Nặng Của Chó</th>
                                <th scope="col">Cốc Mỗi Ngày</th>
                                <th scope="col">Trộn Với Túi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="noBorder">Up to 10 lb</td>
                                <td class="noBorder">1 to 2</td>
                                <td class="noBorder">3.5 oz of PEDIGREE® Pouch</td>
                            </tr>
                            <tr>
                                <td class="noBorder">10 to 25</td>
                                <td class="noBorder">2 to 3</td>
                                <td class="noBorder">3.5 oz of PEDIGREE</td>
                            </tr>
                            <tr>
                                <td class="noBorder">50 to 75</td>
                                <td class="noBorder">1 to 2</td>
                                <td class="noBorder"></td>
                            </tr>
                            <tr>
                                <td class="noBorder">75 to 150</td>
                                <td class="noBorder">2 to 3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-70">
                <div class="col-lg-{{ $check_rated == 0 ? '7' : '12'}}">
                    <div class="information ">
                        <h3>Đánh Giá</h3>
                        <div class="boder-bar"></div>
                    </div>
                    <ul class="reviews">
                        @if(count($rates)>0)
                        @foreach ( $rates as $val )
                        <li>
                            <div style="width:100px">
                                <img alt="img" src="{{ asset($val->user->avatar ?? 'default-avatar.png') }}" width="85%" >
                                <div class="star">
                                    @for($i = 1; $i <= $val->rate; $i++)
                                    <i class="fa-solid fa-star"></i>
                                    @endfor
                                    @for($k = 1; $k <= 5-$val->rate; $k++)
                                    <i class="fa-regular fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center">
                                    <h4>{{$val->user->name}}</h4>
                                    <span>{{$val->created_at}}</span>
                                </div>
                                <p>{{$val->content}}</p>
                            </div>
                        </li>
                        @endforeach
                        @else
                        <h6 class="text-warning text-center">Chưa Có Đánh Giá Nào!</h6>
                        @endif

                    </ul>
                    {{ $rates->links('home.partials.paginate') }}

                </div>
                @if($check_rated == 0)
                <div class="col-lg-5">
                    <form class="add-review comment leave-comment" action="{{route('home.add_rate')}}" method="POST">
                        @csrf
                        <div class="information">
                            <h3> Để Lại Đánh Giá Của Bạn</h3>
                            <div class="boder-bar"></div>
                            <div class="d-flex align-items-center mb-4">
                                <span>Chọn Xếp Hạng:</span>
                                <div class="rate rate_nhatanh">
                                        <input type="radio" id="star5" name="rate" value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rate" value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rate" value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rate" value="2" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rate" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <textarea placeholder="Nội Dung" name="content"></textarea>
                        <button  type="submit" class="button"> Thêm Đánh Giá </button>
                    </form>
                </div>
                @endif

            </div>
        </div>
    </section>
    <section class="gap no-top products-section">
        <div class="container">
            <div class="information">
                <h3>Sản Phẩm Liên Quan</h3>
                <div class="boder-bar"></div>
            </div>
            <div class="row">
               @foreach ( $product_related as $item )
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="healthy-product mb-0">
                            <div class="healthy-product-img">
                                <img src="{{ asset($item->feature_image) }}" alt="food">
                                <ul class="star">
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                </ul>
                                <div class="add-to-cart">
                                    <a href="{{route('home.product_single',['id' => $item->id])}}">Xem Chi Tiết</a>
                                    @if(auth()->check())
                                    @if(in_array($item->id,$arr_wishlist))
                                        <a href="#" class="heart-wishlist" onclick="addToWishList(event,{{ $item->id }})">
                                            <i class="fa-regular fa-heart" style="color: red; font-weight: bold" id="{{ $item->id }}"></i>
                                        </a>
                                    @else
                                        <a href="#" class="heart-wishlist" onclick="addToWishList(event,{{ $item->id }})">
                                            <i class="fa-regular fa-heart" id="{{ $item->id }}"></i>
                                        </a>
                                    @endif

                                @else
                                <a href="#" class="heart-wishlist" onclick="Checklogin(event)">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                                @endif
                                </div>
                                @if($item->price_old)
                                <h4>-{{round((($item->price_old - $item->price))*100  /($item->price_old),0) }}%</h4>
                                @endif                            </div>
                                <span>{{$item->category->name}}</span>
                                <a href="{{route('home.product_single',['id' => $item->id])}}">{{$item->name}}</a>
                                <h6><del>{{$item->price_old ? number_format($item->price_old) . ' đ' : '' }}</del>{{number_format($item->price)}} đ</h6>
                            </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var stock = $('.available span strong').text();
            if (!parseInt(stock) > 0) {
                $('.add-to-cart .button').css({
                    "pointer-events": "none",
                    "opacity": "0.5"
                });
                return false;

            }
        })
    </script>
    <script>
        function addToCart(event, id) {
            event.preventDefault()
            var quantity = $('.quantity .input-text').val();
            var stock = $('.available span strong').text();
            var check = 0;
            var variantIds = [];
            if ($('.list__attr').length > 0) {
                $('.detail-sidebar__btn .active').each(function() {
                    var dataId = $(this).data('id');
                    variantIds.push(dataId);
                });
                if (variantIds.length > 0 && variantIds.length == $('.list__attr .detail-sidebar__btn').length) {
                    check = 1;

                } else {
                    check = 0;
                }
            } else {
                check = 1;
            }
            if (check == 0) {
                Toast.fire({
                    icon: "error",
                    title: "Vui Lòng Chọn Thuộc Tính"
                });
                return false;
            }
            // console.log(variantIds);
            // Output: [value1, value2, value3, ...]

            if (!parseInt(stock) > 0) {
                $('.add-to-cart .button').css({
                    "pointer-events": "none",
                    "opacity": "0.5"
                });
                Toast.fire({
                    icon: "error",
                    title: "Sản Phẩm Đã Hết Hàng"
                });
                return false;

            }

            if (parseInt(quantity) > parseInt(stock)) {
                Toast.fire({
                    icon: "error",
                    title: "Mặt Hàng Không Đủ"
                });
                return false;
            }

            $.ajax({
                url: "{{ route('cart.add', ['id' => ':id']) }}".replace(':id', id),
                type: 'GET',
                data: {
                    arr: variantIds,
                    quantity: quantity
                },
                beforeSend: function() {
                    $('#loading').show();

                },
                success: function(data) {
                    if (data.status == true) {
                        $('.mini_cart').html(data.mini_cart);
                        $('.donation').attr('count-cart', String(data.quantity_cart))
                        // $('.shop-cart').html(data.cart_page);
                        Toast.fire({
                            icon: "success",
                            title: data.message
                        });
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: data.message
                        });

                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Something went wrong"
                    });
                },
                complete: function() {
                    setTimeout(function() {
                        $('#loading').hide();
                    }, 500); // 2000 milliseconds = 2 seconds
                },
            });
        }
    </script>

    <script>
        function chooseValue(product_id, element) {
            var parentDiv = $(element).closest(".detail-sidebar__btn");
            parentDiv.find("button").removeClass("active");
            var defaul_quantity = $('.available strong').text()
            console.log(defaul_quantity)
            $(element).addClass("active");
            var check = 0;
            var variantIds = [];
            if ($('.list__attr').length > 0) {
                $('.detail-sidebar__btn .active').each(function() {
                    var dataId = $(this).data('id');
                    variantIds.push(dataId);
                });
                if (variantIds.length > 0 && variantIds.length == $('.list__attr .detail-sidebar__btn').length) {
                    check = 1;

                } else {
                    check = 0;
                }
            } else {
                check = 1;
            }
            if (check == 1) {
                $.ajax({
                        url: "{{ route('home.variant_check') }}",
                        type: 'POST',
                        data: {
                            variantIds: variantIds,
                            product_id: product_id,
                        },
                        beforeSend: function() {
                            $('#loading').show();

                        },
                        success: function(data) {
                            if (data.status == true) {
                                $('.available strong').html(data.quantity);
                                if (parseInt(data.quantity) > 0) {
                                    $('.add-to-cart .button').css({
                                        "pointer-events": "unset",
                                        "opacity": "1"
                                    });
                                }
                                    else {
                                        $('.add-to-cart .button').css({
                                            "pointer-events": "none",
                                            "opacity": "0.5"
                                        });
                                    }
                                } else {
                                    $('.available strong').html(defaul_quantity);

                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                    Toast.fire({
                                        icon: "error",
                                        title: "Error",
                                        text: "Something went wrong"
                                    });
                                },
                                complete: function() {
                                    setTimeout(function() {
                                        $('#loading').hide();
                                    }, 500); // 2000 milliseconds = 2 seconds
                                },
                        })
                }

            }
    </script>
 <script>
    function addToWishList(event,id){
        event.preventDefault()
        $.ajax({
            url: "{{route('wishlist.add',['id' => ':id'])}}".replace(':id', id),
            type: 'GET',
            beforeSend: function () {
                $('#loading').show();

            },
            success:function(data){
                if(data.status == 200){
                    $('.fa-heart#'+id).css({
                        'color': 'red',
                        'font-weight': 'bold'
                    });

                    Toast.fire({
                        icon: "success",
                        title: data.message
                        });
                }
                else if(data.status == 201){
                    $('.fa-heart#'+id).css({
                        'color': 'black',
                        'font-weight': '100'
                    });
                    Toast.fire({
                        icon: "success",
                        title: data.message
                        });
                }
                else{
                    Toast.fire({
                        icon: "error",
                        title: "Xảy ra lỗi"
                        });

                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Toast.fire({
                    icon: "error",
                    title: "Error",
                    text: "Something went wrong"
                });
            },
            complete: function() {
                setTimeout(function() {
                    $('#loading').hide();
                }, 500); // 2000 milliseconds = 2 seconds
            },
        });
    }
</script>

<script>
    function Checklogin(event){
        event.preventDefault();
        Toast.fire({
            icon: "error",
            title: "Error",
            text: "Vui Lòng Login để sử dụng chức năng"
        });
    }
</script>

@endsection
