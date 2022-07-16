@extends('layouts.admin')
@section('title','Trang tổng quan')
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
      <li style="list-style: none" class="">Vui lòng kiểm tra lại dữ liệu </li>
</div>
@endif
<form action="" method="post">
      @csrf
      <h1>Sửa group</h1>
      <div class="form-group">
            <label for="simpleinput">Tên</label>
            <input value="{{ old('name') ??  $group ->name}}" type="text" name="name" id="simpleinput"
                  class="form-control">

            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
      </div>
      <button type="submit" class="btn btn-primary">Sửa</button>
</form>
@endsection