@extends('layouts.admin')

@section('title','Trang tổng quan')


@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
      {{ session()->get('message') }}
</div>
@endif

<div class="row">

      <div class="col-sm-12 col-md-6">

            <a class="btn btn-primary" href="{{route('admin.groups.add')}}">Thêm mới</a>
      </div>
      <div class="col-sm-12 col-md-6">

            <form class="float-right form-inline form-group">
                  <div id="dataTable_filter" class="dataTables_filter d-flex justify-content-end   flex-row">
                        <input type="search" class="form-control ds-input text-primary" placeholder="Search..."
                              aria-controls="dataTable">
                  </div>

            </form>
      </div>

</div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">

      <table class="table table-bordered table-centered mb-0">
            <thead>
                  <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Phân quyền</th>
                        <th>user_login_name</th>
                        <th class="text-center">Action</th>
                  </tr>
            </thead>
            <tbody>

                  @foreach ($lists as $key => $item)
                  <tr>
                        <td class="table-user">
                              {{ $key +1 }}
                        </td>
                        <td>{{$item ->name}}</td>
                        <td><a class="btn btn-primary" href="">
                                    phân quyền
                              </a></td>
                        <td>{{!empty($item->postBy ->name) ? $item->postBy ->name  : ''}}</td>
                        <td class="table-action d-flex justify-content-between">
                              <a href="{{route('admin.groups.edit',$item)}}" class="action-icon"> <i
                                          class="fa-solid fa-pencil"></i></a>
                              |

                              <form class="float-right m-0" method="post"
                                    action="{{route('admin.groups.delete',$item)}}">
                                    @method('delete')
                                    @csrf
                                    <div class="form-row">
                                          <input type="hidden" name="userID" value="{{ $item->id }}">
                                          <button> <i class="fa fa-trash-alt"></i></button>
                                    </div>
                              </form>


                        </td>
                  </tr>

                  @endforeach
            </tbody>

      </table>
</div>

{{ $lists->links() }}

@endsection