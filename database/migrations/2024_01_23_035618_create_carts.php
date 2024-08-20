<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // 产品ID，关联products表
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // 用户ID，关联users表
            $table->integer('c_id'); // 购物车或订单ID
            $table->integer('qty'); // 产品数量
            $table->decimal('price', 8, 2); // 产品价格
            $table->string('c_status'); // 购物车状态
            $table->timestamps(); // 创建和更新时间戳
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
