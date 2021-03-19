<?php

namespace App\Http\Controllers;

use App\Models\Jizhan;
use App\Models\User;
use App\Handlers\UploadHandler;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $jizhans = Jizhan::orderBy('id', 'desc')->paginate(9);
        return view('layouts.index', compact('jizhans'));
    }

    public function map()
    {
        $jizhans = Jizhan::orderBy('id', 'desc')->get();
        $arr = array();
        foreach ($jizhans as $key => $value) {
            $arr_item = array();
            $arr_item['id'] = $value->id;
            $arr_item['bh'] = $value->bh;
            $arr_item['lon'] = $value->lon;
            $arr_item['lat'] = $value->lat;
            $arr_item['name'] = $value->name;
            $arr_item['region'] = $value->region;
            $arr[] = $arr_item;
        }
        $jizhan_sum = json_encode($arr);
        //$jizhan_sum=$arr;
        //print_r($jizhan_sum);die;
        //echo $jizhan_sum;die;
        return view('pages.map', compact('jizhans', 'jizhan_sum'));
    }

    public function upload(Request $request)
    {
        //dd($request->avatar);
        $data = $request->avatar;
        //dd($data);
        return view('pages.upload', compact('data'));
    }
}

