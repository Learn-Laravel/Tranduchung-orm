<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\Uppercase;

class HomeController extends Controller
{
    public $data = [];
    public function index()
    {
        $this->data['welcome'] = 'Hoc lap trinh tai <b>Unicode </b>';

        $this->data['content'] = '<h3>Chuong 1: Nhap mon Laravel</h3>
        <p>Kien thuc 1</p>
        <p>Kien thuc 2</p>
        <p>Kien thuc 3</p>
        ';
        $this->data['index'] = 1;
        $this->data['dataArr'] = [
            'item1',
            'item2',
            'item3'
        ];
        $this->data['number'] = 1;
        $this->data['message'] = "thanh cong";
        $this->data['title'] = 'Dao tao lap trinh';
        $this->data['message'] = 'Dang ky tai khoan thanh cong';
        return view('Clients.home', $this->data);
    }
    public function products()
    {
        $this->data['title'] = 'san pham';
        return view('products', $this->data);
    }
    public function getAdd()
    {
        $this->data['title'] = 'Them san pham';
        $this->data['errorMessage'] = "Vui lòng kiểm tra lại dữ liệu";
        return view('Clients.add', $this->data);
    }

    public function postAdd(Request $request)
    {
        $rule = [
            'product_name' => ['required','min:6', function($attribute, $value, $fail){
                isUppercase($value, 'Trường :attribute không hợp lệ', $fail);
            }],
            'product_price' => ['required','integer']
        ];
        // $message =
        // [
        //     'product_name.required'=>"Tên sản phẩm bắt buộc phải nhập",
        //     'product_name.min' => "Tên sản phẩm không được nhỏ hơn :min kí tự",
        //     'product_price.required' =>'Giá sản phẩm không được để trống',
        //     'product_price.integer' => 'Giá sản phẩm bắt buộc là số'
        // ];
        $message = [
            'required' => 'Trường :attribute bắt buộc phải nhập',
            'min' => 'Trường :attribute không nhỏ hơn :min kí tự',
            'integer' => 'Trường :attribute bắt buộc phải là số',
            // 'uppercase' => 'Trường :attribute phải viết hoa'
        ];
        $attribute =[
            'product_name' => 'Tên sản phẩm',
            'product_price' => 'Giá sản phẩm'
        ];
        
        // $request->validate($rule, $message);
        // xử lý việc thêm dữ liệu vào database
        $validator = Validator::make($request->all(), $rule, $message, $attribute);
        if ($validator -> fails()){
            // return 'Validate thất bại';
            $validator->errors()->add('msg', 'Vui lòng kiểm tra lại dữ liệu');
        }
        else{
            // return 'Validate thành công';
            return redirect()->route('product')->with('msg', 'thanh cong');
        }
    //    $validator ->validate();
        return back()->withErrors($validator);
    }

    public function putAdd(Request $request)
    {
        return "Put";
        dd($request);
    }
    public function getArr()
    {
        $contentArr = [
            'name' => 'laravel',
            'lesson' => 'khoa hoc lap trinh',
            'academy' => 'unicode'
        ];
        return $contentArr;
    }

    public function dowloadImage(Request $request)
    {
        if (!empty($request->image)) {
            $image = trim($request->image);

            // $fileName = basename($image);
            $fileName = 'image_' . uniqid() . 'jpg';
            return response()->download($image, $fileName);
            // return response()->streamDownload(function() use ($image){
            //     $imageContent = file_get_contents($image);
            //     echo $imageContent;
            // }, $fileName);
        }
    }
    public function dowloadDoc(Request $request)
    {
        if (!empty($request->file)) {
            $file = trim($request->file);

            // $fileName = basename($image);

            return response()->download($file);
            // return response()->streamDownload(function() use ($image){
            //     $imageContent = file_get_contents($image);
            //     echo $imageContent;
            // }, $fileName);
        }
    }
}
