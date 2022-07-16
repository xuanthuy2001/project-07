<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostAddRequest;
use App\Http\Requests\PostEditRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $lists = User::paginate(2);

        return view('admin.users.list', compact('lists'));
    }

    public function add()
    {
        $groups = Group::all();
        return view('admin.users.add', compact('groups'));
    }

    public function postAdd(PostAddRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->group_id = $request->group_id;
        $user->user_id = Auth::user()->id;

        $user->save();
        return redirect('admin/users')->with('message', 'Thêm thành công');
    }
    public function edit(User $user)
    {
        $groups = Group::all();
        return view('admin.users.edit', compact('user', 'groups'));
    }
    public function postEdit(PostEditRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->group_id = $request->group_id;
        $user->user_id = Auth::user()->id;

        $user->save();
        return redirect('admin/users')->with('message', 'Cập nhật thành công');
    }

    public function delete(User $user)
    {

        User::destroy($user->id);

        return redirect('admin/users')->with('message', 'Xóa thành công');
    }
}