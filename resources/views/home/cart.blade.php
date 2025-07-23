@extends('layouts.home')
@section('title')
<title>Giỏ hàng</title>
@endsection
@section('css')
<style>
   .lightbox{
        display: none;
    }
</style>

@endsection
@section('content')
    @include('home.partials.banner')
<section class="gap">
    <div class="container page_cart">
        @include('home.partials.page_cart')
    </div>
</section>
@endsection
@section('js')
<script>
    function updateCart(id) {
        var quantity = $('#quantity_'+id).val();
        if(quantity > 100) {
            quantity = 100;
        }
        if(quantity < 1) {
            quantity = 1;
        }
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{route('cart.update')}}",
            data: {
                'id': id,
                'quantity': quantity,
            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                if(data.status == true){
                    $('.page_cart').html(data.page_cart);
                    $('#mini_cart').html(data.mini_cart);
                    $('.donation').attr('count-cart',String(data.quantity_cart))
                    Toast.fire({
                    icon: "success",
                    title: data.message
                    });
                }

                else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Something went wrong"
                    });
                }
            },
            error: function (data) {
                console.log('Error:', data);
            },
            complete: function () {
                setTimeout(function() {
                    $('#loading').hide();
                }, 500); // 2000 milliseconds = 2 seconds
            },
        });
    }

</script>

<script>
    function ClearCart() {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'https://goldilocks.gover.vn/cart/clear',
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function(jqXHR, settings) {
                        Pace.restart();
                    },
                    success: function(data) {
                        if (data.status == true) {
                            $('.page_cart').html(data.page_cart);
                            $('#mini_cart').html(data.mini_cart);
                            Swal.fire({
                                title: "Success!",
                                text: data.message,
                                icon: "success"
                            });

                        }
                        else{
                            Swal.fire({
                                title: "Error!",
                                text: data.message,
                                icon: "error"
                            });
                        }
                    },
                    error: function(error) {
                        Swal.fire({
                                title: "Error!",
                                text: error,
                                icon: "error"
                            });
                    },


                })

            }
        });
    }

    </script>

    <script>
        function apply_voucher(e){
            e.preventDefault();
            var code = $('.voucher-code').val()
            $.ajax({
                url : '{{ route('home.voucher_add') }}',
                data : {
                    code : code,
                },
                type: 'POST',
                dataType: 'json',
                beforeSend: function () {
                $('#loading').show();
                },
                success: function (data) {
                    if(data.status == true){
                        $('.page_cart').html(data.page_cart);
                        $('.thongbao').html(data.message)
                        $('.thongbao').addClass("text-primary");
                        // $('.donation').attr('count-cart',String(data.quantity_cart))

                    }

                    else {
                        $('.page_cart').html(data.page_cart);
                        $('.thongbao').html(data.message)

                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                },
                complete: function () {
                    setTimeout(function() {
                        $('#loading').hide();
                    }, 500); // 2000 milliseconds = 2 seconds
                },
            });
        }

    </script>
@endsection
