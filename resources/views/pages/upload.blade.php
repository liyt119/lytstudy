@extends('layouts.default')
@section('title','导入文件')

@section('content')
<div class="offset-md-1 col-md-10">
  <div class="card">
    <div class="card-header">
      <div class="card-body">
      <form action="{{ route('upload')}}" method="GET" accept-charset="UTF-8" enctype="multipart/form-data">
      <input type="hidden" name="_method" value="GET">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      


      <div class="form-group">
      <label for="" class="avatar-label">导入文件</label>
      <input type="file" name="avatar" class="form-control-file">
      </div>

      <div class="well well-sm">
      <button type="submit" class="btn btn-primary">提交</button></div>

      <div class="form-group">
      <label for="" class="avatar-label">显示文件</label>
      
      </div>

      <div class="input-group-prepend">
    <span class="input-group-text">{{ $data }}</span>
  </div>


      </form>

      </div>
    
      </div>
    </div>
  </div>
</div>

@stop 