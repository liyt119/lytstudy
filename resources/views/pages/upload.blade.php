@extends('layouts.default')
@section('title','导入文件')

@section('content')
<div class="offset-md-1 col-md-10">
  <div class="card">
    <div class="card-header">
      <div class="card-body">

        <form action="{{ route('registers.import')}}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
          <input type="hidden" name="_method" value="GET">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label for="" class="avatar-label">导入文件</label>
            <input type="file" name="csv" id="csv" accept="text/csv" class="form-control-file">
            <label for="" class="avatar-label">要导入的文件放置于lytstudy/public下，并以users.xlsx命名,直接点击提交按钮即可。</label>
          </div>

          <div class="well well-sm">
            <button type="submit" class="btn btn-primary">导入提交</button>
          </div>

          <div class="form-group">
            <label for="" class="avatar-label">显示文件</label>
          </div>
        </form>

        <form action="{{ route('registers.export')}}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
          <input type="hidden" name="_method" value="GET">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="well well-sm">
            <button type="submit" class="btn btn-primary">导出提交</button>
            <label for="" class="avatar-label">导出用户信息。</label>
          </div>
        </form>

        
      </div>
    </div>
  </div>
</div>
</div> 

@stop