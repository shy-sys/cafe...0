<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Shop extends Controller
{
  // 以下を追記
  public function add()
  {
      return view('admin.shop.top');
  }
   public function create(Request $request)
  {
      // admin/shop/topにリダイレクトする
      return redirect('admin/shop/top');
  }  

}