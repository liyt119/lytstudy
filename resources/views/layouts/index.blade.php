@extends('layouts.default')
@section('title','基站信息表')
@section('content')

<div class="offset-md-1 col-md-10">
  <div class="card">
    <div class="card-header">
      <div class="card-body">
        @include('jizhan._header1')
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">id</th>
              <th scope="col">基站编号</th>
              <th scope="col">基站名称</th>
              <th scope="col">端局</th>
              <th scope="col">经度</th>
              <th scope="col">纬度</th>
              <th scope="col">基站站址</th>
            </tr>
          </thead>
          <tbody>
            @foreach($jizhans as $key => $jz)
            <tr>
              <td scope="row">{{$jz->id}}</td>
              <td>{{$jz->bh}}</td>
              <td width="120px">{{$jz->name}}</td>
              <td>{{$jz->region}}</td>
              <td>{{$jz->lon}}</td>
              <td>{{$jz->lat}}</td>
              <td>{{$jz->add}}</td>
            </tr> 
            @endforeach
          </tbody>
        </table>
        {{ $jizhans->links() }}
      </div>
    </div>
  </div>
</div>
@stop