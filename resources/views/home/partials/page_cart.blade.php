<div class="row">
    <form class="woocommerce-cart-form" action="" method="post">
      <div style="overflow-x:auto;overflow-y: hidden;">
        <table class="shop_table table-responsive">
              <thead>
                  <tr>
                      <th></th>
                      <th class="product-name">Sản Phẩm</th>
                      <th class="product-price">Giá</th>
                      <th class="product-quantity">Số lượng</th>
                      <th class="product-subtotal">Tổng</th>
                  </tr>
              </thead>
              @php
              $total = 0;
              if(!isset($carts)){
                  $carts = Get_cart();
              }
              @endphp
              <tbody>
                  @foreach ( $carts as $item )
                  <tr>
                      <td class="product-remove">
                          <a href="JavaScript:void(0)" onclick="removeCart({{$item->id}})"><i class="fa-solid fa-x"></i></a>
                      </td>
                      <td class="product-name">
                          <img alt="img" src="{{asset($item->image_path)}}">
                          <div>
                              <a href="#">{{$item->name}}</a>
                              <span>Phân Loại: 11F4278</span>

                          </div>
                      </td>
                      <td class="product-price">
                          <span class="woocommerce-Price-amount"><bdi><span class="woocommerce-Price-currencySymbol"></span>{{number_format($item->price)}} đ</bdi>
                          <del>{{$item->product->price_old ? number_format($item->product->price_old) . ' đ' : ''}}</del>
                          </span>
                      </td>
                      <td class="product-quantity">
                          <input type="number" class="input-text" id="quantity_{{$item->id}}" min="1" value="{{$item->quantity}}" onchange="updateCart({{$item->id}})">
                      </td>
                      <td class="product-subtotal">
                          <span class="woocommerce-Price-amount"><bdi><span class="woocommerce-Price-currencySymbol"></span>{{number_format($item->price * $item->quantity)}} đ</bdi></span>
                      </td>
                  </tr>
                  @php
                  $total += $item->price *$item->quantity;
                  @endphp
                  @endforeach

              </tbody>
        </table>
      </div>
          <div class="row mt-lg-5">
              <div class="col-lg-5">
                  <div class="coupon-area">
                      <h3>
                          Giảm giá
                      </h3>
                      <br>
                      <p>
                          Nhập mã coupon bên dưới để áp dụng
                      </p>
                      <div class="coupon">
                          <input type="text" class="voucher-code" name="coupon_code" class="input-text" placeholder="Mã giảm giá" value="{{ isset($code) ? $code : "" }}">
                          <div class="thongbao mb-3" style="color: red; font-size:14px; margin-left:32px"></div>
                          <button
                           type="submit" class="button btn-voucher" name="apply_coupon" onclick="apply_voucher(event)">Áp Dụng Phiếu Giảm Giá
                          </button>
                      </div>
                  </div>
              </div>
              <div class="col-lg-7">
                  <div class="cart_totals">
                      <h4>Tổng Thanh Toán</h4>
                      <table class="shop_table_responsive">
                          <tbody>
                              <tr class="cart-subtotal">
                                  <th>Tạm Tính:</th>
                                  <td>
                                      <span class="woocommerce-Price-amount text-lowercase">
                                      <bdi>
                                          <span class="woocommerce-Price-currencySymbol"></span>{{number_format($total)}} đ
                                      </bdi>
                                      </span>
                                  </td>
                              </tr>
                              <tr class="Shipping">
                                  <th>Phí Vận Chuyển:</th>
                                  <td>
                                      <span class="woocommerce-Price-amount amount">
                                          Miễn Phí
                                      </span>
                                   </td>
                              </tr>
                              <tr class="Voucher">
                                <th>Giảm Giá:</th>
                                <td>
                                    <span class="woocommerce-Price-amount amount text-lowercase">
                                         {{ isset($reduce) ? '-'. number_format($reduce) .' đ' : '--' }}
                                    </span>
                                 </td>
                            </tr>
                              <tr class="Total">
                                  <th>Tổng Cộng:</th>
                                  <td>
                                      <span class="woocommerce-Price-amount text-lowercase">
                                      <bdi>
                                          {{ isset($reduce) ? number_format($total - $reduce) : number_format($total)  }} <span>đ</span>
                                      </bdi>
                                      </span>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                  <div class="wc-proceed-to-checkout">
                          <a href="{{route('home.checkout')}}" class="button">Thanh Toán</a>
                  </div>
              </div>
          </div>
    </form>
  </div>
