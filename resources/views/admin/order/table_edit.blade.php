<div class="row ">
    <div class="col-lg-12">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th>Sản Phẩm</th>
                    <th>Số Lượng</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ( $order_details as $val )
                <tr>
                    <td >
                        <select class="form-control select2" name="products[]" style="width: 100%">
                            @foreach ($products as $item )
                            <option value="{{ $item->id}}" {{$val->product_id == $item->id ? 'Selected' : '' }}  data-image="{{ $item->feature_image }}">{{ $item->name }}</option>
                            @endforeach
                            @foreach ($variant_products as $item )
                            <option value="{{ $item->product_id }},{{$item->children_id}}"
                                {{$val->product_id == $item->product_id && $val->attribute == $item->children_id ? 'Selected' : '' }}
                                data-image="{{ $item->product_variants->feature_image }}">{{ $item->product_variants->name }}
                                ( {{(Array_ids($item->id))}} )</option>
                            @endforeach
                        </select>

                    </td>
                    <td class="">
                        <input
                            type="number"
                            class="form-control"
                            name="quantity[]"
                            value="1"
                            min="1"
                        />
                    </td>

                </tr>
                @endforeach

            </tbody>
            <tbody class="new_rows">
            </tbody>
        </table>
    </div>
</div>
