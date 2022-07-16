<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupAddRequest;
use App\Http\Requests\GroupEditRequest;
use App\Http\Requests\PostAddRequest;
use App\Http\Requests\PostEditRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
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
}