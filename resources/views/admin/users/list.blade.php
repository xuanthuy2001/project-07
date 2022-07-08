@extends('layouts.admin')

@section('title','Trang tổng quan')


@section('content') <p><a class="btn btn-primary" href="{{route('admin.users.add')}}">Thêm mới</a></p>
<div class="d-sm-flex align-items-center justify-content-between mb-4">

      <table class="table table-bordered table-centered mb-0">
            <thead>
                  <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Nhóm</th>
                        <th class="text-center">Action</th>
                  </tr>
            </thead>
            <tbody>

                  @foreach ($list as $key => $item)
                  <tr>
                        <td class="table-user">
                              {{ $key +1 }}
                        </td>
                        <td>{{$item ->name}}</td>
                        <td>{{$item ->email}}</td>
                        <td>{{$item ->group ->name}}</td>
                        <td class="table-action d-flex justify-content-between">
                              <a href="{{route('admin.users.edit',$item)}}" class="action-icon"> <i
                                          class="fa-solid fa-pencil"></i></a>
                              |
                              <a href="{{route('admin.users.delete',$item)}}" class="action-icon"> <i
                                          class="fa-solid fa-delete-left"></i></a>
                        </td>
                  </tr>
                  @endforeach


            </tbody>
      </table>
</div>
@endsection