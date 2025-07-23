<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAdmin extends FormRequest
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
        'email' => 'required|email|unique:users,email|max:255',
        'password' => 'required|min:8|max:255',
        'name' =>'required|max:255',
        'role_id' => 'required'
        ];

    }
    public function messages(){
        return [
            'email.required' => 'Email làm ơn điền',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'email.max' => 'Email quá dài',
            'password.required' => 'Mật khẩu làm ơn điền',
            'password.min' => 'Mật khẩu quá ngắn',
            'password.max' => 'Mật khẩu quá dài',
            'password_confirmation.required' => 'Mật khẩu xác nhận làm ơn điền',
            'name.required' => 'Tên làm ơn điền',
            'name.max' => 'Tên quá dài',
            'role_id.required' => 'Vui Lòng Chọn Vai Trò'
        ];
    }
}
