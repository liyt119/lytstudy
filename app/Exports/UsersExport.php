<?php

namespace App\Exports;

use App\Models\User;
use Dotenv\Result\Result;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpParser\ErrorHandler\Collecting;

class UsersExport implements FromCollection
{
    /*protected $data;

    //构造函数传值
    public function __construct($data)
    {
        $this->data=$data;
    }*/
    /**
    * @return \Illuminate\Support\Collection
    */

    //数组转集合
    public function collection()
    {
        return User::all();
        //return new Collection($this->createData());
    }

    //业务代码
    /*public function createData()
    {
        return [
            ['姓名','邮箱','头像'],
            [1, '小明', '18岁'],
            [4, '小红', '17岁']
        ];
    }*/
}
