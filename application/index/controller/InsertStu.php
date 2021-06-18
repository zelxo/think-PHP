<?php
namespace app\index\controller;
use think\Db;
class InsertStu
{
    // 向数据库添加一条数据
    public function insertOne()
    {
        $data = [
          'stu_name'    =>    '唐僧',
          'sex'         =>    1,
          'age'         =>    20,
          'score'       =>    91,
        ];
        //
        $num = Db::name('student')->insert($data);
        echo "受影响的行数" . $num;
        echo "<hr>";
        echo "SQL语句是" . Db::getLastSql();
    }


    // 向数据库添加多条数据
    public function insertMany()
    {
        $data = [
            ['stu_name' => '张舒翔','sex' => 1,'age' => 16, 'score' => 20],
            ['stu_name' => '付兴奇','sex' => 1,'age' => 18, 'score' => 50],
            ['stu_name' => '姬生华','sex' => 1,'age' => 17, 'score' => 90],
        ];

        $num = Db::name('student')->insertAll($data);
        echo "受影响的行数" . $num;
        echo "<hr>";
        echo "SQL语句是" . Db::getLastSql();
    }

    // 向数据库中添加多条随机数据
    public function insertRandom()
    {

        for ($i=0;$i<100;$i++){
            $name = $this->random(3);
            $age = mt_rand(18,30);
            $sex = mt_rand(0,1);
            $score = mt_rand(30,100);


            $data = [
                'stu_name'  => $name,
                'sex'       => $sex,
                'age'       => $age,
                'score'     => $score
            ];


            Db::name('student')->insert($data);
            echo "SQL语句是" .  Db::getLastSql();


        }
    }

    // 随机生成字符串
    private function random($num = 3)
    {
        $str = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        $res = '';
        for ($i=0;$i<$num;$i++){
            $rad = mt_rand(0,51);
            $res .= $str[$rad];
        }
        return $res;
    }


}