<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $list = User::all();
        return view('admin.users.list', compact('list'));
    }

    public function add()
    {
        return view('admin.users.add');
    }
    public function edit()
    {
        return view('admin.users.add');
    }

    public function delete()
    {
    }
}