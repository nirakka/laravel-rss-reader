<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <title>RSS READER</title>


        <link href="css/reset.css" type="text/css" rel="stylesheet" />
        <link href="css/style.css" type="text/css" rel="stylesheet" />


        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" ></script>
        <script src="js/jquery.mmenu.min.js" type="text/javascript"></script>
        <link href="css/jquery.mmenu.css" type="text/css" rel="stylesheet" />

        <!-- Google Webfont -->
        <link href="http://fonts.googleapis.com/css?family=BioRhyme" rel="Stylesheet" type="text/css">

        <!-- font awesome -->
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet" />

        <!-- textOverflow -->
        <script src="js/jquery.textOverflowEllipsis.js"></script>

        <!-- スクロールでコンテンツ自動読み込み -->
        <script src="js/jquery.bottom-1.0.js"></script>

        <!-- ui tabs.js -->
        <script type="text/javascript" src="js/ui.core.js"></script>
        <script type="text/javascript" src="js/ui.tabs.js"></script>
        <script type="text/javascript">
            $(function() {
            /* selected: N で初期の番号指定 */
            $('#view-changer > ul').tabs();
            });
        </script>
    </head>
    <body>
        <div id="wrap">
            <header id="header">
                <div id="header-innner-wrap">
                    <div id="menu-button">
                        <a href="#my-menu" title="menu"><i class="fa fa-bars" aria-hidden="true"></i></a>
                    </div>
                    <div id="title-box">
                        <h1 id="title">ALL Articles</h1>
                        <span id="info-about-current-page">Information related this page.</span>
                    </div>
                    <div id="header-buttons">
                        <ul id="dropmenu">
                            <li id="view-changer">
                                <div id="setting-button">
                                    <i title="Change view mode" class="fa fa-cog" aria-hidden="true"></i>
                                </div>
                                <ul>
                                    <li><a href="#articles_magazineview">Magazine view</a></li>
                                    <li><a href="#articles_listview">List view</a></li>
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
            <div id="header-back"> <!-- kotei suru tame  -->
            </div>

            <div id="my-menu">
                <div id="wrap_my_menu">
                    <div id="wrap_user_info" class="clearfix">
                        <img src="img/profile.jpg" class="user_photo" width="50" height="50" alt="Nobuyuki's photo">
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
                          <li><a href=""><i class="fa fa-clock-o" aria-hidden="true"></i> あとで読む</a></li>
                          <li><a href=""><i class="fa fa-star-o" aria-hidden="true"></i> お気に入り</a></li>
                        </ul>
                      </dd>
                    </dl>
                    <dl id="box2">
                      <dt>購読サイト一覧</dt>
                      <dd>
                        <ul>
                          <li><a href=""> nobuyukioishi.com (未読数出したい)</a></li>
                          <li><a href=""> godaiazuma.com (未読数)</a></li>
                          <li><a href=""> aokii.com (未読数)</a></li>
                          <li><a href=""> eeegggiiiiiii.com (未読数)</a></li>
                        </ul>
                      </dd>
                    </dl>
                    <dl id="box3">
                      <dt>設定</dt>
                      <dd>
                        <ul>
                          <li><a href="">設定項目1</a></li>
                          <li><a href="">設定項目2</a></li>
                          <li><a href="">設定項目3</a></li>
                          <li><a href="">設定項目4</a></li>
                        </ul>
                      </dd>
                    </dl>
                </div>
                <ul>
                    <li><a href="">メニュー1</a></li>
                    <li><a href="">メニュー2</a>
                      <ul>
                        <li><a href="#about/team/management">Management</a>
                            <ul>
                                <li><a href="#about/team/management">Management</a></li>
                                <li><a href="#about/team/sales">Sales</a></li>
                                <li><a href="#about/team/development">Development</a></li>
                            </ul>
                         </li>
                         <li><a href="#about/team/sales">Sales</a></li>
                         <li><a href="#about/team/development">Development</a></li>
                        </ul>
                    </li>
                    <li><a href="">メニュー3</a></li>
                    <li><a href="">メニュー4</a></li>
                    <li><a href="">メニュー5</a></li>
                </ul>
            </div>
        </div>
        <script type="text/javascript">
           $(document).ready(function() {
              $("#my-menu").mmenu();
           });
        </script>

    @yield('content')
    @section('endbody')

    </body>
</html>
