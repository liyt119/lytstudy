<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

//toModel不需手动调用sava()
/*class UsersImport implements ToModel
{
    public function model(array $row)
    {
        //过滤表头和空行
        if(empty($row[0]) || $row[0] == 'name')
        {
            return null;
        }
        return new User([
           'name'     => $row[0],
           'email'    => $row[1], 
           'password' => Hash::make($row[2]),
        ]);
    }

}*/

//toCollection需要手动存储
class UsersImport implements ToCollection
{
    protected $delTitle;
    
    public function  __construct($delTitle = 1)
    {
        $this->delTitle = $delTitle;
    }
    public function collection(Collection $rows)
    {
        //去除表头或 
        //unset($rows[0]);
        $this->delTitle($rows);
        return $this->createData($rows);
    }

    //删除无用行
    public function delTitle(&$rows)
    {
        $rows = $rows->slice($this->delTitle)->values();
    }

    public function createData($rows)
    {
        foreach($rows as $row)
        {
            $aData = $row->toArray();
             //excel经常读取很多空行，如果不判断会导入很多空记录，根据你自己的逻辑去判断，不为空的数据才允许插入；
             if(!empty($aData) && !empty($aData[0]) && !!empty($aData[1]))
             {
                 User::create([
                    'name' => $row[0],
                    'email'    => $row[1],
                    'password' => bcrypt($row[2]),
                 ]);
             }
        }
        /*$success = 0;
        foreach ($rows as $row) {


            (new User())->create(
                [

                    'name' => $row[0],
                    'email'    => $row[1],
                    'password' => bcrypt($row[2]),
                ]
            );

            // 其他业务代码
            $success++;
        }

        return $success . '-' . count($rows);*/
    }
}
