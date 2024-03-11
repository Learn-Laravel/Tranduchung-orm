<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index(){
        $title = 'Danh sách người dùng';
        $users =DB::select('SELECT * FROM users ORDER BY create_at DESC');
        return view('Clients.users.lists', compact('title', 'users'));
    }
}
