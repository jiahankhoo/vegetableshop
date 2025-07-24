<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carts extends Model
{
    use HasFactory;

    // 指定与模型关联的表名
    protected $table = 'carts';

    // 可以批量赋值的字段
    protected $fillable = [
        'p_id',
        'u_id',
        'c_id',
        'qty',
        'c_status',
    ];

    // 定义与 Product 模型的关系
    public function product()
    {
        return $this->belongsTo(product::class);
    }

    // 定义与 User 模型的关系
    public function user()
    {
        return $this->belongsTo(User::class, 'u_id');
    }
}
