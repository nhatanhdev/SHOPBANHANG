<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAdd extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' =>'bail|required|max:255',
            'price' =>'bail|required|numeric',
            'category_id' =>'bail|required|',
            'feature_image' =>'bail|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }
    public function messages(){
        return [
            'name.required' => 'Tên không được để trống',
            'price.required' => 'Giá không được để trống',
            'feature_image.required' => 'Hình đại diện không được để trống',
            'feature_image.image' => 'Hình đại diện phải là một hình ảnh',
            'feature_image.mimes' => 'Hình đại diện phải là một tệp tin có định dạng: jpeg, png, jpg, gif, svg',
            'feature_image.max' => 'Hình đại diện không được lớn hơn 2MB',
            'price.numeric' => 'Giá phải là một số',
            'category_id.required' => 'Vui lòng chọn danh mục',
        ];
    }
}
