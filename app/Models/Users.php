<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    public function getAllUser(){
        $users =DB::select('SELECT * FROM users ORDER BY create_at DESC');
        return($users);
    }
    public function addUser($data){
        DB::insert('INSERT INTO users(fullname, email, create_at) VALUES (? ,? ,?)', $data);
    }
    public function getDetail($id){
        return DB::select('SELECT * FROM '. $this->table.' WHERE id = ?', [$id]);
    }
    public function updateUser($data,$id){
        $data[] =$id ;
        return DB::update('UPDATE ' . $this->table . ' SET fullname=?, email=?, update_at=? WHERE id=?', $data);
    }
    public function deleteUser($id){
        return DB::delete('DELETE FROM ' . $this->table . ' where id = ?',[$id]);
    }
    public function statementUser($sql){
        return DB::statement($sql);
    }

    public function learnQueryBuilder(){
        // lấy bản ghi của table
        $listUser = DB::table($this->table)->get();
        // dd($listUser);

        // lấy bản ghi đầu tiên của table(lấy thông tin chi tiết)
        $deatil = DB::table($this->table)->first();
        // dd($deatil);
        // mỗi cột là một tham số các nhau bởi dấy phẩy, có thể sử dụng as để thay đổi tên cột, phải để các lệnh select ở trước get(), hoặc first()
        $lists = DB::table($this->table)->select('email', 'fullname')->get();
        // dd($lists);
        // điều kiện =
        // $listWhere = DB::table($this->table)
        // ->select('email', 'fullname')
        // ->where('id', 8)
        // ->get();
        // dd($listWhere);

        // điều kiện lớn hơn '>'
        // $listGreater = DB::table($this->table)
        // ->select('email', 'fullname')
        // ->where('id', '>', 8)
        // ->get();
        // dd($listGreater);
        // diều kiện bé hơn '<'
        $listLess = DB::table($this->table)
        ->select('email', 'fullname', 'id')
        // ->where('id', '<=', 8) điều kiện bé hơn hoặc bằng

        // ->where('id', '<>', 8) so sanh khac nhau
        // ->where([
        //     ['id', '>=', 8],
        //     ['id', '<=', 10]
        // ])-> điều kiện AND

        // điều kiên OR
        ->where('id' ,8)
        ->orWhere('id', 10)
      
        ->get();
        // dd($listLess);
    }
}

