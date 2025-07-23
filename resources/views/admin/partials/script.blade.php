
    <script src="{{asset('adminlte/js/jquery1-3.4.1.min.js')}}"></script>
    <script>
        setTimeout(function() {
            $('.loading-js').css("display", "none");
        }, 100); // 1 giây (1000 milliseconds)
    </script>
    <script src="{{asset('adminlte/js/popper1.min.js')}}"></script>
    <script src="{{asset('adminlte/js/bootstrap1.min.js')}}"></script>
    <script src="{{asset('adminlte/js/metisMenu.js')}}"></script>
    <script src="{{asset('adminlte/vendors/count_up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('adminlte/vendors/chartlist/Chart.min.js')}}"></script>
    <script src="{{asset('adminlte/vendors/count_up/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('adminlte/vendors/swiper_slider/js/swiper.min.js')}}"></script>
    <script src="{{asset('adminlte/vendors/niceselect/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('adminlte/vendors/owl_carousel/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('adminlte/vendors/gijgo/gijgo.min.js')}}"></script>
    <script src="{{asset('adminlte/vendors/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('adminlte/vendors/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('adminlte/vendors/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('adminlte/vendors/datatable/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('adminlte/vendors/datatable/js/jszip.min.js')}}"></script>
    <script src="{{asset('adminlte/vendors/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('adminlte/vendors/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{asset('adminlte/vendors/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('adminlte/vendors/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('adminlte/js/chart.min.js')}}"></script>

    <script src="{{asset('adminlte/vendors/progressbar/jquery.barfiller.js')}}"></script>

    <script src="{{asset('adminlte/vendors/tagsinput/tagsinput.js')}}"></script>

    <script src="{{asset('adminlte/vendors/text_editor/summernote-bs4.js')}}"></script>
    <script src="{{asset('adminlte/vendors/apex_chart/apexcharts.js')}}"></script>

    <script src="{{asset('adminlte/js/custom.js')}}"></script>


    {{-- <script src="{{asset('adminlte/js/active_chart.js')}}"></script> --}}
    {{-- <script src="{{asset('adminlte/vendors/apex_chart/radial_active.js')}}"></script> --}}
    {{-- <script src="{{asset('adminlte/vendors/apex_chart/stackbar.js')}}"></script> --}}
    {{-- <script src="{{asset('adminlte/vendors/apex_chart/area_chart.js')}}"></script> --}}
    {{-- <script src="{{asset('adminlte/vendors/apex_chart/bar_active_1.js')}}"></script> --}}
    {{-- <script src="{{asset('adminlte/vendors/chartjs/chartjs_active.js')}}"></script> --}}

    <script src="{{asset('adminlte/js/sweetalert2@11.js')}}"></script>
    <script src="{{asset('adminlte\vendors\select2\js\select2.js')}}"></script>

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
            $(document).ready(function() {
            // Get the current URL of the page
            var currentUrl = window.location.href;

            // Add click event handler to menu items

            // Iterate through each menu item to match the URL
            $('#sidebar_menu .mm-collapse li a').each(function() {
                // Get the URL of the menu item
                var menuItemUrl = $(this).attr('href');
                // Compare the URL of the menu item with the current URL
                if (currentUrl.includes(menuItemUrl)) {
                    // Add active class to the menu item if the URLs match
                    $(this).addClass('active');
                    $(this).parents('li').children('a').addClass('active');
                    $(this).parents('li').children('a').attr('aria-expanded', 'true');
                    $(this).parents('li').children('ul').addClass('mm-show');
                    $(this).parents('li').parents('li').addClass('mm-active');

                }
            });


        });


    </script>

     <script>

// $(document).ready(function() {

//     // Handle input event on search input
//     $('#input_search_method').on('input', function() {
//         var searchTerm = $(this).val().toLowerCase().trim();
//         var datalist = $('#result_search');
//         datalist.empty(); // Clear previous options

//         // Loop through each item in sidebar menu and filter based on search term
//         $('#sidebar_menu li ul').each(function() {
//             $(this).find('a').each(function() {
//                 var menuItem = $(this).text().trim().toLowerCase(); // Get text content of each <a> inside <ul>
//                 var menuItemLink = $(this).attr('href');

//                 // Check if search term matches item name
//                 if (menuItem.includes(searchTerm)) {
//                     var option = $('<option>').attr('value', menuItem).data('url', menuItemLink); // Set value and data-url of option
//                     datalist.append(option);
//                 }
//             });
//         });
//     });

//     // Set up datalist options initially on page load
//     $('#input_search_method').trigger('input'); // Trigger input event to populate initial options

//     // Handle input event when typing or selecting an option from datalist
//     $('#input_search_method').on('input', function() {
//         var selectedText = $(this).val().toLowerCase().trim();
//         $('#sidebar_menu li').each(function() {
//             var menuItem = $(this).find('a').text().trim().toLowerCase();
//             if (menuItem === selectedText) {
//                 var selectedUrl = $(this).find('a').attr('href');
//                 if (selectedUrl) {
//                     window.location.href = selectedUrl; // Redirect to selected URL
//                 }
//                 return false; // Exit loop once URL is found
//             }
//         });
//     });

//     });


     </script>


    @yield('js')



