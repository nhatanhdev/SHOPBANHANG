<link rel="stylesheet" type="text/css" href="{{asset('home/assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('home/assets/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('home/assets/css/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{asset('home/assets/css/slick.css')}}">
<link rel="stylesheet" href="{{asset('home/assets/css/slick-theme.css')}}">
<link rel="stylesheet" href="{{asset('home/assets/css/animate.min.css')}}">
<!-- nice-select -->
<link rel="stylesheet" href="{{asset('home/assets/css/nice-select.css')}}">
<!-- fancybox -->
<link rel="stylesheet" href="{{asset('home/assets/css/jquery.fancybox.min.css')}}">
<link rel="stylesheet" href="{{asset('home/assets/css/fontawesome.min.css')}}">
<!-- style -->
<link rel="stylesheet" href="{{asset('home/assets/css/style.css')}}">
<!-- responsive -->
<link rel="stylesheet" href="{{asset('home/assets/css/responsive.css')}}">
<!-- color -->
<link rel="stylesheet" href="{{asset('home/assets/css/color.css')}}">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<!-- jQuery -->
<script src="{{asset('home/assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('home/assets/js/preloader.js')}}"></script>
<style>
    #loading {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #fff;
    z-index: 999999;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    pointer-events: none;
}

@media (max-width: 1024px) {
    #loading img{
        width: 15%;
    }
}

@media (max-width: 768px) {
    #loading img{
        width: 20%;

    }
@media (max-width: 320px) {
    #loading img{
        width: 30%;
    }
}

</style>
<style>
    .popupcart {
    display: flex;
    justify-content: space-between;
    padding-bottom: 20px;
    }
    .popupcart i {
        position :unset
    }
    .item-cart{
        margin-top:10px;
        margin-left: 10px;
    }
    .cart-popup ul{
        height: 65vh;
        overflow: auto;
    }
    .cart-popup ul::-webkit-scrollbar {
    width: 12px; /* Width of the scrollbar */
}

.cart-popup ul::-webkit-scrollbar-track {
    background: #f1f1f1; /* Background of the scrollbar track */
}

.cart-popup ul::-webkit-scrollbar-thumb {
    background-color: #888; /* Color of the scrollbar thumb */
    border-radius: 10px; /* Roundness of the scrollbar thumb */
    border: 3px solid #f1f1f1; /* Space around the thumb */
}

.cart-popup ul::-webkit-scrollbar-thumb:hover {
    background: #555; /* Color of the scrollbar thumb on hover */
}
    *{
        font-family: Roboto;
    }

    .pd-main-img{
        min-width: 70%;
    }
    #NZoomImg {
        min-width: 100%;

    }

</style>
<style>
    .login-in {
        position: relative;
    }
    .login-in__sub {
        z-index: 1345346457;
    position: absolute;
    top: 35px;
    left: 0px;
    background-color: white;
    padding: 0 15px;
    min-width: 140px;
    display: none;
    }
    .login-in__sub a {
    text-transform: capitalize;
    display: block;
    font-size: 13px;
    color: #747474 !important;
    text-align: left;
    width: max-content;
    padding: 10px 0px;
    }
    .login-in__sub li {
        border-bottom: 1px solid #bbbbbb ;

    }
    .login-in__sub a:hover {
        color: red !important;
        padding-left: 5px;
    }

</style>

<style>
    #swal2-title {
        font-family: math;
    }
</style>
<script>
    setTimeout(function() {
        var loadingElement = document.getElementById('loading');
        if (loadingElement) {
            loadingElement.style.display = 'none';
        }
    }, 1000); // 2000 milliseconds = 2 seconds
</script>

@yield('css')

