<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Cafeshop extends Controller
{
     public function add()
    {
        return view('admin.cafeshop.create');
    }

    public function create()
    {
        return redirect('admin/cafeshop/create');
    }

    public function edit()
    {
        return view('admin.cafeshop.edit');
    }

    public function update()
    {
        return redirect('admin/cafeshop/edit');
    }
}
