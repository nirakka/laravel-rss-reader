<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <title>Sign In | RSS REEEEEEEEEDER</title>


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
                        <img src=/favicon/favicon-196x196.png alt=RSS_Reader_icon >
                    </div>
                    <div id="title-box">
                        @yield('Title')

                    

                </div>
            </header>
            <div id="header-back">
            </div>

@yield('content')
    </body>
</html>
