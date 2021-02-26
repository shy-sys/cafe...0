<!DOCTYPE HEML>
 <html lang="ja">
   <head>
    <meta http-equiv="content-type" charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Styles -->
    {{-- Laravel標準で用意されているCSSを読みみます --}}
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    {{-- この章の後半で作成するCSSを読み込みます --}}
     <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">
    <title>Cafe House</title>
    </head>
   
   <body>
    <header>
    　<h1>Cafe House</h1>
   　　 <p>〜行きたいカフェが見つかる〜</p>
    </header>　　 
    <p class="btn_design">Login</p>
    <p class="btn_design">Sign up</p>
  <footer>
  <p class="copyright">(C) 2021 CafeHouse</p>
</footer>
   </body>
 </html>
