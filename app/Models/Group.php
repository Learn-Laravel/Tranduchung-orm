<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Group extends Model
{
    use HasFactory;
    protected $table ='groups';
    public static function getAll(){
        $groups = DB::table('groups')
        ->orderBy('name', 'ASC')
        ->get();
        return $groups;
    }
}
