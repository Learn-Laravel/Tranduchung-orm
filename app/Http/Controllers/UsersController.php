<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;

class UsersController extends Controller
{
    private $users;
    public function __construct(){
        $this->users= new Users;
    }
    public function index(){
        $title = 'Danh sách người dùng';
        $userList = $this->users ->getAllUser();
        return view('Clients.users.lists', compact('title', 'userList'));
    }
    public function add(){
        $title ="Them Nguoi Dung";
        return view('Clients.users.add', compact('title'));
    
    } 
    public function postAdd(Request $request){
        $request->validate([
            'fullname' => 'required|min:5',
            'email' =>'required|email|unique:users'
        ],
        [
           'fullname.required' => 'Ho va ten bat buoc phai nhap',
           'fullname.min'=>'Ho va ten bat buoc phai tu :min ky tu tro len',
           'email.required' => 'Email bat buoc phai nhap',
           'email.email' => 'Email khong dung dinh dang',
           'email.unique' => 'Email đã tồn tại'
        ]);
        $dataInsert = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];
        $this->users->addUser($dataInsert);
        return redirect()->route('users.index') -> with('msg', "Them nguoi dung thanh cong");
    }
}
