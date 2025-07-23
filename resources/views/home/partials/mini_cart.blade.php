<div class="white_content">
    @php
    $total = 0;
    if(!isset($carts)){
        $carts = Get_cart();
    }
    @endphp
    <div class="popupcart">
    <h6>GIỎ HÀNG ( <?php  echo count($carts); ?>  ) </h6>
    <a href="javascript:;" class="textright" id="close"
        ><i class="fa-regular fa-circle-xmark"></i>
    </a>
    </div>
    @if(count($carts)>0)
        <div class="cart-popup">
                <ul>
                @foreach ( $carts as  $item)
                    <li class="d-flex align-items-center position-relative item-cart">
                        <div class="p-img light-bg">
                            <img
                                src="{{asset($item->image_path)}}"
                                alt="Product Image"
                            />
                        </div>
                        <div class="p-data text-uppercase">
                            <h3 class="font-semi-bold fw-bold">{{$item->name}}</h3>
                            <p class="theme-clr font-semi-bold">Phân Loại: <strong style="text-transform: none;">( {{Get_attribute_name($item->attribute) ? Get_attribute_name($item->attribute) : 'Không'}} )</strong></p>
                            <p class="theme-clr font-semi-bold">Số Lượng: <strong>{{$item->quantity}}</strong></p>
                            <p class="theme-clr font-semi-bold">Giá:  <strong style="text-transform: none;">{{number_format($item->price)}} <span>đ</span></strong></p>

                        </div>
                        <a href="JavaScript:void(0)" id="crosss" onclick="removeCart({{$item->id}})"></a>
                    </li>
                    @php
                        $total += $item->price *$item->quantity;
                    @endphp
                @endforeach


            </ul>

            <div
                class="cart-total d-flex align-items-center justify-content-between"
            >
                <span class="font-semi-bold">TỔNG CỘNG:</span>

                <span class="font-semi-bold">{{number_format($total)}} đ</span>
            </div>

            <div
                class="cart-btns d-flex align-items-center justify-content-between"
            >
                <a class="font-bold" href="{{route('cart.index')}}">Xem Giỏ Hàng</a>
                <a
                    class="font-bold theme-bg-clr text-white checkout"
                    href="{{ route('home.checkout') }}"
                    >Thanh Toán</a
                >
            </div>

        </div>
    @else

        <h3 class="text-center text-warning">GIỎ HÀNG TRỐNG !</h3>
    @endif
</div>
<script>
    $("#close").on('click',function(){
        $(".white_content").animate({
            opacity: 0,
            width:0,
            right : -1000
        });
    });
        $("#show").on('click',function(){
        $(".white_content").animate({
            opacity: 1,
            right :0
        });
        });

</script>
