<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;

class UsersController extends Controller
{
    private $users;
    public function __construct()
    {
        $this->users = new Users;
    }
    public function index()
    {
        $statement = $this->users->statementUser('DELETE FROM users');
        dd($statement);
        $title = 'Danh sách người dùng';
        $userList = $this->users->getAllUser();
        return view('Clients.users.lists', compact('title', 'userList'));
    }
    public function add()
    {
        $title = "Them Nguoi Dung";
        return view('Clients.users.add', compact('title'));
    }
    public function postAdd(Request $request)
    {
        $request->validate(
            [
                'fullname' => 'required|min:5',
                'email' => 'required|email|unique:users'
            ],
            [
                'fullname.required' => 'Ho va ten bat buoc phai nhap',
                'fullname.min' => 'Ho va ten bat buoc phai tu :min ky tu tro len',
                'email.required' => 'Email bat buoc phai nhap',
                'email.email' => 'Email khong dung dinh dang',
                'email.unique' => 'Email đã tồn tại'
            ]
        );
        $dataInsert = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];
        $this->users->addUser($dataInsert);
        return redirect()->route('users.index')->with('msg', "Them nguoi dung thanh cong");
    }
    public function getEdit(Request $request,$id = 0)
    {
        $title = "Cap Nhat Nguoi Dung";

        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {
                $request->session()->put('id',$id);
                $userDetail = $userDetail[0];
            } else {
                return redirect()->route('users.index')->with('msg', 'Nguoi dung khong ton tai');
            }
        } else {
            return redirect()->route('users.index')->with('msg', 'Nguoi dung khong ton tai');
        }
        return view('Clients.users.edit', compact('title', 'userDetail'));
    }
    public function postEdit(Request $request)
    {
        $id = session('id');
        if (empty($id)){
            return back()->with('msg', 'Lien ket khong ton tai');
        }
        $request->validate(
            [
                'fullname' => 'required|min:5',
                'email' => 'required|email|unique:users,email,'.$id
            ],
            [
                'fullname.required' => 'Ho va ten bat buoc phai nhap',
                'fullname.min' => 'Ho va ten bat buoc phai tu :min ky tu tro len',
                'email.required' => 'Email bat buoc phai nhap',
                'email.email' => 'Email khong dung dinh dang',
                'email.unique' => 'Email đã tồn tại'
            ]
        );
        $dataUpdate = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];
        $this->users->updateUser($dataUpdate, $id);
        return redirect()->route('users.edit', ['id' => $id])->with('msg', 'cap nhat nguoi dung thanh cong');
    }
    public function delete($id=0){
        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {
                $deleteStatus = $this->users->deleteUser($id);
                if ($deleteStatus){
                    $msg = 'Xoa nguoi dung thanh cong';
                } else{
                    $msg ='ban khong the xoa nguoi dung luc nay. VUi long thu lai';
                }
            }else{
                $msg ='Người dùng không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }

        return redirect()->route('users.index')->with('msg', $msg);
    }
}
    

