<script src="{{asset('home/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('home/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('home/assets/js/slick.min.js')}}"></script>
<script src="{{asset('home/assets/js/jquery.nice-select.min.js')}}"></script>
<!-- fancybox -->
<script src="{{asset('home/assets/js/jquery.fancybox.min.js')}}"></script>

<script src="{{asset('home/assets/js/custom.js')}}"></script>
<script src="{{asset('adminlte/js/sweetalert2@11.js')}}"></script>

<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

<script>
    $(document).ready(function(){
        $('.donation').attr('count-cart','@json(count(Get_cart()))')
    })
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        @endif
        @if(session('error'))
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        @endif
    });
</script>
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});
</script>


<script>
    function removeCart(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText:'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : '{{route('cart.remove')}}',
                    data : {
                        'id' : id,
                    },
                    type: 'POST',
                    beforeSend: function () {
                        $('#loading').show();

                    },
                    success:function(data){
                        if(data.status == true){
                            $('.mini_cart').html(data.mini_cart);
                            $('.donation').attr('count-cart',String(data.quantity_cart))

                            // $('.shop-cart').html(data.cart_page);
                            Toast.fire({
                                icon: "success",
                                title: data.message
                                });
                        }
                        else{
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
                        }, 500);
                    },
                });
            }
        })
    }
</script>

<script>
    $(document).ready(function(){
        $('.login-in').click(function(event){
            event.stopPropagation();
            $('.login-in__sub').stop(true, true).slideDown(300);
        });

        $(document).click(function(event){
            if(!$(event.target).closest('.login-in, .login-in__sub').length){
                $('.login-in__sub').stop(true, true).slideUp(300);
            }
        });
    });
    </script>
@yield('js')
