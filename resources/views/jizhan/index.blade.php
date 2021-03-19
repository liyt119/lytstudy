@extends('layouts.default')
@section('title','基站信息表')

@section('content')
<div class="offset-md-1 col-md-10">
    <div class="card">
        <div class="card-header">
            <div class="card-body">
            @isset($result_arr)
                @include('jizhan._header1')
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col" width="80px">id</th>
                            <th scope="col" width="80px">基站编号</th>
                            <th scope="col" width="80px">基站名称</th>
                            <th scope="col" width="80px">端局</th>
                            <th scope="col" width="80px">经度</th>
                            <th scope="col" width="80px">纬度</th>
                            <th scope="col" width="80px">基站站址</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result_arr as $key => $register)
                        <tr>
                            <td>{{ $register['id'] }}</td>
                            <td>{{ $register['bh'] }}</td>
                            <td>{{ $register['name'] }}</td>
                            <td>{{ $register['region'] }}</td>
                            <td>{{ $register['lon'] }}</td>
                            <td>{{ $register['lat'] }}</td>
                            <td>{{ $register['add'] }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endisset
            </div>
        </div>
    </div>
</div>

@stop