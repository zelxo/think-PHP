<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\facade\Session;

class Book extends Controller
{
    public function book()
    {
        return $this->fetch();
    }

    public function bookAdd()
    {
        if (in_array(null,$_POST)){
            echo "输入内容不能为空";
        }else{
            // 处理变量
            $book_name = trim($_POST['book_name']);
            $book_price = trim($_POST['book_price']);
            $book_num = trim($_POST['book_num']);
            $is_sale = trim($_POST['is_sale']);



            // 定义一个关联数组
            $book = [
                'book_name' => $book_name,
                'book_price' => $book_price,
                'book_num' => $book_num,
                'is_sale' => $is_sale
            ];

            Db::table('book')->insert($book);
            return redirect('/bookList/bookList');
        }
    }


    public function bookList()
    {
        $sql = Db::table('book')->select();
        $this->assign('sql',$sql);
        return $this->fetch();
    }


    public function bookDelete($id)
    {
        Db::table('book')->where('book_id',$id)->delete();
        return redirect('/bookList/bookList');
    }

    public function bookUpdate($id)
    {
        $sql = Db::table('book')->where('book_id',$id)->find();
        $this->assign('ID',$sql['book_id']);
        $this->assign('name',$sql['book_name']);
        $this->assign('price',$sql['book_price']);
        $this->assign('num',$sql['book_num']);
        $this->assign('is',$sql['is_sale']);
        return $this->fetch();

    }

    public function bookUpdate1($id)
    {
        $book_name = trim($_POST['book_name']);
        $book_price = trim($_POST['book_price']);
        $book_num = trim($_POST['book_num']);
        $is_sale = trim($_POST['is_sale']);


        $book = [
            'book_name' => $book_name,
            'book_price' => $book_price,
            'book_num' => $book_num,
            'is_sale' => $is_sale
        ];



        Db::table('book')->where('book_id',$id)->update($book)   ;
        return redirect('/bookList/bookList');
    }
}