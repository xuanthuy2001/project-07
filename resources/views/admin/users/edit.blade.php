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
      <h1>thêm người dùng</h1>
      <div class="form-group">
            <label for="simpleinput">Tên</label>
            <input value="{{ old('name') ??  $user ->name}}" type="text" name="name" id="simpleinput"
                  class="form-control">

            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
      </div>
      <div class="form-group">
            <label for="example-email">Email</label>
            <input value="{{ old('email') ??  $user ->email}}" id="example-email" name="email" class="form-control"
                  placeholder="Email">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
      </div>
      <div class="form-group">
            <label for="example-password">Mật khẩu</label>
            <input type="password" name="password" id="example-password" class="form-control" placeholder="password">

            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
      </div>

      <div class="form-group">
            <label for="example-select">Nhóm</label>
            <select class="form-control" id="example-select" name="group_id">

                  @if ($groups->count() >0)
                  @foreach ($groups as $group )
                  <option {{ $user ->group_id == $group ->id ? 'selected' :'' }} value={{ $group ->id  }}>
                        {{ $group ->name  }}
                  </option>
                  @endforeach
                  @endif
            </select>

            @error('group_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
      </div>
      <button type="submit" class="btn btn-primary">Sửa</button>
</form>
@endsection