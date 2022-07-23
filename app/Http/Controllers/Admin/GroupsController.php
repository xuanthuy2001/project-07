<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupAddRequest;
use App\Http\Requests\GroupEditRequest;
use App\Http\Requests\PostAddRequest;
use App\Http\Requests\PostEditRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Modules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function index()
    {
        $lists = Group::latest('id')->paginate(2);
        return view('admin.groups.list', compact('lists'));
    }
    public function add()
    {
        $groups = Group::all();
        return view('admin.groups.add', compact('groups'));
    }

    public function postAdd(GroupAddRequest $request)
    {
        $group = new Group();
        $group->name = $request->name;
        $group->user_id = Auth::user()->id;
        $group->save();
        return redirect(route('admin.groups.index'))->with('message', 'Thêm nhóm thành công');
    }
    public function edit(Group $group)
    {

        return view('admin.groups.edit', compact('group'));
    }
    public function postEdit(GroupEditRequest $request, Group $group)
    {
        $group->name = $request->name;
        $group->user_id = Auth::user()->id;
        $group->save();
        return redirect(route('admin.groups.index'))->with('message', 'Cập nhật thành công');
    }
    public function delete(Group $group)
    {
        $userCount = $group->users->count();
        if ($userCount == 0) {

            Group::destroy($group->id);
            return redirect(route('admin.groups.index'))->with('message', 'Xóa thành công');
        }
        return redirect(route('admin.groups.index'))->with('message', 'Trong nhóm vẫn còn ' . $userCount . 'nguời dùng');
    }
    public function permission(Group $group)
    {

        $modules = Modules::all();

        $roleListArr = [
            'view' => 'Xem',
            'add' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
        ];
        $roleJson = $group->permission;
        if (!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
        } else {
            $roleArr = [];
        }
        // $roleArr = $roleArr['user'];
        // dd($roleArr);
        // foreach ($modules as $module) {
        //     echo $module->name . '<br/>';
        // }
        // dd();

        return view('admin.groups.permission', compact(
            'group',
            'modules',
            'roleListArr',
            'roleArr',
        ));
    }

    public function postPermission(Group $group, Request $request)
    {
        if (!empty($request->role)) {
            $roleArr = $request->role;
        } else {
            $roleArr = null;
        }

        $roleJson = json_encode($roleArr);
        $group->permission = $roleJson;
        $group->save();
        return redirect(route('admin.groups.index'))->with('message', 'Phân quyền thành công');
    }
}