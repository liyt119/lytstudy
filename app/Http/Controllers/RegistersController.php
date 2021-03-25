<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Jizhan;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Storage;


class RegistersController extends Controller
{
    //文件导出
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    //文件导入
    public $name = '导入实例';
    protected $selctor = '.import-post';
    public function handle(Request $oRequest)
    {
        if (!$oRequest->hasFile('file')) {
            return $this->response()->error('请选择文件后在提交');
        }
        //获取文件对象
        $oFile = $oRequest->file('file');
        if ($oFile->isValid()) {
            //判断文件扩展是否符合要求
            $aAllowExtension = ['xls', 'csv', 'xlsx'];
            $sFileExtension = $oFile->getClientOriginalExtension();
            if (!in_array($sFileExtension, $aAllowExtension)) {
                return $this->response()->error('您上传的文件后缀名不支持，仅支持' . implode(',', $aAllowExtension));
            }
            //判断文件大小
            /*if ($oFile->getClientSize() >= 20480000) {
                return $this->response()->error('您上传的的文件过大，最大20M');
            }*/
            //判断文件表头是否符合规范
            //规范的表头
            $aExampleTitle = ['name', 'email', 'password'];
            //获取excel表头
            $headings = (new HeadingRowImport)->toArray($oFile);
            //判断是否符合模板表头
            if (!empty(array_diff($headings[0][0], $aExampleTitle))) {
                return $this->response()->error('上传的excel格式不符合规范，请下载示例');
            }
            //移动到文件夹
            $sFilePath = public_path('uploads/phone_case');
            if (!is_dir($sFilePath)) {
                mkdir($sFilePath, 0775, true);
            }
            $sFileName = date('YmdHis') . '.' . $sFileExtension;
            Storage::disk('admin')->put('phone_case/' . $sFileName, file_get_contents($oFile->getRealPath()));
            //excel数据入库，我的excel前3行数据是废的，所以删除掉，代码参考下方
            Excel::import(new UsersImport, $sFilePath . '/' . $sFileName);

            return $this->response()->success('上传成功')->refresh();
        }
    }
    public function form()
    {
        $this->file('file', '请选择文件');
    }

    public function html()
    {
        return <<<HTML
 <i class="fa fa-plus"></i>
        <a class="btn btn-sm btn-success import-post">导入病例</a>
HTML;
    }








    public function import()
    {
        Excel::import(new UsersImport, 'users.xlsx');


        return redirect('/usershow')->with('success', 'All good!');
    }




    public function index(Request $request)
    {
        $page_index = 3;
        $page = 50;
        $jizhanserarch = $request->search;

        $search = $request->search;


        try {
            $result = Jizhan::where('name', 'like', '%' . $search . '%')->orwhere('bh', 'like', '%' . $search . '%')
                ->orwhere('region', 'like', '%' . $search . '%')
                ->orwhere('add', 'like', '%' . $search . '%')
                ->orderBy('id', 'desc')->get();
            $result_arr = array();

            foreach ($result as $key => $value) {
                $result_arr_item = array();
                $result_arr_item['id'] = $value->id;
                $result_arr_item['bh'] = $value->bh;
                $result_arr_item['name'] = $value->name;
                $result_arr_item['region'] = $value->region;
                $result_arr_item['lon'] = $value->lon;
                $result_arr_item['lat'] = $value->lat;
                $result_arr_item['add'] = $value->add;
                $result_arr[] = $result_arr_item;
            }

            return view('jizhan.index', compact('result_arr', 'page', 'page_index', 'jizhanserarch', 'search'));
        } catch (QueryException $e) {
            echo mb_convert_encoding($e, "UTF-8", "GBK");
            die;
            self::log('ResController 数据库错误，信息：' . mb_convert_encoding($e, "UTF-8", "GBK"));
            return redirect()->route('root')->with('danger', '数据库错误，请联系管理员：liyt');
        }
    }
    protected function log($content)
    {
        $filename = 'log/address.log';
        $output = '#' . date('Y-m-d H:i:s') . '# ' . $content . PHP_EOL;
        file_put_contents($filename, $output, FILE_APPEND);
    }
}
