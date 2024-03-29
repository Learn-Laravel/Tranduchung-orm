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
    
    public function getAllUser($filters=[], $keywords = null, $sortByArr=null, $perPage = 0)
    {
        // DB::enableQueryLog();
        // $users = DB::select('SELECT * FROM users ORDER BY create_at DESC');
        $users = DB::table($this->table)
            ->select('users.*', 'groups.name as group_name')
            ->join('groups', 'users.group_id', '=', 'groups.id')
            ->where('trash',0);

        $orderBy = 'users.create_at';
        $orderType = 'desc';
        if (!empty($sortByArr) && is_array($sortByArr)){
            if (!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])){
                $orderBy = trim($sortByArr['sortBy']);
                $orderType = trim($sortByArr['sortType']);
            }
        }
        $users = $users->orderBy($orderBy, $orderType);
        if(!empty($filters)){
            $users =$users->where($filters);
        }
        if(!empty($keywords)){
            $users = $users->where(function($query) use ($keywords){
                $query ->orWhere('fullname', 'like', '%'.$keywords.'%');
                $query ->orWhere('email', 'like', '%'.$keywords.'%');
            });
        }
        if (!empty($perPage)){
            $users = $users->paginate($perPage);
        }else{
            $users = $users->get(); 
        }
        // $sql =  DB::getQueryLog();
        // dd($sql);
        return $users;
    }
    public function addUser($data)
    {
        // DB::insert('INSERT INTO users(fullname, email, create_at) VALUES (? ,? ,?)', $data);
        DB::table($this->table) ->insert($data);
    }
    public function getDetail($id)
    {
        return DB::select('SELECT * FROM ' . $this->table . ' WHERE id = ?', [$id]);
    }
    public function updateUser($data, $id)
    {
        // $data[] = $id;
        // return DB::update('UPDATE ' . $this->table . ' SET fullname=?, email=?, update_at=? WHERE id=?', $data);
        return DB::table($this ->table) -> where('id',$id) ->update($data);
    }
    public function deleteUser($id)
    {
        // return DB::delete('DELETE FROM ' . $this->table . ' where id = ?', [$id]);
        return DB::table($this->table)->where('id', $id)->delete();
    }
    public function statementUser($sql)
    {
        return DB::statement($sql);
    }

    public function learnQueryBuilder()
    {
        // Kiểm tra câu lệnh SQL C2
        DB::enableQueryLog();
        // lấy bản ghi của table
        // $listUser = DB::table($this->table)->get();
        // dd($listUser);

        // lấy bản ghi đầu tiên của table(lấy thông tin chi tiết)
        // $deatil = DB::table($this->table)->first();
        // dd($deatil);
        // mỗi cột là một tham số các nhau bởi dấy phẩy, có thể sử dụng as để thay đổi tên cột, phải để các lệnh select ở trước get(), hoặc first()
        // $lists = DB::table($this->table)->select('email', 'fullname')->get();
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
        // $id = 9;
        // $listLess = DB::table($this->table)
        // ->select('email', 'fullname', 'id', 'update_at', 'create_at')
        // ->where('id', '<=', 8) điều kiện bé hơn hoặc bằng

        // ->where('id', '<>', 8) so sanh khac nhau
        // ->where([
        //     ['id', '>=', 8],
        //     ['id', '<=', 10]
        // ])-> điều kiện AND

        // điều kiên OR
        // ->where('id' ,8)
        // ->orWhere('id', 10)
        // ->toSql(); Kiểm tra câu lệnh SQL C1

        // ->where('id', 8)
        // ->where(function($query) use($id) {
        //     $query -> where('id', '<', $id) -> orWhere('id', '>', $id);
        //     // $query -> orWhere('id', '>', 9);
        // })
        // -> where('fullname', 'like', '%Duc Hung%')

        // tìm kiếm giá trị trong khoảng nào đó dùng whereBetween
        // -> whereBetween('id', [7,9])
        // tìm kiếm giá trị không nằm trong khoảng nào đó dùng whereBetween
        // ->whereNotBetween('id', [7,9])
        // ->whereNotIn('id', [7,9])
        // ->whereNull('update_at')
        // ->whereNotNull('update_at')

        // Truy vấn Date, Month, Day, Year
        // ->whereDate('update_at','2024-03-13')
        // ->whereMonth('update_at', '03')
        // ->whereDay('update_at', '13')
        // ->whereYear('update_at', '2024')

        // Truy vấn theo giá trị cột
        // ->whereColumn('create_at','>', 'update_at')
        // ->get();
        // dd($listLess);

        // Join bảng
        // $lists = DB::table('users')
        // ->select('users.*', 'groups.name')
        // -> join('groups', 'groups.id','=', 'users.group_id')
        // -> leftJoin('groups', 'groups.id','=', 'users.group_id')
        // -> rightJoin('groups', 'groups.id','=', 'users.group_id')
        // Sắp xếp 1 cột  và nhiều cột
        // ->orderBy('create_at', 'desc')
        // ->orderBy('id', 'asc')

        // Sắp xếp ngẫu nhiên
        // ->inRandomOrder()

        // Truy vấn theo nhóm
        // ->select(DB::raw('count(id) as count_email'), 'email')
        // ->groupBy('email')
        // ->having('count_email' , '>=', '2')

        // Giới hạn: {offset: lấy ra dữ liệu từ hàng mấy đó}
        //    ->offset(1)
        //    ->limit(2)
        //     ->skip(2)
        //     ->take(2)
        //     ->get();
        // dd($lists);
        // INSERT DATA

        // $status = DB::table('users')->insert([
        //     'fullname' =>'Trần Đức Hùng',
        //     'email' => 'tranduchung@gmail.com',
        //     'group_id' => 1,
        //     'create_at' => date('Y-m-d H:i:s')
        // ]);
        // dd($status);
        // $lastId = DB::getPdo()->lastInsertId();
        // $lastId = DB::table('users') ->insertGetId(
        //     [
        //             'fullname' =>'Trần Đức Hùng',
        //             'email' => 'tranduchung@gmail.com',
        //             'group_id' => 1,
        //             'create_at' => date('Y-m-d H:i:s')
        //         ]
        //     );
        // dd($lastId);

        // UPDATE DATA
        // $status = DB::table('users')
        //     ->where('id', 20)
        //     ->update([
        //         'fullname' => 'Trần Đức Hoàn',
        //         'email' => 'tranduchoan@gmail.com',
        //         'update_at' => date('Y-m-d H:i:s')
        //     ]);
        // dd($status);

        // DELETE DATA
        // $status = DB::table('users') -> where('id', 20) -> delete();

        // ĐẾM SỐ BẢN GHI
        // $count = DB::table('users')-> where('id','>', 10) ->count(); 
        // dd($count);

        // DB RAW QUERY
        $users = DB::table('users')
            // ->selectRaw('email, fullname, count(id) as email_count')
            // -> select(DB::raw('`fullname`as hoten, `email`'))
            // -> groupBy('email')
            // -> groupBy('fullname')
            // ->where('id','>',10)
            // ->whereRaw('id > ?', [10])
            // ->orderByRaw('create_at DESC, update_at ASC')
            // ->groupByRaw('email,fullname')
            // ->having('email_count', '>', 2)
            // ->havingRaw('email_count > ?', [2])
            // ->where(
            //     'group_id', 
            //     '=',
            //     function($query){
            //         $query -> select('id')
            //         ->from('groups')
            //         ->where('name', '=', 'Adminstraitor');
            //     }
            // )
            // ->select('email', DB::raw('(SELECT count(id) FROM `groups`) as group_count'))
            ->selectRaw('email, (SELECT count(id) FROM `groups`) as group_count')
            ->get();
        // dd($users);
        $sql =  DB::getQueryLog();
        dd($sql);
    }
}
