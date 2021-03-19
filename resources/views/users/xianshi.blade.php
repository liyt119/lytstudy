@extends('layouts.default')
@section('title','显示文件')

@section('content')
<div class="offset-md-1 col-md-10">
  <div class="card">
    <div class="card-header">
      <div class="card-body">
      @isset($result_arr)
      <table class="table table-bordered table-sm">
        <thead>
        <tr>
        
        <th scope="col" width="80px">id</th>
          <th scope="col" width="80px">姓名</th>
          <th scope="col">邮箱</th>
          <th scope="col" width="150px">操作</th>
        
        </tr>
        </thead>

        <tbody>
        @foreach ($result_arr as $key => $value)
        <tr>
              <td>{{ $value['id'] }}</td>
              <td>{{ $value['name'] }}</td>
              <td>{{ $value['email'] }}</td>
           
        </tr>
        @endforeach
        </tbody>
      </table>
      @if(count($result_arr) == $page)
      <div style="text-align: center;font-weight: bold;height: 250px;">
        <span>仅显示前{{ $page }}条记录</span>
      </div>
    @endif 
    @endisset

    
    
      </div>
    </div>
  </div>
</div>

@stop 