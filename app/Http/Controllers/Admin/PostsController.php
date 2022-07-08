<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        dd("day la trang PostsController");
    }

    public function add()
    {
        dd("day la trang thêm PostsController");
    }
}