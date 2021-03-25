<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function import()
    {
        Excel::import(new UsersImport,'users.xlsx');
    }



    public function show(User $user)
    {
        $user = User::orderBy('id','desc')->paginate(9);
        return view('users.show',compact('user'));
    }

    public function root()
    {
        $page_index = 3;
		return view('pages.res', compact('page_index'));
    }

    public function search(Request $request)
    {
        $page_index = 3;
		$page = 50;
        $address_raw = $request->address;
        $address= mb_convert_encoding($request->address, "GBK", "UTF-8");
        $result_num = preg_match("/^[\x{4e00}-\x{9fa5}0-9a-zA-Z]+$/u", $address_raw, $address_result);
        // 
       
        /*if ($result_num != 1) {
            return redirect()->route('root')->with('danger', '请输入中文、字母或数字！');
        }*/
        try{
            $result = User::where('name','like','%'.$address.'%')
            ->orwhere('email','like','%'.$address.'%')->orderBy('id','desc')->limit($page)->get();
            
            $result_arr = array();
			foreach ($result as $key => $value) {
				$result_arr_item = array();
				$result_arr_item['id'] = $value->id;
				$result_arr_item['name'] = $value->name;
				$result_arr_item['email'] = mb_convert_encoding($value->email, "UTF-8", "GBK");
				
				$result_arr[] = $result_arr_item;
			}

           

            return view('users.xianshi', compact('result_arr', 'page', 'address_raw', 'page_index'));
        }
        catch (QueryException $e) {
        	echo mb_convert_encoding($e,"UTF-8","GBK");die;
            self::log('ResController 数据库错误，信息：'.mb_convert_encoding($e,"UTF-8","GBK"));
            return redirect()->route('root')->with('danger', '数据库错误，请联系管理员：liyt');
        }
    }

    protected function log($content)
    {
        $filename = 'log/address.log';
        $output = '#'.date('Y-m-d H:i:s') . '# ' . $content . PHP_EOL;
        file_put_contents($filename, $output, FILE_APPEND);
    }
}
