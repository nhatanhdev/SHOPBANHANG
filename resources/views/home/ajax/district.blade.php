<select name="billing_district" class="nice-select Advice state province">
    <option value="0" id="district">Chọn Quận Huyện</option>
    @if (isset($districts))
        @foreach ($districts as $key => $district)
            <option value="{{$district->id}}">{{$district->name}}</option>
        @endforeach
    @endif
</select>


<script>
    $('.nice-select.province').niceSelect();
    $('.nice-select.province').on('change', function (){

        var id = $(this).val()
        // var province = $('option[value='+id+']').prop('selected', true).text();
        // $('input[name="billing_address"]').val(province);
        $.ajax({
            url: "{{route('ajax.wards')}}",
            type: 'GET',
            data: {
                id : id,
            },
            success: function (data) {
                if(data.status == true){
                    $('.wards').html(data.views)
                }
                else{
                    $('.wards').html(data.views)
                    $('.ward ul.list').css("opacity","0")
                }

            },
            error: function (error) {
            },
        })
    })




</script>
