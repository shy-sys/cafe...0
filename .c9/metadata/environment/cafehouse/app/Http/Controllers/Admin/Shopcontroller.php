{"filter":false,"title":"Shopcontroller.php","tooltip":"/cafehouse/app/Http/Controllers/Admin/Shopcontroller.php","undoManager":{"mark":100,"position":100,"stack":[[{"start":{"row":7,"column":6},"end":{"row":7,"column":7},"action":"insert","lines":["S"],"id":130}],[{"start":{"row":7,"column":6},"end":{"row":7,"column":7},"action":"remove","lines":["S"],"id":131},{"start":{"row":7,"column":6},"end":{"row":7,"column":10},"action":"insert","lines":["Side"]}],[{"start":{"row":7,"column":9},"end":{"row":7,"column":10},"action":"remove","lines":["e"],"id":132},{"start":{"row":7,"column":8},"end":{"row":7,"column":9},"action":"remove","lines":["d"]},{"start":{"row":7,"column":7},"end":{"row":7,"column":8},"action":"remove","lines":["i"]}],[{"start":{"row":17,"column":29},"end":{"row":17,"column":30},"action":"remove","lines":["s"],"id":133}],[{"start":{"row":17,"column":29},"end":{"row":17,"column":30},"action":"insert","lines":["s"],"id":134}],[{"start":{"row":12,"column":32},"end":{"row":12,"column":33},"action":"remove","lines":["p"],"id":135},{"start":{"row":12,"column":31},"end":{"row":12,"column":32},"action":"remove","lines":["o"]},{"start":{"row":12,"column":30},"end":{"row":12,"column":31},"action":"remove","lines":["t"]}],[{"start":{"row":12,"column":30},"end":{"row":12,"column":31},"action":"insert","lines":["c"],"id":136},{"start":{"row":12,"column":31},"end":{"row":12,"column":32},"action":"insert","lines":["r"]},{"start":{"row":12,"column":32},"end":{"row":12,"column":33},"action":"insert","lines":["e"]}],[{"start":{"row":12,"column":30},"end":{"row":12,"column":33},"action":"remove","lines":["cre"],"id":137},{"start":{"row":12,"column":30},"end":{"row":12,"column":36},"action":"insert","lines":["create"]}],[{"start":{"row":17,"column":36},"end":{"row":17,"column":37},"action":"remove","lines":["p"],"id":138},{"start":{"row":17,"column":35},"end":{"row":17,"column":36},"action":"remove","lines":["o"]},{"start":{"row":17,"column":34},"end":{"row":17,"column":35},"action":"remove","lines":["t"]}],[{"start":{"row":17,"column":34},"end":{"row":17,"column":35},"action":"insert","lines":["c"],"id":139},{"start":{"row":17,"column":35},"end":{"row":17,"column":36},"action":"insert","lines":["r"]},{"start":{"row":17,"column":36},"end":{"row":17,"column":37},"action":"insert","lines":["e"]}],[{"start":{"row":17,"column":34},"end":{"row":17,"column":37},"action":"remove","lines":["cre"],"id":140},{"start":{"row":17,"column":34},"end":{"row":17,"column":40},"action":"insert","lines":["create"]}],[{"start":{"row":16,"column":22},"end":{"row":16,"column":23},"action":"remove","lines":["p"],"id":141},{"start":{"row":16,"column":21},"end":{"row":16,"column":22},"action":"remove","lines":["o"]},{"start":{"row":16,"column":20},"end":{"row":16,"column":21},"action":"remove","lines":["t"]}],[{"start":{"row":16,"column":20},"end":{"row":16,"column":21},"action":"insert","lines":["c"],"id":142},{"start":{"row":16,"column":21},"end":{"row":16,"column":22},"action":"insert","lines":["r"]},{"start":{"row":16,"column":22},"end":{"row":16,"column":23},"action":"insert","lines":["e"]}],[{"start":{"row":16,"column":23},"end":{"row":16,"column":24},"action":"insert","lines":["a"],"id":143},{"start":{"row":16,"column":24},"end":{"row":16,"column":25},"action":"insert","lines":["t"]},{"start":{"row":16,"column":25},"end":{"row":16,"column":26},"action":"insert","lines":["e"]}],[{"start":{"row":19,"column":0},"end":{"row":112,"column":1},"action":"insert","lines":[" // 以下を追記","public function create(Request $request){","     ","     ","      // 以下を追記","      // Varidationを行う","      $this->validate($request, News::$rules);","      $news = new News;","      $form = $request->all();","","      // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する","      if (isset($form['image'])) {","        $path = $request->file('image')->store('public/image');","        $news->image_path = basename($path);","      } else {","        $news->image_path = null;","      }","","      unset($form['_token']);","      unset($form['image']);","","      // データベースに保存する","      $news->fill($form);","      $news->save();","","     ","      return redirect('admin/news/create');"," }  "," ","public function index(Request $request)","  {","      $cond_title = $request->cond_title;","      if ($cond_title != '') {","      $posts = News::where('title', $cond_title)->get();","      } else {","      $posts = News::all();","      }","      return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);","  }",""," // 以下を追記","","public function edit(Request $request)","  {","      // News Modelからデータを取得する","      $news = News::find($request->id);","      if (empty($news)) {","        abort(404);    ","      }","      return view('admin.news.edit', ['news_form' => $news]);","  }","","public function update(Request $request)","  {","      // Validationをかける","      $this->validate($request, News::$rules);","      // News Modelからデータを取得する","      $news = News::find($request->id);","      // 送信されてきたフォームデータを格納する","      $news_form = $request->all();","      if ($request->remove == 'true') {","          $news_form['image_path'] = null;","      } elseif ($request->file('image')) {","          $path = $request->file('image')->store('public/image');","          $news_form['image_path'] = basename($path);","      } else {","          $news_form['image_path'] = $news->image_path;","      }","","      unset($news_form['image']);","      unset($news_form['remove']);","      unset($news_form['_token']);","      // 該当するデータを上書きして保存する","      $news->fill($news_form)->save();","      ","      // 以下を追記","      $history = new History;","      $history->news_id = $news->id;","      $history->edited_at = Carbon::now();","      $history->save();","        ","      return redirect('admin/news');","  }","// 以下を追記　　","  public function delete(Request $request)","  {","      // 該当するNews Modelを取得","      $news = News::find($request->id);","      // 削除する","      $news->delete();","      return redirect('admin/news/');","  }  "," ","}"],"id":144}],[{"start":{"row":25,"column":35},"end":{"row":25,"column":36},"action":"remove","lines":["s"],"id":145},{"start":{"row":25,"column":34},"end":{"row":25,"column":35},"action":"remove","lines":["w"]},{"start":{"row":25,"column":33},"end":{"row":25,"column":34},"action":"remove","lines":["e"]},{"start":{"row":25,"column":32},"end":{"row":25,"column":33},"action":"remove","lines":["N"]}],[{"start":{"row":25,"column":32},"end":{"row":25,"column":33},"action":"insert","lines":["S"],"id":146},{"start":{"row":25,"column":33},"end":{"row":25,"column":34},"action":"insert","lines":["h"]},{"start":{"row":25,"column":34},"end":{"row":25,"column":35},"action":"insert","lines":["o"]},{"start":{"row":25,"column":35},"end":{"row":25,"column":36},"action":"insert","lines":["p"]}],[{"start":{"row":26,"column":21},"end":{"row":26,"column":22},"action":"remove","lines":["s"],"id":147},{"start":{"row":26,"column":20},"end":{"row":26,"column":21},"action":"remove","lines":["w"]},{"start":{"row":26,"column":19},"end":{"row":26,"column":20},"action":"remove","lines":["e"]},{"start":{"row":26,"column":18},"end":{"row":26,"column":19},"action":"remove","lines":["N"]}],[{"start":{"row":26,"column":18},"end":{"row":26,"column":19},"action":"insert","lines":["S"],"id":148}],[{"start":{"row":26,"column":19},"end":{"row":26,"column":20},"action":"insert","lines":["h"],"id":149},{"start":{"row":26,"column":20},"end":{"row":26,"column":21},"action":"insert","lines":["o"]},{"start":{"row":26,"column":21},"end":{"row":26,"column":22},"action":"insert","lines":["p"]}],[{"start":{"row":26,"column":22},"end":{"row":27,"column":0},"action":"insert","lines":["",""],"id":150},{"start":{"row":27,"column":0},"end":{"row":27,"column":6},"action":"insert","lines":["      "]}],[{"start":{"row":27,"column":5},"end":{"row":27,"column":6},"action":"remove","lines":[" "],"id":151},{"start":{"row":27,"column":4},"end":{"row":27,"column":5},"action":"remove","lines":[" "]},{"start":{"row":27,"column":0},"end":{"row":27,"column":4},"action":"remove","lines":["    "]},{"start":{"row":26,"column":22},"end":{"row":27,"column":0},"action":"remove","lines":["",""]}],[{"start":{"row":26,"column":10},"end":{"row":26,"column":11},"action":"remove","lines":["s"],"id":152},{"start":{"row":26,"column":9},"end":{"row":26,"column":10},"action":"remove","lines":["w"]},{"start":{"row":26,"column":8},"end":{"row":26,"column":9},"action":"remove","lines":["e"]},{"start":{"row":26,"column":7},"end":{"row":26,"column":8},"action":"remove","lines":["n"]}],[{"start":{"row":26,"column":7},"end":{"row":26,"column":8},"action":"insert","lines":["s"],"id":153},{"start":{"row":26,"column":8},"end":{"row":26,"column":9},"action":"insert","lines":["h"]},{"start":{"row":26,"column":9},"end":{"row":26,"column":10},"action":"insert","lines":["o"]},{"start":{"row":26,"column":10},"end":{"row":26,"column":11},"action":"insert","lines":["p"]}],[{"start":{"row":32,"column":12},"end":{"row":32,"column":13},"action":"remove","lines":["s"],"id":154},{"start":{"row":32,"column":11},"end":{"row":32,"column":12},"action":"remove","lines":["w"]},{"start":{"row":32,"column":10},"end":{"row":32,"column":11},"action":"remove","lines":["e"]},{"start":{"row":32,"column":9},"end":{"row":32,"column":10},"action":"remove","lines":["n"]}],[{"start":{"row":32,"column":9},"end":{"row":32,"column":10},"action":"insert","lines":["s"],"id":155},{"start":{"row":32,"column":10},"end":{"row":32,"column":11},"action":"insert","lines":["h"]},{"start":{"row":32,"column":11},"end":{"row":32,"column":12},"action":"insert","lines":["o"]},{"start":{"row":32,"column":12},"end":{"row":32,"column":13},"action":"insert","lines":["p"]}],[{"start":{"row":45,"column":32},"end":{"row":45,"column":33},"action":"remove","lines":["s"],"id":156},{"start":{"row":45,"column":31},"end":{"row":45,"column":32},"action":"remove","lines":["w"]},{"start":{"row":45,"column":30},"end":{"row":45,"column":31},"action":"remove","lines":["e"]},{"start":{"row":45,"column":29},"end":{"row":45,"column":30},"action":"remove","lines":["n"]}],[{"start":{"row":45,"column":29},"end":{"row":45,"column":30},"action":"insert","lines":["a"],"id":157}],[{"start":{"row":45,"column":29},"end":{"row":45,"column":30},"action":"remove","lines":["a"],"id":158}],[{"start":{"row":45,"column":29},"end":{"row":45,"column":30},"action":"insert","lines":["s"],"id":159},{"start":{"row":45,"column":30},"end":{"row":45,"column":31},"action":"insert","lines":["h"]},{"start":{"row":45,"column":31},"end":{"row":45,"column":32},"action":"insert","lines":["o"]},{"start":{"row":45,"column":32},"end":{"row":45,"column":33},"action":"insert","lines":["p"]}],[{"start":{"row":52,"column":18},"end":{"row":52,"column":19},"action":"remove","lines":["s"],"id":160},{"start":{"row":52,"column":17},"end":{"row":52,"column":18},"action":"remove","lines":["w"]},{"start":{"row":52,"column":16},"end":{"row":52,"column":17},"action":"remove","lines":["e"]},{"start":{"row":52,"column":15},"end":{"row":52,"column":16},"action":"remove","lines":["N"]}],[{"start":{"row":52,"column":15},"end":{"row":52,"column":16},"action":"insert","lines":["S"],"id":161},{"start":{"row":52,"column":16},"end":{"row":52,"column":17},"action":"insert","lines":["h"]},{"start":{"row":52,"column":17},"end":{"row":52,"column":18},"action":"insert","lines":["h"]}],[{"start":{"row":52,"column":17},"end":{"row":52,"column":18},"action":"remove","lines":["h"],"id":162}],[{"start":{"row":52,"column":17},"end":{"row":52,"column":18},"action":"insert","lines":["o"],"id":163},{"start":{"row":52,"column":18},"end":{"row":52,"column":19},"action":"insert","lines":["p"]}],[{"start":{"row":54,"column":18},"end":{"row":54,"column":19},"action":"remove","lines":["s"],"id":164},{"start":{"row":54,"column":17},"end":{"row":54,"column":18},"action":"remove","lines":["w"]},{"start":{"row":54,"column":16},"end":{"row":54,"column":17},"action":"remove","lines":["e"]},{"start":{"row":54,"column":15},"end":{"row":54,"column":16},"action":"remove","lines":["N"]}],[{"start":{"row":54,"column":15},"end":{"row":54,"column":16},"action":"insert","lines":["S"],"id":165},{"start":{"row":54,"column":16},"end":{"row":54,"column":17},"action":"insert","lines":["h"]},{"start":{"row":54,"column":17},"end":{"row":54,"column":18},"action":"insert","lines":["o"]},{"start":{"row":54,"column":18},"end":{"row":54,"column":19},"action":"insert","lines":["p"]}],[{"start":{"row":56,"column":28},"end":{"row":56,"column":29},"action":"remove","lines":["s"],"id":166},{"start":{"row":56,"column":27},"end":{"row":56,"column":28},"action":"remove","lines":["w"]},{"start":{"row":56,"column":26},"end":{"row":56,"column":27},"action":"remove","lines":["e"]},{"start":{"row":56,"column":25},"end":{"row":56,"column":26},"action":"remove","lines":["n"]}],[{"start":{"row":56,"column":25},"end":{"row":56,"column":26},"action":"insert","lines":["s"],"id":167},{"start":{"row":56,"column":26},"end":{"row":56,"column":27},"action":"insert","lines":["h"]},{"start":{"row":56,"column":27},"end":{"row":56,"column":28},"action":"insert","lines":["o"]},{"start":{"row":56,"column":28},"end":{"row":56,"column":29},"action":"insert","lines":["p"]}],[{"start":{"row":56,"column":34},"end":{"row":56,"column":35},"action":"remove","lines":["x"],"id":168},{"start":{"row":56,"column":33},"end":{"row":56,"column":34},"action":"remove","lines":["e"]}],[{"start":{"row":56,"column":32},"end":{"row":56,"column":33},"action":"remove","lines":["d"],"id":169},{"start":{"row":56,"column":31},"end":{"row":56,"column":32},"action":"remove","lines":["n"]},{"start":{"row":56,"column":30},"end":{"row":56,"column":31},"action":"remove","lines":["i"]}],[{"start":{"row":56,"column":30},"end":{"row":56,"column":31},"action":"insert","lines":["t"],"id":170},{"start":{"row":56,"column":31},"end":{"row":56,"column":32},"action":"insert","lines":["o"]},{"start":{"row":56,"column":32},"end":{"row":56,"column":33},"action":"insert","lines":["p"]}],[{"start":{"row":64,"column":17},"end":{"row":64,"column":18},"action":"remove","lines":["s"],"id":171},{"start":{"row":64,"column":16},"end":{"row":64,"column":17},"action":"remove","lines":["w"]},{"start":{"row":64,"column":15},"end":{"row":64,"column":16},"action":"remove","lines":["e"]},{"start":{"row":64,"column":14},"end":{"row":64,"column":15},"action":"remove","lines":["N"]}],[{"start":{"row":64,"column":14},"end":{"row":64,"column":15},"action":"insert","lines":["S"],"id":172},{"start":{"row":64,"column":15},"end":{"row":64,"column":16},"action":"insert","lines":["h"]},{"start":{"row":64,"column":16},"end":{"row":64,"column":17},"action":"insert","lines":["o"]},{"start":{"row":64,"column":17},"end":{"row":64,"column":18},"action":"insert","lines":["p"]}],[{"start":{"row":64,"column":10},"end":{"row":64,"column":11},"action":"remove","lines":["s"],"id":173},{"start":{"row":64,"column":9},"end":{"row":64,"column":10},"action":"remove","lines":["w"]},{"start":{"row":64,"column":8},"end":{"row":64,"column":9},"action":"remove","lines":["e"]},{"start":{"row":64,"column":7},"end":{"row":64,"column":8},"action":"remove","lines":["n"]}],[{"start":{"row":64,"column":7},"end":{"row":64,"column":8},"action":"insert","lines":["s"],"id":174},{"start":{"row":64,"column":8},"end":{"row":64,"column":9},"action":"insert","lines":["h"]},{"start":{"row":64,"column":9},"end":{"row":64,"column":10},"action":"insert","lines":["o"]},{"start":{"row":64,"column":10},"end":{"row":64,"column":11},"action":"insert","lines":["p"]}],[{"start":{"row":65,"column":20},"end":{"row":65,"column":21},"action":"remove","lines":["s"],"id":175},{"start":{"row":65,"column":19},"end":{"row":65,"column":20},"action":"remove","lines":["w"]},{"start":{"row":65,"column":18},"end":{"row":65,"column":19},"action":"remove","lines":["e"]},{"start":{"row":65,"column":17},"end":{"row":65,"column":18},"action":"remove","lines":["n"]}],[{"start":{"row":65,"column":17},"end":{"row":65,"column":18},"action":"insert","lines":["s"],"id":176},{"start":{"row":65,"column":18},"end":{"row":65,"column":19},"action":"insert","lines":["h"]},{"start":{"row":65,"column":19},"end":{"row":65,"column":20},"action":"insert","lines":["o"]},{"start":{"row":65,"column":20},"end":{"row":65,"column":21},"action":"insert","lines":["p"]}],[{"start":{"row":68,"column":28},"end":{"row":68,"column":29},"action":"remove","lines":["s"],"id":177},{"start":{"row":68,"column":27},"end":{"row":68,"column":28},"action":"remove","lines":["w"]},{"start":{"row":68,"column":26},"end":{"row":68,"column":27},"action":"remove","lines":["e"]},{"start":{"row":68,"column":25},"end":{"row":68,"column":26},"action":"remove","lines":["n"]}],[{"start":{"row":68,"column":25},"end":{"row":68,"column":26},"action":"insert","lines":["s"],"id":178}],[{"start":{"row":68,"column":26},"end":{"row":68,"column":27},"action":"insert","lines":["h"],"id":179},{"start":{"row":68,"column":27},"end":{"row":68,"column":28},"action":"insert","lines":["o"]},{"start":{"row":68,"column":28},"end":{"row":68,"column":29},"action":"insert","lines":["p"]}],[{"start":{"row":68,"column":42},"end":{"row":68,"column":43},"action":"remove","lines":["s"],"id":180},{"start":{"row":68,"column":41},"end":{"row":68,"column":42},"action":"remove","lines":["w"]},{"start":{"row":68,"column":40},"end":{"row":68,"column":41},"action":"remove","lines":["e"]},{"start":{"row":68,"column":39},"end":{"row":68,"column":40},"action":"remove","lines":["n"]}],[{"start":{"row":68,"column":39},"end":{"row":68,"column":40},"action":"insert","lines":["s"],"id":181},{"start":{"row":68,"column":40},"end":{"row":68,"column":41},"action":"insert","lines":["h"]},{"start":{"row":68,"column":41},"end":{"row":68,"column":42},"action":"insert","lines":["o"]},{"start":{"row":68,"column":42},"end":{"row":68,"column":43},"action":"insert","lines":["p"]}],[{"start":{"row":68,"column":57},"end":{"row":68,"column":58},"action":"remove","lines":["s"],"id":182},{"start":{"row":68,"column":56},"end":{"row":68,"column":57},"action":"remove","lines":["w"]},{"start":{"row":68,"column":55},"end":{"row":68,"column":56},"action":"remove","lines":["e"]},{"start":{"row":68,"column":54},"end":{"row":68,"column":55},"action":"remove","lines":["n"]}],[{"start":{"row":68,"column":54},"end":{"row":68,"column":55},"action":"insert","lines":["s"],"id":183},{"start":{"row":68,"column":55},"end":{"row":68,"column":56},"action":"insert","lines":["h"]},{"start":{"row":68,"column":56},"end":{"row":68,"column":57},"action":"insert","lines":["o"]},{"start":{"row":68,"column":57},"end":{"row":68,"column":58},"action":"insert","lines":["p"]}],[{"start":{"row":74,"column":35},"end":{"row":74,"column":36},"action":"remove","lines":["s"],"id":184},{"start":{"row":74,"column":34},"end":{"row":74,"column":35},"action":"remove","lines":["w"]},{"start":{"row":74,"column":33},"end":{"row":74,"column":34},"action":"remove","lines":["e"]},{"start":{"row":74,"column":32},"end":{"row":74,"column":33},"action":"remove","lines":["N"]}],[{"start":{"row":74,"column":32},"end":{"row":74,"column":33},"action":"insert","lines":["S"],"id":185},{"start":{"row":74,"column":33},"end":{"row":74,"column":34},"action":"insert","lines":["h"]},{"start":{"row":74,"column":34},"end":{"row":74,"column":35},"action":"insert","lines":["o"]},{"start":{"row":74,"column":35},"end":{"row":74,"column":36},"action":"insert","lines":["p"]}],[{"start":{"row":76,"column":10},"end":{"row":76,"column":11},"action":"remove","lines":["s"],"id":186},{"start":{"row":76,"column":9},"end":{"row":76,"column":10},"action":"remove","lines":["w"]},{"start":{"row":76,"column":8},"end":{"row":76,"column":9},"action":"remove","lines":["e"]},{"start":{"row":76,"column":7},"end":{"row":76,"column":8},"action":"remove","lines":["n"]}],[{"start":{"row":76,"column":7},"end":{"row":76,"column":8},"action":"insert","lines":["s"],"id":187},{"start":{"row":76,"column":8},"end":{"row":76,"column":9},"action":"insert","lines":["h"]},{"start":{"row":76,"column":9},"end":{"row":76,"column":10},"action":"insert","lines":["o"]},{"start":{"row":76,"column":10},"end":{"row":76,"column":11},"action":"insert","lines":["p"]}],[{"start":{"row":76,"column":17},"end":{"row":76,"column":18},"action":"remove","lines":["s"],"id":188},{"start":{"row":76,"column":16},"end":{"row":76,"column":17},"action":"remove","lines":["w"]},{"start":{"row":76,"column":15},"end":{"row":76,"column":16},"action":"remove","lines":["e"]},{"start":{"row":76,"column":14},"end":{"row":76,"column":15},"action":"remove","lines":["N"]}],[{"start":{"row":76,"column":14},"end":{"row":76,"column":15},"action":"insert","lines":["S"],"id":189},{"start":{"row":76,"column":15},"end":{"row":76,"column":16},"action":"insert","lines":["h"]},{"start":{"row":76,"column":16},"end":{"row":76,"column":17},"action":"insert","lines":["o"]},{"start":{"row":76,"column":17},"end":{"row":76,"column":18},"action":"insert","lines":["p"]}],[{"start":{"row":80,"column":15},"end":{"row":81,"column":0},"action":"insert","lines":["",""],"id":190},{"start":{"row":81,"column":0},"end":{"row":81,"column":10},"action":"insert","lines":["          "]}],[{"start":{"row":81,"column":9},"end":{"row":81,"column":10},"action":"remove","lines":[" "],"id":191},{"start":{"row":81,"column":8},"end":{"row":81,"column":9},"action":"remove","lines":[" "]},{"start":{"row":81,"column":4},"end":{"row":81,"column":8},"action":"remove","lines":["    "]},{"start":{"row":81,"column":0},"end":{"row":81,"column":4},"action":"remove","lines":["    "]},{"start":{"row":80,"column":15},"end":{"row":81,"column":0},"action":"remove","lines":["",""]},{"start":{"row":80,"column":14},"end":{"row":80,"column":15},"action":"remove","lines":["s"]},{"start":{"row":80,"column":13},"end":{"row":80,"column":14},"action":"remove","lines":["w"]},{"start":{"row":80,"column":12},"end":{"row":80,"column":13},"action":"remove","lines":["e"]}],[{"start":{"row":80,"column":11},"end":{"row":80,"column":12},"action":"remove","lines":["n"],"id":192}],[{"start":{"row":80,"column":11},"end":{"row":80,"column":12},"action":"insert","lines":["s"],"id":193},{"start":{"row":80,"column":12},"end":{"row":80,"column":13},"action":"insert","lines":["h"]},{"start":{"row":80,"column":13},"end":{"row":80,"column":14},"action":"insert","lines":["o"]},{"start":{"row":80,"column":14},"end":{"row":80,"column":15},"action":"insert","lines":["p"]}],[{"start":{"row":83,"column":14},"end":{"row":83,"column":15},"action":"remove","lines":["s"],"id":194},{"start":{"row":83,"column":13},"end":{"row":83,"column":14},"action":"remove","lines":["w"]},{"start":{"row":83,"column":12},"end":{"row":83,"column":13},"action":"remove","lines":["e"]},{"start":{"row":83,"column":11},"end":{"row":83,"column":12},"action":"remove","lines":["n"]}],[{"start":{"row":83,"column":11},"end":{"row":83,"column":12},"action":"insert","lines":["s"],"id":195},{"start":{"row":83,"column":12},"end":{"row":83,"column":13},"action":"insert","lines":["h"]},{"start":{"row":83,"column":13},"end":{"row":83,"column":14},"action":"insert","lines":["o"]},{"start":{"row":83,"column":14},"end":{"row":83,"column":15},"action":"insert","lines":["p"]}],[{"start":{"row":85,"column":14},"end":{"row":85,"column":15},"action":"remove","lines":["s"],"id":196},{"start":{"row":85,"column":13},"end":{"row":85,"column":14},"action":"remove","lines":["w"]},{"start":{"row":85,"column":12},"end":{"row":85,"column":13},"action":"remove","lines":["e"]},{"start":{"row":85,"column":11},"end":{"row":85,"column":12},"action":"remove","lines":["n"]}],[{"start":{"row":85,"column":11},"end":{"row":85,"column":12},"action":"insert","lines":["s"],"id":197},{"start":{"row":85,"column":12},"end":{"row":85,"column":13},"action":"insert","lines":["h"]},{"start":{"row":85,"column":13},"end":{"row":85,"column":14},"action":"insert","lines":["o"]},{"start":{"row":85,"column":14},"end":{"row":85,"column":15},"action":"insert","lines":["p"]}],[{"start":{"row":85,"column":41},"end":{"row":85,"column":42},"action":"remove","lines":["s"],"id":198},{"start":{"row":85,"column":40},"end":{"row":85,"column":41},"action":"remove","lines":["w"]},{"start":{"row":85,"column":39},"end":{"row":85,"column":40},"action":"remove","lines":["e"]},{"start":{"row":85,"column":38},"end":{"row":85,"column":39},"action":"remove","lines":["n"]}],[{"start":{"row":85,"column":38},"end":{"row":85,"column":39},"action":"insert","lines":["s"],"id":199},{"start":{"row":85,"column":39},"end":{"row":85,"column":40},"action":"insert","lines":["h"]},{"start":{"row":85,"column":40},"end":{"row":85,"column":41},"action":"insert","lines":["o"]},{"start":{"row":85,"column":41},"end":{"row":85,"column":42},"action":"insert","lines":["p"]}],[{"start":{"row":92,"column":10},"end":{"row":92,"column":11},"action":"remove","lines":["s"],"id":200},{"start":{"row":92,"column":9},"end":{"row":92,"column":10},"action":"remove","lines":["w"]},{"start":{"row":92,"column":8},"end":{"row":92,"column":9},"action":"remove","lines":["e"]},{"start":{"row":92,"column":7},"end":{"row":92,"column":8},"action":"remove","lines":["n"]}],[{"start":{"row":92,"column":7},"end":{"row":92,"column":8},"action":"insert","lines":["s"],"id":201},{"start":{"row":92,"column":8},"end":{"row":92,"column":9},"action":"insert","lines":["h"]},{"start":{"row":92,"column":9},"end":{"row":92,"column":10},"action":"insert","lines":["o"]},{"start":{"row":92,"column":10},"end":{"row":92,"column":11},"action":"insert","lines":["p"]}],[{"start":{"row":92,"column":22},"end":{"row":92,"column":23},"action":"remove","lines":["s"],"id":202},{"start":{"row":92,"column":21},"end":{"row":92,"column":22},"action":"remove","lines":["w"]},{"start":{"row":92,"column":20},"end":{"row":92,"column":21},"action":"remove","lines":["e"]},{"start":{"row":92,"column":19},"end":{"row":92,"column":20},"action":"remove","lines":["n"]}],[{"start":{"row":92,"column":19},"end":{"row":92,"column":20},"action":"insert","lines":["s"],"id":203},{"start":{"row":92,"column":20},"end":{"row":92,"column":21},"action":"insert","lines":["h"]},{"start":{"row":92,"column":21},"end":{"row":92,"column":22},"action":"insert","lines":["o"]},{"start":{"row":92,"column":22},"end":{"row":92,"column":23},"action":"insert","lines":["p"]}],[{"start":{"row":88,"column":15},"end":{"row":88,"column":16},"action":"remove","lines":["w"],"id":204},{"start":{"row":88,"column":14},"end":{"row":88,"column":15},"action":"remove","lines":["e"]}],[{"start":{"row":88,"column":14},"end":{"row":88,"column":15},"action":"remove","lines":["s"],"id":205},{"start":{"row":88,"column":13},"end":{"row":88,"column":14},"action":"remove","lines":["n"]}],[{"start":{"row":88,"column":13},"end":{"row":88,"column":14},"action":"insert","lines":["s"],"id":206},{"start":{"row":88,"column":14},"end":{"row":88,"column":15},"action":"insert","lines":["h"]},{"start":{"row":88,"column":15},"end":{"row":88,"column":16},"action":"insert","lines":["o"]},{"start":{"row":88,"column":16},"end":{"row":88,"column":17},"action":"insert","lines":["p"]}],[{"start":{"row":88,"column":12},"end":{"row":88,"column":17},"action":"remove","lines":["$shop"],"id":207},{"start":{"row":88,"column":12},"end":{"row":88,"column":17},"action":"insert","lines":["$shop"]}],[{"start":{"row":89,"column":16},"end":{"row":89,"column":17},"action":"remove","lines":["s"],"id":208},{"start":{"row":89,"column":15},"end":{"row":89,"column":16},"action":"remove","lines":["w"]},{"start":{"row":89,"column":14},"end":{"row":89,"column":15},"action":"remove","lines":["e"]},{"start":{"row":89,"column":13},"end":{"row":89,"column":14},"action":"remove","lines":["n"]}],[{"start":{"row":89,"column":13},"end":{"row":89,"column":14},"action":"insert","lines":["s"],"id":209},{"start":{"row":89,"column":14},"end":{"row":89,"column":15},"action":"insert","lines":["h"]},{"start":{"row":89,"column":15},"end":{"row":89,"column":16},"action":"insert","lines":["o"]},{"start":{"row":89,"column":16},"end":{"row":89,"column":17},"action":"insert","lines":["p"]}],[{"start":{"row":89,"column":12},"end":{"row":89,"column":17},"action":"remove","lines":["$shop"],"id":210},{"start":{"row":89,"column":12},"end":{"row":89,"column":17},"action":"insert","lines":["$shop"]}],[{"start":{"row":90,"column":16},"end":{"row":90,"column":17},"action":"remove","lines":["s"],"id":211},{"start":{"row":90,"column":15},"end":{"row":90,"column":16},"action":"remove","lines":["w"]},{"start":{"row":90,"column":14},"end":{"row":90,"column":15},"action":"remove","lines":["e"]},{"start":{"row":90,"column":13},"end":{"row":90,"column":14},"action":"remove","lines":["n"]}],[{"start":{"row":90,"column":13},"end":{"row":90,"column":14},"action":"insert","lines":["s"],"id":212},{"start":{"row":90,"column":14},"end":{"row":90,"column":15},"action":"insert","lines":["h"]},{"start":{"row":90,"column":15},"end":{"row":90,"column":16},"action":"insert","lines":["o"]},{"start":{"row":90,"column":16},"end":{"row":90,"column":17},"action":"insert","lines":["p"]}],[{"start":{"row":90,"column":12},"end":{"row":90,"column":17},"action":"remove","lines":["$shop"],"id":213},{"start":{"row":90,"column":12},"end":{"row":90,"column":17},"action":"insert","lines":["$shop"]}],[{"start":{"row":106,"column":17},"end":{"row":106,"column":18},"action":"remove","lines":["s"],"id":214},{"start":{"row":106,"column":16},"end":{"row":106,"column":17},"action":"remove","lines":["w"]},{"start":{"row":106,"column":15},"end":{"row":106,"column":16},"action":"remove","lines":["e"]},{"start":{"row":106,"column":14},"end":{"row":106,"column":15},"action":"remove","lines":["N"]}],[{"start":{"row":106,"column":14},"end":{"row":106,"column":15},"action":"insert","lines":["S"],"id":215},{"start":{"row":106,"column":15},"end":{"row":106,"column":16},"action":"insert","lines":["h"]},{"start":{"row":106,"column":16},"end":{"row":106,"column":17},"action":"insert","lines":["o"]},{"start":{"row":106,"column":17},"end":{"row":106,"column":18},"action":"insert","lines":["p"]}],[{"start":{"row":106,"column":10},"end":{"row":106,"column":11},"action":"remove","lines":["s"],"id":216},{"start":{"row":106,"column":9},"end":{"row":106,"column":10},"action":"remove","lines":["w"]},{"start":{"row":106,"column":8},"end":{"row":106,"column":9},"action":"remove","lines":["e"]},{"start":{"row":106,"column":7},"end":{"row":106,"column":8},"action":"remove","lines":["n"]}],[{"start":{"row":106,"column":7},"end":{"row":106,"column":8},"action":"insert","lines":["s"],"id":217},{"start":{"row":106,"column":8},"end":{"row":106,"column":9},"action":"insert","lines":["h"]},{"start":{"row":106,"column":9},"end":{"row":106,"column":10},"action":"insert","lines":["o"]},{"start":{"row":106,"column":10},"end":{"row":106,"column":11},"action":"insert","lines":["p"]}],[{"start":{"row":113,"column":0},"end":{"row":113,"column":1},"action":"remove","lines":["}"],"id":218}],[{"start":{"row":100,"column":32},"end":{"row":100,"column":33},"action":"remove","lines":["s"],"id":219},{"start":{"row":100,"column":31},"end":{"row":100,"column":32},"action":"remove","lines":["w"]},{"start":{"row":100,"column":30},"end":{"row":100,"column":31},"action":"remove","lines":["e"]},{"start":{"row":100,"column":29},"end":{"row":100,"column":30},"action":"remove","lines":["n"]}],[{"start":{"row":100,"column":29},"end":{"row":100,"column":30},"action":"insert","lines":["s"],"id":220},{"start":{"row":100,"column":30},"end":{"row":100,"column":31},"action":"insert","lines":["h"]},{"start":{"row":100,"column":31},"end":{"row":100,"column":32},"action":"insert","lines":["o"]},{"start":{"row":100,"column":32},"end":{"row":100,"column":33},"action":"insert","lines":["p"]}],[{"start":{"row":95,"column":19},"end":{"row":95,"column":20},"action":"remove","lines":["w"],"id":221},{"start":{"row":95,"column":18},"end":{"row":95,"column":19},"action":"remove","lines":["e"]},{"start":{"row":95,"column":17},"end":{"row":95,"column":18},"action":"remove","lines":["n"]}],[{"start":{"row":95,"column":17},"end":{"row":95,"column":18},"action":"insert","lines":["s"],"id":222},{"start":{"row":95,"column":18},"end":{"row":95,"column":19},"action":"insert","lines":["h"]},{"start":{"row":95,"column":19},"end":{"row":95,"column":20},"action":"insert","lines":["o"]},{"start":{"row":95,"column":20},"end":{"row":95,"column":21},"action":"insert","lines":["p"]}],[{"start":{"row":96,"column":30},"end":{"row":96,"column":31},"action":"remove","lines":["s"],"id":223},{"start":{"row":96,"column":29},"end":{"row":96,"column":30},"action":"remove","lines":["w"]},{"start":{"row":96,"column":28},"end":{"row":96,"column":29},"action":"remove","lines":["e"]},{"start":{"row":96,"column":27},"end":{"row":96,"column":28},"action":"remove","lines":["n"]}],[{"start":{"row":96,"column":27},"end":{"row":96,"column":28},"action":"insert","lines":["s"],"id":224},{"start":{"row":96,"column":28},"end":{"row":96,"column":29},"action":"insert","lines":["h"]},{"start":{"row":96,"column":29},"end":{"row":96,"column":30},"action":"insert","lines":["o"]},{"start":{"row":96,"column":30},"end":{"row":96,"column":31},"action":"insert","lines":["p"]}],[{"start":{"row":109,"column":32},"end":{"row":109,"column":33},"action":"remove","lines":["s"],"id":225},{"start":{"row":109,"column":31},"end":{"row":109,"column":32},"action":"remove","lines":["w"]},{"start":{"row":109,"column":30},"end":{"row":109,"column":31},"action":"remove","lines":["e"]},{"start":{"row":109,"column":29},"end":{"row":109,"column":30},"action":"remove","lines":["n"]}],[{"start":{"row":109,"column":29},"end":{"row":109,"column":30},"action":"insert","lines":["s"],"id":226},{"start":{"row":109,"column":30},"end":{"row":109,"column":31},"action":"insert","lines":["h"]},{"start":{"row":109,"column":31},"end":{"row":109,"column":32},"action":"insert","lines":["o"]},{"start":{"row":109,"column":32},"end":{"row":109,"column":33},"action":"insert","lines":["p"]}],[{"start":{"row":95,"column":16},"end":{"row":95,"column":17},"action":"remove","lines":[" "],"id":227}],[{"start":{"row":96,"column":19},"end":{"row":96,"column":20},"action":"remove","lines":["s"],"id":228},{"start":{"row":96,"column":18},"end":{"row":96,"column":19},"action":"remove","lines":["w"]},{"start":{"row":96,"column":17},"end":{"row":96,"column":18},"action":"remove","lines":["e"]},{"start":{"row":96,"column":16},"end":{"row":96,"column":17},"action":"remove","lines":["n"]}],[{"start":{"row":96,"column":16},"end":{"row":96,"column":17},"action":"insert","lines":["s"],"id":229},{"start":{"row":96,"column":17},"end":{"row":96,"column":18},"action":"insert","lines":["h"]},{"start":{"row":96,"column":18},"end":{"row":96,"column":19},"action":"insert","lines":["o"]},{"start":{"row":96,"column":19},"end":{"row":96,"column":20},"action":"insert","lines":["p"]}],[{"start":{"row":7,"column":10},"end":{"row":7,"column":20},"action":"insert","lines":["controller"],"id":231}]]},"ace":{"folds":[],"scrolltop":1507,"scrollleft":0,"selection":{"start":{"row":7,"column":20},"end":{"row":7,"column":20},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1614557867053,"hash":"85081dc7712fb36a5079e6068538fd0f9dfd8b1e"}