@extends('layouts.admin')

@section('title','Phân quyền nhóm')


@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
      {{ session()->get('message') }}
</div>
@endif
<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 ">Phân quyền nhóm : {{$group -> name}}</h1>
</div>
<form action="" method="post">
      @csrf
      <table class="table table-borderd">
            <thead>
                  <tr>
                        <th width="20%"> Module</th>
                        <th> Quyền</th>
                  </tr>
            </thead>

            <tbody>
                  @foreach ($modules as $module )
                  <tr>
                        <td>{{ $module -> title}}</td>
                        <td>
                              <div class="row ">
                                    @if (!empty($roleListArr))
                                    @foreach ($roleListArr as $roleName => $roleLabel)
                                    <div class="col-2 form-check">
                                          <label class="form-check-label" for="role_{{$module->name}}_{{$roleName}}">
                                                <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                value="{{$roleName}}"
                                                id="role_{{$module->name}}_{{$roleName}}"
                                                name="role[{{$module->name }}][]"
                                                {{ isRole($roleArr , $module->name , $roleName) ? 'checked':false }}  >
                                                {{$roleLabel}}
                                          </label>
                                    </div>
                                    @endforeach
                                    @endif
                                    @if ($module -> name == 'groups')
                                    <div class="col-2 form-check">
                                          <label class="form-check-label" for="role_{{$module->name}}_permission">
                                                <input class="form-check-input" type="checkbox" value="permission"
                                                      name="role[{{$module->name }}]"
                                                      id="role_{{$module->name}}_permission" {{ isRole($roleArr , $module->name , $roleName) ? 'checked':false }}   />
                                                Phân quyền
                                          </label>
                                    </div>
                                    @endif
                              </div>
                        </td>

                  </tr>
                  @endforeach

            </tbody>


      </table>

      <button class="btn btn-primary" type="submit">Phân quyền</button>
</form>


@endsection