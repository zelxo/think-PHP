<?php
// 查找所有学生数据
Route::get('stuName','Student/stuName');

// 查找年龄大于20的学生
Route::get('stuBigAge','Student/stuBigAge');
// 查找年龄小于18的学生
Route::get('stuSmallAge','Student/stuSmallAge');
// 查找性别为女的学生信息
Route::get('stuSexWoman','Student/stuSexWoman');
// 查找性别为男的学生信息
Route::get('stuSexMan','Student/stuSexMan');
// 查找综合积分在150分以上的同学信息
Route::get('stuScoreB','Student/stuScoreB');
// 查找综合积分在59分以下的同学信息
Route::get('stuScoreS','Student/stuScoreS');
// 查询年龄在18-25岁之间的学生信息
Route::get('stuAgeBet','Student/stuAgeBet');
// 查询女同学年龄小于20的学生的姓名、年龄
Route::get('stuWomanAge','Student/stuWomanAge');
// 查询id为5的一条数据
Route::get('stuId','Student/stuId');
// 查询综合积分小于150的
Route::get('stuScoreS1','Student/stuScoreS1');
// 查询id为5-10之间的同学的综合积分
Route::get('stuIdBet','Student/stuIdBet');

// 向数据库添加一条数据
Route::get('insertOne','InsertStu/insertOne');
// 向数据库添加多条数据
Route::get('insertMany','InsertStu/insertMany');
// 向数据库中添加多条随机数据
Route::get('insertRandom','InsertStu/insertRandom');
// 随机生成字符串
Route::get('random','InsertStu/random');