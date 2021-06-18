<?php
namespace app\index\controller;
use think\Db;
class Student
{
    // 查找所有学生数据
    public function stuName()
    {
        $res = Db::table('student')->select();
        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }

    // 查找年龄大于20的学生
    public function stuBigAge()
    {
        $res = Db::table('student')->where('age','>',20)->select();
        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }

    // 查找年龄小于18的学生
    public function stuSmallAge()
    {
        $res = Db::table('student')->where('age','<',18)->limit('10')->order('age','desc')->select();
        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }

    // 查找性别为女的学生信息
    public function stuSexWoman()
    {
        $res = Db::table('student')->where("sex='0'")->select();
        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }

    // 查找性别为男的学生信息
    public function stuSexMan()
    {
        $res= Db::table('student')->where("sex='1'")->select();
        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }

    // 查找综合积分在150分以上的同学信息
    public function stuScoreB()
    {
        $res = Db::table('student')->where('score','>',150)->select();
        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }

    // 查找综合积分在59分以下的同学信息
    public function stuScoreS()
    {
        $res = Db::table('student')->where('score','<',59)->field('stu_name,age')->select();
        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }

    // 查询年龄在18-25岁之间的学生信息
    public function stuAgeBet()
    {
        $res = Db::table('student')->where('age','<',25,'and','>',18)->select();
        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }

    // 查询女同学年龄小于20的学生的姓名、年龄
    public function stuWomanAge()
    {
        $res = Db::table('student')->where("sex='0'")->where('age','<','20')->field('stu_name,age')->select();
        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }

    // 查询id为5的一条数据
    public function stuId()
    {
        $res =  Db::table('student')->where('id','5')->find();
        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }

    // 查询综合积分小于150的数据
    public function stuScoreS1()
    {
        $res = Db::table('student')->where('score','<','150')->select();
        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }

    // 查询id为5-10之间的同学的综合积分
    public function stuIdBet()
    {
        $res = Db::table('student')->where('id','between',[5,10])->select();
        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }
}