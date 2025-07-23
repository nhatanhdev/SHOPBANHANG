<div class="container-fluid g-0">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="header_iner d-flex justify-content-between align-items-center">
                        <div class="sidebar_icon d-lg-none">
                            <i class="ti-menu"></i>
                        </div>
                        <div class="serach_field-area">
                            <div class="search_inner">
                                <div class="search_field">
                                    <input type="text" class="form-control" id="input_search_method" placeholder="Tìm kiếm..." list="result_search">
                                    <datalist id="result_search"></datalist>
                                </div>
                                    <button type="submit"> <img src="{{asset('adminlte/img/icon/icon_search.svg')}}" alt> </button>
                            </div>

                        </div>
                        <div class="header_right d-flex justify-content-between align-items-center">
                            <div class="header_notification_warp d-flex align-items-center">
                                <li>
                                    <a href="#"> <img src="{{asset('adminlte/img/icon/bell.svg')}}" alt> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="{{asset('adminlte/img/icon/msg.svg')}}" alt> </a>
                                </li>
                            </div>
                            <div class="profile_info">

                                <img src="{{  auth()->user()->avatar ? auth()->user()->avatar : asset('adminlte/img/profile.png') }}" alt="#">
                                <div class="profile_info_iner">
                                    <p>Welcome Admin!</p>
                                    <h5>{{ auth()->user()->name }}</h5>
                                    <div class="profile_info_details">
                                        <a href="#">My Profile <i class="ti-user"></i></a>
                                        <a href="#">Settings <i class="ti-settings"></i></a>
                                        <a href="{{ route('logout') }}">Log Out <i class="ti-shift-left"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
