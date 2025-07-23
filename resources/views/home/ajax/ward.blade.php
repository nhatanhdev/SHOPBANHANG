<select name="billing_ward" class="nice-select Advice ward">
    <option value="0" id="ward"> Chọn Đường Phố</option>
    @if (isset($wards))
        @foreach ($wards as $key => $ward)
            <option value="{{$ward->id}}">{{$ward->name}}</option>
        @endforeach
    @endif
</select>
<script>
    $('.nice-select.ward').niceSelect();
</script>
