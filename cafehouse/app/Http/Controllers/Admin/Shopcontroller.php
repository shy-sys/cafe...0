<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Shopcontroller extends Controller
{
  // 以下を追記
  public function add()
  {
      return view('admin.shop.create');
  }
   public function create(Request $request)
  {
      // admin/shop/createにリダイレクトする
      return redirect('admin/shop/create');
  }  
 // 以下を追記
public function create(Request $request){
     
     
      // 以下を追記
      // Varidationを行う
      $this->validate($request, Shop::$rules);
      $shop = new Shop;
      $form = $request->all();

      // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $shop->image_path = basename($path);
      } else {
        $news->image_path = null;
      }

      unset($form['_token']);
      unset($form['image']);

      // データベースに保存する
      $news->fill($form);
      $news->save();

     
      return redirect('admin/shop/create');
 }  
 
public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
      $posts = Shop::where('title', $cond_title)->get();
      } else {
      $posts = Shop::all();
      }
      return view('admin.shop.top', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

 // 以下を追記

public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $shop = Shop::find($request->id);
      if (empty($shop)) {
        abort(404);    
      }
      return view('admin.shop.edit', ['shop_form' => $shop]);
  }

public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Shop::$rules);
      // News Modelからデータを取得する
      $shop = Shop::find($request->id);
      // 送信されてきたフォームデータを格納する
      $news_form = $request->all();
      if ($request->remove == 'true') {
          $shop_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = $request->file('image')->store('public/image');
          $shop_form['image_path'] = basename($path);
      } else {
          $shop_form['image_path'] = $shop->image_path;
      }

      unset($shop_form['image']);
      unset($shop_form['remove']);
      unset($shop_form['_token']);
      // 該当するデータを上書きして保存する
      $shop->fill($shop_form)->save();
      
      // 以下を追記
      $history =shop History;
      $history->shop_id = $shop->id;
      $history->edited_at = Carbon::now();
      $history->save();
        
      return redirect('admin/shop');
  }
// 以下を追記　　
  public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $shop = Shop::find($request->id);
      // 削除する
      $news->delete();
      return redirect('admin/shop/');
  }  
 
}
