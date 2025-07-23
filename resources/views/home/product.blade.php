@extends('layouts.home')
@section('title')
    <title>Sản Phẩm</title>
@endsection

@section('css')
    <style>
        /* .product-item__size {
                                                                    display: none;
                                                                }
                                                                .healthy-product-img:hover .product-item__size {
                                                                    display: block;
                                                                }

                                                                .product-item__sizeText {
                                                                display: block;
                                                                color: #1b1b1b;
                                                                font-size: 12px;
                                                                font-weight: 600;
                                                                line-height: 24px;
                                                                letter-spacing: 0.24px;
                                                                margin-bottom: 8px;
                                                            }

                                                            .product-item__sizeList {
                                                                display: -webkit-flex;
                                                                display: -ms-flexbox;
                                                                display: flex;
                                                                justify-content: center;
                                                                align-items: center;
                                                                flex-flow: row wrap;
                                                            }

                                                            .product-item__sizeBtn {
                                                                display: -webkit-flex;
                                                                display: -ms-flexbox;
                                                                display: flex;
                                                                justify-content: center;
                                                                align-items: center;
                                                                border-radius: 8px;
                                                                background: #fff;
                                                                border: 0;
                                                                min-width: 32px;
                                                                max-width: max-content;
                                                                text-align: left;
                                                                height: 32px;
                                                                padding: 10px 7px;
                                                                margin: 0 12px 12px 0;
                                                                color: #3a3a3a;
                                                                font-size: 14px;
                                                                font-weight: 500;
                                                                line-height: 24px;
                                                                letter-spacing: 0.28px;
                                                                transition: all 0.3s;
                                                            }

                                                            .product-item__sizeText {
                                                                display: block;
                                                                color: #1b1b1b;
                                                                font-size: 12px;
                                                                font-weight: 600;
                                                                line-height: 24px;
                                                                letter-spacing: 0.24px;
                                                                margin-bottom: 8px;
                                                            }

                                                            .product-item__sizeList {
                                                                display: -webkit-flex;
                                                                display: -ms-flexbox;
                                                                display: flex;
                                                                justify-content: center;
                                                                align-items: center;
                                                                flex-flow: row wrap;
                                                            }

                                                            .product-item__sizeBtn {
                                                                display: -webkit-flex;
                                                                display: -ms-flexbox;
                                                                display: flex;
                                                                justify-content: center;
                                                                align-items: center;
                                                                border-radius: 8px;
                                                                background: #fff;
                                                                border: 0;
                                                                min-width: 32px;
                                                                max-width: max-content;
                                                                text-align: left;
                                                                height: 32px;
                                                                padding: 10px 7px;
                                                                margin: 0 12px 12px 0;
                                                                color: #3a3a3a;
                                                                font-size: 14px;
                                                                font-weight: 500;
                                                                line-height: 24px;
                                                                letter-spacing: 0.28px;
                                                                transition: all 0.3s;
                                                            }  */
        .price-wrap {
            justify-content: space-between;
            align-items: center
        }

        .price-wrap .price-wrap-2,
        .price-wrap .price-wrap-1 {
            width: 48%;
            border: 1px solid #3a3a3a;
            padding: 8px;
        }

        .price-wrap .price-wrap-1 input,
        .price-wrap .price-wrap-2 input {
            width: 100% !important;
            text-align: center !important;
        }

        .button {
            padding: 10px 40px;
            border-radius: 10px;
        }



        .general-check {
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            align-items: center;
        }

        .general-check__tick {
            position: relative;
            min-width: 22px;
            width: 22px;
            height: 22px;
            margin-right: 12px;
            border: 2.8px solid #cdcdcd;
            border-radius: 4px;
            transition: all 0.1s;
        }

        .general-check__tick.special {
            border-color: #8cc63f;
        }

        .general-check__tick::before,
        .general-check__tick::after {
            position: absolute;
            content: "";
            transition: all 0.4s;
        }

        .general-check__tick::after {
            right: -4px;
            top: -9px;
            width: 7px;
            height: 18px;
            z-index: 9;
            transform: rotate(138deg);
            background-color: #ffffff;
        }

        .general-check__tick::before {
            display: none;
            z-index: 10;
            left: 1%;
            top: 51%;
            width: 18px;
            height: 7px;
            border-radius: 1px;
            border-right: 2.8px solid #8cc63f;
            border-top: 2.8px solid #8cc63f;
            transform: rotate(134deg) translate(-50%, 50%);
        }

        .general-check .tick-check {
            user-select: none;
            display: none;
        }

        .general-check .tick-check:checked~.general-check__tick {
            border-color: #8cc63f;
        }

        .general-check .tick-check:checked~.general-check__tick::before {
            display: block;
        }

        .general-check .tick-text {
            user-select: none;
        }

        .general-btn {
            width: 100%;
            color: #fff;
            font-size: 14px;
            text-align: center;
            padding: 10px 10px 9px;
            border: 0;
            border-radius: 10px;
            background-color: #f68b1f;
        }

        .sidebar-check {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px 21px;
        }

        .items-number .nice-select.Advice {
            /* border: 1px solid #3a3a3a;
                                                    border-radius: 2px; */
            width: 180px;
        }

        .current {
            display: flex;
            justify-content: left;
        }

        @media (max-width: 1024px) {
            .current {
                display: unset;
            }
        }
        .category.active{
            border-color: #fa441d;
        }
        .category.active span{
            background-color: #fa441d;
            color: #fff;
        }
    </style>
@endsection
@section('content')
    @include('home.partials.banner')

    <section class="gap products-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidebar">
                        <h3>Danh Mục</h3>
                        <div class="boder-bar"></div>
                        <ul class="category">

                            @foreach ($categories as $item)
                                <li class="category {{ ($slug) == $item->slug  ? 'active' : '' }}">
                                    <a href="{{route('home.product_slug',['slug'=>$item->slug])}}">{{ $item->name }}<span>{{ count_product_category($item->id) }}</span></a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="sidebar">
                        <h3>Bộ Lọc</h3>
                        <div class="boder-bar"></div>
                        <div class="wrapper">
                            <fieldset class="filter-price">
                                <div class="price-wrap">
                                    <div class="price-wrap-1">
                                        <input id="one">
                                    </div>
                                    <div class="price-wrap_line">-</div>
                                    <div class="price-wrap-2">
                                        <input id="two">
                                    </div>
                                </div>
                                <div class="price-field">
                                    <input type="range" min="0" max="50000000"
                                        value="{{ isset(request()->min) ? request()->min : 0 }}" id="lower">
                                    <input type="range" min="0" max="50000000"
                                        value="{{ isset(request()->max) ? request()->max : 50000000 }}" id="upper">
                                </div>
                                <button type="button" class="w-100 button" onclick="filterPrice()">Lọc</button>
                            </fieldset>
                        </div>
                    </div>

                    @foreach ($attributes as $item)
                        <div class="sidebar">
                            <h3>{{ $item->name }}</h3>
                            <div class="boder-bar"></div>
                            <ul class="sidebar-check">

                                @foreach (Get_attribute_home($item->id) as $item_chil)
                                    <li class="sidebar-check__item general-check">
                                        @php
                                            $name_paren = convert_vi_to_en($item->name);
                                            $get_name = $name_paren . 's';
                                        @endphp
                                        <input type="checkbox" name="{{ $name_paren }}"
                                            id="{{ $name_paren }}_{{ $item_chil->id }}" class="tick-check"
                                            value="{{ $item_chil->id }}"
                                            {{ in_array($item_chil->id, explode(',', request()->$get_name)) ? 'checked' : '' }}
                                            onchange="filter{{ $name_paren }}()">

                                        <label for="{{ $name_paren }}_{{ $item_chil->id }}"
                                            class="general-check__tick"></label>
                                        <label for="{{ $name_paren }}_{{ $item_chil->id }}"
                                            class="tick-text sidebar-nav__text">{{ $item_chil->name }}</label>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    @endforeach

                    <div class="sidebar">
                        <h3 style="font-size: 20px">SẢN PHẨM BÁN CHẠY</h3>
                        <div class="boder-bar"></div>
                        <ul class="top-products">
                            @foreach ($all_products as $key => $item)
                                @if ($key < 3)
                                    <li>
                                        <img src="{{ asset($item->feature_image) }}" width="83px" height="103px"
                                            alt="top-products">
                                        <div>
                                            <a href="{{ route('home.product_single', ['id' => $item->id]) }}">{{ $item->name }}</a>
                                            <span>{{ number_format($item->price) }} đ</span>
                                        </div>
                                    </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="items-number">
                        <p>
                            {{-- Hiển thị <strong>{{count($products)>9 ? 9 : count($products) }}</strong> trên <strong>{{ count($all_products) }}</strong>
                            kết quả --}}
                        </p>
                        <div class="d-flex align-items-center">
                            <p>Sắp xếp theo:</p>
                            <select class="nice-select Advice fitter_sapxep">
                                <option value="news" {{request()->orderby == 'news' ? 'selected' : ''}} >Mới Nhất</option>
                                <option value="hot" {{request()->orderby == 'hot' ? 'selected' : ''}} >Nổi Bật</option>
                                <option value="price_up" {{request()->orderby == 'price_up' ? 'selected' : ''}} >Giá tăng dần</option>
                                <option value="price_down" {{request()->orderby == 'price_down' ? 'selected' : ''}} >Giá giảm dần </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($products as $key => $item)
                            <div class="col-md-4 col-sm-6">
                                <div class="healthy-product">
                                    <div class="healthy-product-img">
                                        <a href="{{ route('home.product_single', ['id' => $item->id]) }}"><img
                                                src="{{ asset($item->feature_image) }}" height="270px" alt="food"></a>
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

                                        <div class="add-to-cart">
                                            {{-- <a href="#" class="btn btn-addtocard" data-url="{{route('cart.add',['id' => $item->id])}}" onclick="addToCart(event)">Add to Cart</a> --}}
                                            <a href="{{ route('home.product_single', ['id' => $item->id]) }}">Xem Chi
                                                Tiết</a>

                                            @if (auth()->check())
                                                @if (in_array($item->id, $arr_wishlist))
                                                    <a href="#" class="heart-wishlist"
                                                        onclick="addToWishList(event,{{ $item->id }})">
                                                        <i class="fa-regular fa-heart" style="color: red; font-weight: bold"
                                                            id="{{ $item->id }}"></i>
                                                    </a>
                                                @else
                                                    <a href="#" class="heart-wishlist"
                                                        onclick="addToWishList(event,{{ $item->id }})">
                                                        <i class="fa-regular fa-heart" id="{{ $item->id }}"></i>
                                                    </a>
                                                @endif
                                            @else
                                                <a href="#" class="heart-wishlist" onclick="Checklogin(event)">
                                                    <i class="fa-regular fa-heart"></i>
                                                </a>
                                            @endif

                                        </div>
                                        @if ($item->price_old)
                                            <h4>-{{ round((($item->price_old - $item->price) * 100) / $item->price_old, 0) }}%
                                            </h4>
                                        @endif
                                    </div>
                                    <span>{{ $item->category->name }}</span>
                                    <a
                                        href="{{ route('home.product_single', ['id' => $item->id]) }}">{{ $item->name }}</a>
                                    <h6><del>{{ $item->price_old ? number_format($item->price_old) . ' đ' : '' }}</del>{{ number_format($item->price) }}
                                        đ</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $products->links('home.partials.paginate') }}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
<script src="{{asset('home/assets/js/wrapper.js')}}"></script>

    <script>
        function addToCart(event) {
            url = $(event.target).data('url');
            event.preventDefault()
            $.ajax({
                url: url,
                type: 'GET',
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
                            title: "Something went wrong"
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
        function addToWishList(event, id) {
            event.preventDefault()
            $.ajax({
                url: "{{ route('wishlist.add', ['id' => ':id']) }}".replace(':id', id),
                type: 'GET',
                beforeSend: function() {
                    $('#loading').show();

                },
                success: function(data) {
                    if (data.status == 200) {
                        $('.fa-heart#' + id).css({
                            'color': 'red',
                            'font-weight': 'bold'
                        });

                        Toast.fire({
                            icon: "success",
                            title: data.message
                        });
                    } else if (data.status == 201) {
                        $('.fa-heart#' + id).css({
                            'color': 'black',
                            'font-weight': '100'
                        });
                        Toast.fire({
                            icon: "success",
                            title: data.message
                        });
                    } else {
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
        function Checklogin(event) {
            event.preventDefault();
            Toast.fire({
            icon: "error",
            title: "Error",
            text: "Vui Lòng Login để sử dụng chức năng"
            });
        }
    </script>
    <script>

    function filterPrice() {
        var price_min = $('#one').val().replace(/[^0-9]/g, '');
        var price_max = $('#two').val().replace(/[^0-9]/g, '');
        const searchParams = new URLSearchParams(window.location.search);
        searchParams.set("min", price_min);
        searchParams.set("max", price_max);
        window.location.search = decodeURIComponent(searchParams.toString());
    }

    </script>
    <script>
        const list_names = @json($list); // Assuming $list is already a JSON-encoded array
        list_names.forEach(name => {
            var names = `${name}s`; // Create plural form of the name
            const functionName = `filter${name}`;
            window[functionName] = function() {
                let checkedValue = [];
                $(`input[name="${name}"]:checked`).each(function() {
                    checkedValue.push($(this).val());
                });

                const searchParams = new URLSearchParams(window.location.search);
                searchParams.set(names, checkedValue.join(',')); // Set the parameter with comma-separated values
                window.location.search = decodeURIComponent(searchParams.toString());
            };
        });
    </script>

    <script>
        $('.fitter_sapxep').on('change', function(){
            const searchParams = new URLSearchParams(window.location.search);
            searchParams.set("orderby", $(this).val());
            window.location.search = decodeURIComponent(searchParams.toString());
        })
    </script>
@endsection
