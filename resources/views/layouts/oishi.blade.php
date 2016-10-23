<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="/favicon/favicon.ico" type="image/vnd.microsoft.icon">
        <link rel="icon" href="/favicon/favicon.ico" type="image/vnd.microsoft.icon">
        <link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="/favicon/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="/favicon/favicon-48x48.png" sizes="48x48">
        <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="/favicon/favicon-160x160.png" sizes="96x96">
        <link rel="icon" type="image/png" href="/favicon/favicon-196x196.png" sizes="96x96">
        <link rel="icon" type="image/png" href="/favicon/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="/favicon/favicon-32x32.png" sizes="32x32">



        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        <script>
         window.Laravel = <?php echo json_encode([
             'csrfToken' => csrf_token(),
         ]); ?>
        </script>
        <!-- <link rel="stylesheet" href="/css/bootstrap.min.css"> -->
        <link href="/css/reset.css" type="text/css" rel="stylesheet" />
        <link href="/css/style.css" type="text/css" rel="stylesheet" />


        <link href="/css/jquery.mmenu.css" type="text/css" rel="stylesheet" />

        <!-- Google Webfont -->
        <link href="http://fonts.googleapis.com/css?family=BioRhyme" rel="stylesheet" type="text/css">

        <!-- font awesome -->
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet" />


    </head>
    <body>
        <div id="wrap">
            <header id="header">
                <div id="header-innner-wrap">
                    <div id="menu-button">
                        <a href="#my-menu" title="menu"><i class="fa fa-bars" aria-hidden="true"></i></a>
                    </div>
                    <div id="title-box">
                        <div id="title-overflow">
                            <h1 id="title">{{$title_name}}</h1>
                        </div>
                        <span id="info-about-current-page">Information related this page.</span>
                    </div>
                    <div id="header-buttons">
                        <ul id="dropmenu">
                            <li id="view-changer">
                                <div id="setting-button">
                                    <i title="Change view mode" class="fa fa-cog" aria-hidden="true"></i>
                                </div>
                                <ul>
                                    <li><a href="#articles_magazineview" onclick="magazineViewMode()">Magazine view</a></li>
                                    <li><a href="#articles_listview" onclick="listViewMode()">List view</a></li>
                                </ul>
                            </li>
                            <li>
                                <div id="check-button">
                                    <i title="Mark as read" class="fa fa-check" aria-hidden="true"></i>
                                </div>
                                <ul>
                                    <li><a href="#">Older than one day</a></li>
                                    <li><a href="#">Older than two days</a></li>
                                    <li><a href="#">Older than a week</a></li>
                                    <li><a href="#">Older than two weeks</a></li>
                                    <li><a href="#">Older than a month</a></li>

                                </ul>
                            </li>
                            <li>
                                <div id="reload-button">
                                    <a href="#" title="Reload"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

    @yield('content')


            <div id="my-menu">
                <div id="wrap_my_menu">
                    <div id="wrap_user_info" class="clearfix">
                        <!--検索ボックス ココから -->
                        <div id="search_box">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <input type="text" id="searchText" placeholder=" Search box">
                        </div>
                        <!--検索ボックス ココまで -->

                        <img src="/img/profile.jpg" class="user_photo" width="50" height="50" alt="Nobuyuki's photo">
                        <div id="user_info">
                            <!-- フォントサイズ変えたいかも -->
                            <p id="user_name">{{$username}}</p>
                            <p id="user_mail">{{$useremail}}</p>
                        </div>
                    </div>
                    <dl id="box1">
                      <dt>何かタイトル</dt>
                      <dd>
                        <ul>
                          <li><a href="/read-later"><i class="fa fa-clock-o" aria-hidden="true"></i> あとで読む</a></li>
                          <li><a href="/favorite"><i class="fa fa-star-o" aria-hidden="true"></i> お気に入り</a></li>
                        </ul>
                      </dd>
                    </dl>
                    <dl id="box2">
                     <!-- 購読サイト追加部 始まり-->
                    <dt class="clearfix">
                        <span class="float-left">購読サイト一覧</span>
                        <input id="add-sites-edit" name="add-sites" style="display:none;" placeholder=" Feed's url">
                        <i id="add-sites" class="fa fa-plus-square-o" aria-hidden="true"></i>
                    </dt>
                             <!-- 購読サイト追加部 終わり-->
                         <dd>
                        <ul>

                                <li><a href="/home">All Articles</a></li>

                            @foreach( $user_reg_sites as $user_reg_site )
                                <li><a href="/home/pid={{$user_reg_site->id}}">{{$user_reg_site->site_title}} (未読数出したい)</a></li>
                            @endforeach
                        </ul>
                      </dd>
                    </dl>
                    <dl id="box3">
                      <dt>設定</dt>
                      <dd>
                        <ul>
                          <li><a href="/sites_regs">購読サイト設定</a></li>
                          <li><a href="">設定項目2</a></li>
                          <li><a href="">設定項目3</a></li>
                          <li><a href="/logout">ログアウト</a></li>
                        </ul>
                      </dd>
                    </dl>
                </div>
            </div>
        </div>
        @section('endbody')


        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" ></script>

        <!-- textOverflow -->
        <script src="/js/jquery.textOverflowEllipsis.js"></script>

        <!-- スクロールでコンテンツ自動読み込み -->
        <script src="/js/jquery.bottom-1.0.js"></script>

        <!-- 購読サイト追加用のボックスを表示 -->

        <script type="text/javascript">

         $(document).ready(function() {
             $("#my-menu").mmenu();
         });

         $("#add-sites-edit").keyup(function(event){
         if(event.keyCode == 13){
            var siteLink = document.getElementById("add-sites-edit").value;
            // console.log(siteLink);
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                 dataType: 'json',
                 type:'POST',
                 url: '/sites',
                 data:{
                    _token: CSRF_TOKEN ,
                    site_reg : siteLink
                 },
                 statusCode: {
                   404: function () {
                       //do somethign with error 404
                       alert('Error: 404: Could not contact server.');
                   },
                   500: function () {
                       //do something with error 500
                       alert('Error: 500: Server error occurred.');
                   },
                   200: function () {
                       //do something with error 500
                       alert('Success 200 : Successfully added.');
                   }
                 },
                success: function(data) {
                    alert('success');
                },
                failure: function(data) {
                    alert('failed');
                }

                 }).done(function(){
                    alert('Done!');
                 });

            }
        });

        </script>

        <script src="/js/jquery.mmenu.min.js" type="text/javascript"></script>

        <!-- ui tabs.js -->
        <script type="text/javascript" src="/js/ui.core.js"></script>
        <script type="text/javascript" src="/js/ui.tabs.js"></script>
        <script type="text/javascript">
         $(function() {
             /* selected: N で初期の番号指定 */
             $('#view-changer > ul').tabs();
         });
         
         $("#reload-button").on('click',function(e){
            
             $.ajax({
                 type:'get',
                 url: '/rss',
             }).done(function(){
                 window.location = '/home';
             }).always(function(){

             });
         });
        </script>

        @show

    </body>
</html>
