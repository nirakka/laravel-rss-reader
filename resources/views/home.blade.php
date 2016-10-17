@extends('layouts.oishi')

@section('content')
    <div id="header-back">
    </div>
    <div id="articles_magazineview">
        <div class="article_magazine_content_wrap">
            <ul id="magazinelist">
                @foreach ($articles as $i)
                    <li>
                        <div class="article_magazine_content">
                            <!-- このaタグに記事のURLを挟めばOK -->
                            <a href="{{ $i->url}}"  target="_blank">
                                <div class="article_title">
                                    {{ $i->title  }}
                                </div>
                                <!-- url は別に表示しなくても良いかな？
                                     <div class="article_url">http://example.com/index.html</div>
                                   -->
                                <div class="article_content">
                                    <p class="textOverflow">
                                        {{ $i->content  }}
                                    </p>
                                </div>
                                <div class="article_footer clearfix">
                                    <span class="site_title">{{ $i->site()->first()->site_title }}</span>
                                    <span class="article_date">{{ date('d/m/Y', strtotime($i->date)) }}</span>
                                </div>
                            </a>
                            <!-- 記事下のアクションボタンはココから -->
                            <!-- 正直アイコンは何でも良いけど、とりあえず -->
                            <div class="action_buttons" id="{{ $i->id }}">
                                <button class="star-button btn">
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    お気に入り
                                </button>
                                <button class="read_later btn">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    既読
                                </button>
                                <button class="has_read btn">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    後で読む
                                </button>
                            </div>
                            <!-- 記事下のアクションボタンはココまで -->
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div>
        <div id="articles_listview">
            <div class="article_magazine_content_wrap">
                <ul id="listlist">
                    @foreach ($articles as $i)
                        <li>
                            <div class="article_list_content clearfix">
                                <div class="read_or_unread">
                                </div>
                                <div class="favo-icon">
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                </div>
                                <div class="site_title_listview">
                                    <!-- <a href={{ $i->url }} target="_blank">{{ $i->title  }}</a> -->
                                    {{ $i->site()->first()->site_title }}
                                </div>
                                <div class="article_title_listview">
                                    <!-- <a href="{{ $i->site()->first()->site_url }}" target="_blank">{{ $i->site()->first()->site_title }}</a> -->
                                    {{ $i->title  }}
                                </div>
                                <div class="article_date">{{ date('H:i', strtotime($i->date)) }}</div>
                            </div>
                            
                        </li>
                    @endforeach
                    <li>
                        <a href="">
                            <div class="article_list_content clearfix">
                                <div class="read_or_unread">
                                </div>
                                <div class="favo-icon">
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                </div>
                                <div class="site_title_listview">
                                    はじめてのWEBサイトはじめてのWEBサイト
                                </div>
                                <div class="article_title_listview">
                                    はじめての記事 30（リストビュー用でござんす）はじめての記事 30（リストビュー用でござんす）
                                </div>
                                <div class="article_date">27/09/2015</div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

@endsection

@section('endbody')
    @parent


    <script type="text/javascript">

     //変数[addText]と[Num]を宣言
     var Num = 1;

     $(document).ready(function() {
         $(window).bottom();
         $(window).bind("bottom", function() {
             var obj = $(this);

             //「loading」がfalseの時に実行する
             if (!obj.data("loading")) {

                 //「loading」をtrueにする
                 obj.data("loading", true);

                 //「Loading」画像を表示
                 $('#magazinelist').append('<li class="load-li" style="text-align: center;"><img src="/img/load.gif"></li>');

                 //追加する処理を記述
                 setTimeout(function() {
                     $('#magazinelist li:last').remove();

                     // 繰り返しfor文を記述
                     for (i=0; i<5; i++, Num++) {

                         //追加するhtmlを記述
                         // ここで追加の記事を出したい
                         $('#magazinelist').append(
                             '<li><div class="article_magazine_content"><div class="article_title">追加の記事'+Num+'</div><div class="article_content"><p class="textOverflow">これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。</p></div><div class="article_footer clearfix"><span class="site_title">はじめてのWEBサイト</span><span class="article_date">27/09/2015</span></div></div></li>'
                         );
                     }

                     //処理が完了したら「Loading...」をfalseにする
                     obj.data("loading", false);
                 }, 1000);
             }
         });
         $('html,body').animate({ scrollTop: 0 }, '1');
     });

     /* Create new Item */
     $(".crud-submit").click(function(e){
         e.preventDefault();
         var form_action = $("#create-item").find("form").attr("action");
         var user_id = $("#create-item").find("input[name='user_id']").val();
         var article_id = $("#create-item").find("textarea[name='article_id']").val();

         $.ajax({
             dataType: 'json',
             type:'POST',
             url: form_action,
             data:{user_id:user_id, article_id:article_id}
         }).done(function(data){

         });

     });
    </script>
@endsection
