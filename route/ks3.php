<?php
// 查看HTML
Route::get('book','Book/book');
Route::post('book_add/book_add','Book/bookAdd');
// 图书列表
Route::get('bookList/bookList','Book/bookList');
// 删除图书列表一条数据
Route::get('bookDel/bookDel/:id','Book/bookDelete');
// 修改图书列表中一条数据
Route::get('bookUpdate/bookUpdate/:id','Book/bookUpdate');
Route::get('books/books/:id','Book/bookUpdate1');
Route::post('books/books/:id','Book/bookUpdate1');