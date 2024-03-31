<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // quy ước tên table
    // Model:Post -> table: posts
    // Model:Product_Category -> table: product_categories
    protected $table = 'posts';

    // Quy ước khóa chính, laravel mặc định khóa chính là field id
    protected $primaryKey = 'id';
    // public $incrementing = false;
    // protected $keyType = 'string';
    public $timestamps = true ;
    const CREATE_AT = 'create_at';
    const UPDATE_AT = 'update_at';

    protected $attributes = [
        'status' => 0
    ];
}
