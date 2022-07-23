<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    private object $model;

    public function __construct()

    {
        $this->model =  Posts::query();
    }

    public function index(Request $request)
    {
        $userSelect = $request->get('user');

        $query = $this->model;
        if (!empty($userSelect) && $userSelect !== 'All') {
            $query->where('user_id', $userSelect);
        }

        $users = User::all();

        $lists = $query->paginate(2);
        return view('admin.posts.list', compact('lists', 'users', 'userSelect'));
    }

    public function add()
    {
        dd("day la trang thêm PostsController");
    }
}