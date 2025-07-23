<footer class="three no-top" style="background-color: #f5f5f5; background-image:url({{asset('home/assets/img/background-3.jpg')}})">
    <div class="container">
        <div class="provide-footer">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="footer-provide">
                        <div>
                            <img src="{{asset('home/assets/img/provide-icon-1.png')}}" alt="icon">
                            <a href="#">Bảo Hiểm Đầy Đủ</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="footer-provide">
                        <div>
                            <img src="{{asset('home/assets/img/provide-icon-2.png')}}" alt="icon">
                            <a href="#">Miễn Phí Vận CHuyển</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="footer-provide">
                        <div>
                            <img src="{{asset('home/assets/img/provide-icon-3.png')}}" alt="icon">
                            <a href="#"> Được Đào Tạo Tốt</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="footer-provide">
                        <div>
                            <img src="{{asset('home/assets/img/provide-icon-4.png')}}" alt="icon">
                            <a href="#">Người Chủ Đích Thức </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="footer-provide">
                        <div>
                            <img src="{{asset('home/assets/img/provide-icon-5.png')}}" alt="icon">
                            <a href="#">Nhận Nuôi Thú Cưng</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="footer-provide">
                        <div>
                            <img src="{{asset('home/assets/img/provide-icon-6.png')}}" alt="icon">
                            <a href="#">Thức Ăn Chất Lượng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="widget-title p-0">
                  <h3>Danh Mục Sản Phẩm</h3>
                  <div class="boder"></div>
                    <ul>
                        @foreach ( Get_category(0) as $key => $item )
                            @if ($key > 5)
                                @break
                            @endif
                            <li><i class="fa-solid fa-angle-right"></i><a href="javascript:void(0)">{{$item->name}}</a></li>

                        @endforeach

                    </ul>
                  </div>
            </div>
            <div class="col-xl-5 col-lg-3 col-md-6">
                <div class="logo">
                    <a href="index-2.html">
                        <img src="{{asset('home/assets/img/logo-icon.png')}}" alt="logo">
                    </a>
                    <p>At vero eos et accusam justo duo dolo res et ea rebum. Stet clita kasd guber gren. Aenean sollici tudin lorem qsben elit clita.</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="widget-title">
                  <h3>Liên Hệ</h3>
                  <div class="boder"></div>
                    <div class="phone">
                          <i>
                            <svg height="112" viewBox="0 0 24 24" width="112" xmlns="http://www.w3.org/2000/svg"><g clip-rule="evenodd" fill="rgb(255255,255)" fill-rule="evenodd"><path d="m7 2.75c-.41421 0-.75.33579-.75.75v17c0 .4142.33579.75.75.75h10c.4142 0 .75-.3358.75-.75v-17c0-.41421-.3358-.75-.75-.75zm-2.25.75c0-1.24264 1.00736-2.25 2.25-2.25h10c1.2426 0 2.25 1.00736 2.25 2.25v17c0 1.2426-1.0074 2.25-2.25 2.25h-10c-1.24264 0-2.25-1.0074-2.25-2.25z"></path><path d="m10.25 5c0-.41421.3358-.75.75-.75h2c.4142 0 .75.33579.75.75s-.3358.75-.75.75h-2c-.4142 0-.75-.33579-.75-.75z"></path><path d="m9.25 19c0-.4142.33579-.75.75-.75h4c.4142 0 .75.3358.75.75s-.3358.75-.75.75h-4c-.41421 0-.75-.3358-.75-.75z"></path></g></svg>
                          </i><a href="callto:+02101283492">+{{Setting_key('phone')}}</a>
                    </div>
                    <div class="phone">
                        <div>
                          <i>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <path d="M0,81v350h512V81H0z M456.952,111L256,286.104L55.047,111H456.952z M30,128.967l134.031,116.789L30,379.787V128.967z
                               M51.213,401l135.489-135.489L256,325.896l69.298-60.384L460.787,401H51.213z M482,379.788L347.969,245.756L482,128.967V379.788z"></path>
                            </svg>
                          </i>
                        </div><a href="mallto:username@domain.com">{{Setting_key('email')}}</a>
                    </div>
                        <div class="phone d-flax align-items-center">
                          <i>
                              <svg version="1.1" xml:space="preserve" width="682.66669" height="682.66669" viewBox="0 0 682.66669 682.66669" xmlns="http://www.w3.org/2000/svg"><clipPath clipPathUnits="userSpaceOnUse"><path d="M 0,512 H 512 V 0 H 0 Z"></path></clipPath><g transform="matrix(1.3333333,0,0,-1.3333333,0,682.66667)"><g><g clip-path="url(#clipPath2333)"><g transform="translate(256,92)"><path d="m 0,0 c -126.964,143.662 -160,165.23 -160,240 0,88.366 71.634,160 160,160 88.365,0 160,-71.634 160,-160 C 160,165.854 130.212,147.337 0,0 Z" style="fill:none;stroke:#000;stroke-width:40;stroke-linecap:square;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"></path></g><g transform="translate(316,372)"><path d="m 0,0 -80,-80 -40,40" style="fill:none;stroke:#000;stroke-width:40;stroke-linecap:square;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"></path></g></g></g></g>
                              </svg>
                          </i>
                            <div>
                          <p>{{Setting_key('address')}}</p>
                          <a href="#" class="get">Get Direction</a>
                          </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyrighttwo">
        <div class="container">
            <div class="copyright">
                <p>Patte Chăm Sóc Thú Cưng - Copyright 2024. Design by Nhật Anh</p>
                <a href="#"><img src="{{asset('home/assets/img/visa.jpg')}}" alt="cad"></a>
            </div>
        </div>
    </div>
</footer>
