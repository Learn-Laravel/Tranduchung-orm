<?php

namespace App\Http\Controllers;
use  App\Http\Requests\UsersRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Models\Group;

class UsersController extends Controller
{
    private $users;
    const _PER_PAGE = 4;
    public function __construct()
    {
        $this->users = new Users;
    }
    public function index(Request $request)
    {
        $keywords = null;
        $filters=[];
        if (!empty($request->status)){
            $status = $request->status;
            if ($status == 'active'){
                $status = 1;
            } else{
                $status = 0;
            }
            $filters [] = ['users.status', '=', $status];
            // dd($filter);
        }
        if (!empty($request->group_id)){
            $group_id = $request->group_id;
            
            $filters [] = ['users.group_id', '=', $group_id];
            dd($filters);
        }
        if (!empty($request->keywords)){
            $keywords = $request->keywords;

        }
        // echo $keywords;
        // xử lí logic sắp xếp
        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type');
        $allowSort = ['asc', 'desc'];
        if (!empty($sortType) && in_array($sortType, $allowSort)){
            if ($sortType == 'desc'){
                $sortType ='asc';
            } else{
                $sortType ='desc';
            }
        } else{
            $sortType ='asc';
        }

        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];
        
        $title = 'Danh sách người dùng';
        // $this->users->learnQueryBuilder();
        $userList = $this->users->getAllUser($filters, $keywords,$sortArr, self::_PER_PAGE);
        $groups = Group::getAll();
        return view('Clients.users.lists', compact('title', 'userList', 'groups', 'sortType', 'sortArr'));
    }
    public function add()
    {
        $title = "Them Nguoi Dung";
        $groups = Group::getAll();
        return view('Clients.users.add', compact('title', 'groups'));
    }
    public function postAdd(UsersRequest $request)
    {
        
        $dataInsert = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'create_at' => date('Y-m-d H:i:s')
        ];
        $this->users->addUser($dataInsert);
        return redirect()->route('users.index')->with('msg', "Them nguoi dung thanh cong");
    }
    public function getEdit(Request $request,$id = 0)
    {
        $title = "Cap Nhat Nguoi Dung";
        $groups = Group::getAll();
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
        return view('Clients.users.edit', compact('title', 'userDetail', 'groups'));
    }
    public function postEdit(UsersRequest $request)
    {
        $id = session('id');
        if (empty($id)){
            return back()->with('msg', 'Lien ket khong ton tai');
        }
        $dataUpdate = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'update_at' => date('Y-m-d H:i:s')
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
    

