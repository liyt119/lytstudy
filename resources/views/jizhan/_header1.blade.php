<form  method="post" action="{{route('jizhan.search')}}">
@csrf
<div class="input-group mb-3">
    <input type="text" name="search"  class="form-control" id="search" @isset($jizhanserarch){{ $jizhanserarch }}@endisset placeholder="请输入基站编号、名称、端局、站址搜索">
    <button id="search-btn" class="btn btn-outline-secondary">搜索</button>
</div>
</form>
