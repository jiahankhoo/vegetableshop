<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    // 指定与模型关联的表名
    protected $table = 'products';

    // 可以批量赋值的字段
    protected $fillable = [
        'name',
        'description',
        'price',
        // 其他你在products表中定义的字段
    ];

    // 定义与 Cart 模型的关系
    public function carts()
    {
        return $this->hasMany(carts::class, 'product_id');
    }
}
