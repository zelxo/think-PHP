<?php

namespace app\index\model;
use think\facade\Request;
use think\Model;


/**
 * 测试
 */
class Users extends Model
{
    // 指定数据表
    protected $table = 'reg';

    // 指定表的主键
    protected $pk = 'userid';



}
