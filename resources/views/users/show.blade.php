@extends('layouts.default')

@section('content')

<div class="offset-md-1 col-md-10">
  <div class="card">
    <div class="card-header">
      <div class="card-body">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">id</th>
              <th scope="col">姓名</th>
              <th scope="col">邮箱</th>
              <th scope="col">头像</th>
              <th scope="col">上传</th>
            </tr>
          </thead>
          <tbody>
            @foreach($user as $key => $use)
            <tr>
              <th scope="row">{{$use->id}}</th>
              <td>{{$use->name}}</td>
              <td width="120px">{{$use->email}}</td>
              <td><img src="{{ $use->avatar}}" width="50" height="50" alt="{{$use->name}}" class="gravatar"></td>
              <td><input type="file" name="avatar" class="form-control-file" ><br>
              <button type="submit" class="btn btn-outline-primary">提交</button>
              </div>

              </td>
              
            </tr>
          </tbody>
          @endforeach
        </table>
        {{ $user->links() }}
      </div>
    </div>
  </div>
</div>



@stop