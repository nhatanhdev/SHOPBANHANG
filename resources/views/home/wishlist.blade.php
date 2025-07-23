@extends('layouts.home')
@section('title')
<title>Sản Phẩm</title>
@endsection
@section('content')

@include('home.partials.banner')

<section class="gap products-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
            @if(count($products)>0)
            @foreach ($products as $item )
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="healthy-product">
                        <div class="healthy-product-img">
                           <a href="{{route('home.product_single',['id' => $item->products->id])}}"><img src="{{asset($item->products->feature_image)}}" alt="food"></a>
                            <ul class="star">
                                @php
                                    $rate_avg = rate_single_product($item->products->id);
                                @endphp
                                @for ($i = 1; $i <= $rate_avg; $i++)
                                    <li><i class="fa-solid fa-star"></i></li>
                                @endfor
                                @for ($k = 1; $k <= 5 - $rate_avg; $k++)
                                    <li><i class="fa-regular fa-star"></i></li>
                                @endfor
                            </ul>
                            <div class="add-to-cart">
                                <a href="{{ route('home.product_single', ['id' => $item->products->id]) }}">Xem Chi
                                    Tiết</a>
                                    @if (auth()->check())
                                    @if (in_array($item->products->id, $arr_wishlist))
                                        <a href="#" class="heart-wishlist"
                                            onclick="addToWishList(event,{{ $item->products->id }})">
                                            <i class="fa-regular fa-heart" style="color: red; font-weight: bold"
                                                id="{{ $item->products->id }}"></i>
                                        </a>
                                    @else
                                        <a href="#" class="heart-wishlist"
                                            onclick="addToWishList(event,{{ $item->products->id }})">
                                            <i class="fa-regular fa-heart" id="{{ $item->products->id }}"></i>
                                        </a>
                                    @endif
                                @else
                                    <a href="#" class="heart-wishlist" onclick="Checklogin(event)">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                @endif
                            </div>
                            @if($item->products->price_old)
                            <h4>-{{round((($item->products->price_old - $item->products->price))*100  /($item->products->price_old),0) }}%</h4>
                            @endif
                        </div>
                        <span>{{$item->products->category->name}}</span>
                        <a href="{{route('home.product_single',['id' => $item->products->id])}}">{{$item->products->name}}</a>
                        <h6><del>{{$item->products->price_old ? number_format($item->products->price_old) . ' đ' : '' }}</del>{{number_format($item->products->price)}} đ</h6>
                    </div>
                </div>
            @endforeach
            @else
            <p class="text-warning">Bạn Chưa Có Sản Phẩm Yêu Thích Nào!</p>
            @endif
        </div>
            {{ $products->links('home.partials.paginate') }}
      </div>
    </div>
  </div>
</section>
@endsection
@section('js')
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
                    if (data.status == 201) {
                        window.location.reload();

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

@endsection

