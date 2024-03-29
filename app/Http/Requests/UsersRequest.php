<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $uniqueEmail = 'unique:users';
        if (session('id')){
            $id = session('id');
            $uniqueEmail = 'unique:users,email,'.$id;
        }
        return [
            'fullname' => 'required|min:5',
            'email' => 'required|email|'.$uniqueEmail,
            'group_id' => ['required', 'integer',function($attribute, $value, $fail){
                if ($value == 0){
                    $fail('Bắt buộc phải chọn nhóm');
                }
            }],
            'status' => 'required|integer'

        ];
    }
    public function messages(){
        return [
            'fullname.required' => 'Ho va ten bat buoc phai nhap',
            'fullname.min' => 'Ho va ten bat buoc phai tu :min ky tu tro len',
            'email.required' => 'Email bat buoc phai nhap',
            'email.email' => 'Email khong dung dinh dang',
            'email.unique' => 'Email đã tồn tại',
            'group_id.required' =>'Trang thai bat buoc phai nhap',
            'group_id.integer' => 'Bat buoc phai la so' ,
            'status.required' => 'Status bat buoc phai nhap',
            'status.integer' => 'Status bat buoc la so'          
        ];
    }
}
