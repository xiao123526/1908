<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    // 关联到模型的数据库表
    protected $table = 'admin';
    // 设置主键   默认是  id
    protected $primaryKey = 'admin_id';
    // 表明模型是否应该被打上时间戳
    // 表里没有 created_at 和 updateed_at  设为false ；
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}
