
<nav class="sidebar">
        <div class="logo d-flex justify-content-center">
            <a href=""><img src="{{Setting_key('logo')}}" alt=""></a>
            <div class="sidebar_close_icon d-lg-none">
                <i class="ti-close"></i>
            </div>
        </div>
        <ul id="sidebar_menu">
            <li class="">
                <a class="" href="/admin">
                    <img src="{{asset('adminlte/img/menu-icon/10.svg')}}" width="25px" alt>
                    <span>Tổng Quan</span>
                </a>

            </li>
            @canany(['slider-list','menu-list','setting-list'])
            <li class>
                <a class="has-arrow" href="#" aria-expanded="false">
                    <img src="{{asset('adminlte/img/menu-icon/13.svg')}}" width="19px" alt>
                    <span>Giao Diện</span>
                </a>
                <ul>
                    @can('slider-list')
                    <li><a class="{{route('admin.slider.index')}}" href="{{route('admin.slider.index')}}">Sliders</a></li>
                    @endcan
                    @can('menu-list')
                    <li><a class="" href="#">Menu</a></li>
                    @endcan
                    @can('setting-list')
                    <li><a class="" href="{{route('admin.setting.index')}}">Cài Đặt Chung</a></li>
                    @endcan

                </ul>
            </li>
            @endcanany

            @canany(['category-list','product-list','attribute-list'],['rating-list'],['rating-list'],['orderStatus-list'],['voucher-list'],['payment-list'],['inventory-list'])
            <li class>
                <a class="has-arrow" href="#" aria-expanded="false">
                    <img src="{{asset('adminlte/img/menu-icon/18.svg')}}" width="19px" alt>
                    <span>Bán Hàng</span>
                </a>
                <ul>
                    @can('category-list')
                    <li><a class="" href="{{route('admin.category.index')}}">Danh Mục Sản Phẩm</a></li>
                    @endcan
                    @can('attribute-list')
                    <li><a class="" href="{{route('admin.attribute.index')}}">Các Thuộc Tính</a></li>
                    @endcan
                    @can('order-list')
                    <li><a class="" href="{{route('admin.order.index')}}">Danh Sách Đơn Hàng</a></li>
                    @endcan
                    @can('payment-list')
                    <li><a class="" href="{{route('admin.payment.index')}}">Phương Thức Thanh Toán</a></li>
                    @endcan
                    @can('orderStatus-list')
                    <li><a class="" href="{{route('admin.orderStatus.index')}}">Trạng Thái Đơn Hàng</a></li>
                    @endcan
                    @can('product-list')
                    <li><a class="" href="{{route('admin.product.index')}}">Tất Cả Sản Phẩm</a></li>
                    @endcan
                    @can('ship-list')
                    <li><a class="" href="{{route('admin.product.index')}}">Phương Thức Vận Chuyển</a></li>
                    @endcan
                    @can('voucher-list')
                    <li><a class="" href="{{route('admin.voucher.index')}}">Mã Giảm Giá</a></li>
                    @endcan
                    @can(['inventory-list'])
                    <li><a class="" href="{{route('admin.inventory.index')}}">Kho Hàng</a></li>
                    @endcan
                    @can(['rating-list'])
                    <li><a class="" href="{{route('admin.rating.index')}}">Đánh Giá</a></li>
                    @endcan
                    @can(['flashSale-list'])
                    <li><a class="" href="{{route('admin.flashSale.index')}}">Flash Sale</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany

            @canany(['user-list'])
            <li class>
                <a class="has-arrow" href="#" aria-expanded="false">
                    <img src="{{asset('adminlte/img/menu-icon/12.svg')}}" width="23" alt>
                    <span>Người Dùng</span>
                </a>
                <ul>
                    @can('user-list')
                    <li><a class="" href="{{route('admin.user.index')}}">Tất Cả Người Dùng</a></li>
                    @endcan
                </ul>
            </li>

            @endcanany
            @canany(['role-list'],['permission-list'])
            <li class>
                <a class="has-arrow" href="#" aria-expanded="false">
                    <img src="{{asset('adminlte/img/menu-icon/9.svg')}}" width="19px" alt>
                    <span>Phân Quyền</span>
                </a>
                <ul>
                    @can('role-list')
                      <li><a class="" href="{{route('admin.role.index')}}">Vai Trò</a></li>
                    @endcan

                    @can('permission-list')
                     <li><a class="" href="{{route('admin.permission.index')}}">Tạo Quyền</a></li>
                    @endcan

                </ul>
            </li>
            @endcanany
            @canany(['infrastructureCity-list'],['infrastructureDistrict-list'],['infrastructureWard-list'])
            <li class>
                <a class="has-arrow" href="#" aria-expanded="false">
                    <img src="{{asset('adminlte/img/menu-icon/17.svg')}}" width="19px" alt>
                    <span>Tỉnh Thành</span>
                </a>
                <ul>
                    @can('infrastructureCity-list')
                      <li><a class="" href="{{route('admin.infrastructureCity.index')}}">Thành Phố</a></li>
                    @endcan
                    @can('infrastructureDistrict-list')
                     <li><a class="" href="{{route('admin.infrastructureDistrict.index')}}">Quận Huyện</a></li>
                    @endcan
                    @can('infrastructureWard-list')
                     <li><a class="" href="{{route('admin.infrastructureWard.index')}}">Phường Xã</a></li>
                    @endcan


                </ul>
            </li>
            @endcanany
            @canany(['revenue-list', 'saleStatistic-list'])
            <li class>
                <a class="has-arrow" href="#" aria-expanded="false">
                    <img src="{{asset('adminlte/img/menu-icon/11.svg')}}" width="19px" alt>
                    <span>Thông Kê</span>
                </a>
                <ul>
                    @can('revenue-list')
                        <li><a class="" href="{{route('admin.category.index')}}">Doanh Thu</a></li>

                    @endcan
                    @can('saleStatistic-list')
                        <li><a class="" href="{{route('admin.saleStatistic.index')}}">Bán Hàng</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany

            @canany(['media-list'])
            <li class>
                <a class="has-arrow" href="#" aria-expanded="false">
                    <img src="{{asset('adminlte/img/menu-icon/16.svg')}}" width="19px" alt>
                    <span>Media</span>
                </a>
                <ul>
                    @can('media-list')
                      <li><a class="" href="{{route('admin.media.index')}}">Quản Lý File</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany

            @canany(['seo-list'])
            <li class>
                <a class="has-arrow" href="#" aria-expanded="false">
                    <img src="{{asset('adminlte/img/menu-icon/8.svg')}}" width="19px"  alt>
                    <span>Cài Đặt</span>
                </a>
                <ul>
                    @can('seo-list')
                      <li><a class="" href="{{route('admin.seo.index')}}">Seo Website</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany

        </ul>
    </nav>
