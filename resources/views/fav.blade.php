@extends('layouts.oishi')

@section('content')
    <div id="header-back">
    </div>
    <div id="articles_magazineview">
        <div class="article_magazine_content_wrap">
            <ul id="magazinelist">

                @foreach ($articles as $i)
                    <li>
                        <div class="article_magazine_content" id="{{ $i->article()->first()->id }}">
                            <!-- このaタグに記事のURLを挟めばOK -->
                            <a href="{{ $i->url}}"  target="_blank">
                                <div class="article_wrap">
                                    <div class="article_title">
                                        {{ $i->article()->first()->title  }}
                                    </div>
                                    <!-- url は別に表示しなくても良いかな？
                                         <div class="article_url">http://example.com/index.html</div>
                                       -->
                                    <div class="article_content">
                                        <p class="textOverflow">
                                            {{ $i->article()->first()->content  }}
                                        </p>
                                    </div>
                                    <div class="article_footer clearfix">
                                        <span class="site_title">{{ $i->article()->first()->site()->first()->site_title }}</span>
                                        <span class="article_date">{{ date('Y/m/d', strtotime($i->article()->first()->date)) }}</span>
                                    </div>
                                </div>
                            </a>
                            <!-- 記事下のアクションボタンはココから -->
                            <!-- 正直アイコンは何でも良いけど、とりあえず -->
                            <div class="action_buttons" data-id="{{ $i->article()->first()->id }}" style="display:inline;">
                                
                                <form action="/articles" method="POST" class="fav" @if (in_array($i->article()->first()->id, $fav_article)) style="display:none;" @endif>
                                      {{ csrf_field() }}
                                      
                                    <button type="submit" class="star-button btn" data-id="{{ $i->article()->first()->id }}">
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </button>

                                </form>
                                
                                <form action="/delete-fav" method="POST" class="fav" @if (!in_array($i->article()->first()->id, $fav_article)) style="display:none;" @endif>
                                      {{ csrf_field() }}
                                      
                                    <button type="submit" class="favorited btn" data-id="{{ $i->article()->first()->id }}">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </button>

                                </form>

                                <form action="">
                                    </button>
                                    <button type="submit" class="read-later btn">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    </button>
                                </form>
                                <form action="">
                                    <button type="submit" class="has-read btn">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </button>
                                </form>
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
                                    <!-- <a href={{ $i->article()->first()->url }} target="_blank">{{ $i->article()->first()->title  }}</a> -->
                                    {{ $i->article()->first()->site()->first()->site_title }}
                                </div>
                                <div class="article_title_listview">
                                    <!-- <a href="{{ $i->article()->first()->site()->first()->site_url }}" target="_blank">{{ $i->article()->first()->site()->first()->site_title }}</a> -->
                                    {{ $i->article()->first()->title  }}
                                </div>
                                <div class="article_date">{{ date('H:i', strtotime($i->article()->first()->date)) }}</div>
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

     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
     
     $(function(){
         
         $(".star-button").click(function(e){
             // 多重送信を防ぐため通信完了までボタンをdisableにする
             var button = $(this);
             button.attr("disabled", true);
             e.preventDefault();
             
             var user_id = {{ Auth::user()->id }};
             var article_id = $(this).data('id');
             var art_id_sel = '#' + article_id + ' .star-button';
             $.ajax({
                 dataType: 'json',
                 type:'POST',
                 url: '/articles',
                 data:{
                     user_id: user_id,
                     article_id: article_id
                 }
             }).done(function(){
                 $('#' + article_id + ' .fav').toggle();
             }).always(function(){
                 button.attr("disabled", false); 
             });
         });
         $(".favorited").click(function(e){
             var button = $(this);
             button.attr("disabled", true);
             e.preventDefault();

             var user_id = {{ Auth::user()->id }};
             var article_id = $(this).data('id');
             var art_id_sel = '#' + article_id + ' .favorited';
             $.ajax({
                 dataType: 'json',
                 type:'POST',
                 url: '/delete-fav',
                 data:{
                     user_id: user_id,
                     article_id: article_id
                 }
             }).done(function(){
                 $('#' + article_id + ' .fav').toggle(); 
             }).fail(function(){
                 alert('Error occurred!');
             }).always(function(){
                 button.attr("disabled", false);
             });
         });

         $(".read-later").click(function(e){
             // 多重送信を防ぐため通信完了までボタンをdisableにする
             var button = $(this);
             button.attr("disabled", true);
             e.preventDefault();
             
             var user_id = {{ Auth::user()->id }};
             var article_id = $(this).data('id');
             //var art_id_sel = '#' + article_id + ' .read-later';

             $.ajax({
                 dataType: 'json',
                 type:'POST',
                 url: '/read-later',
                 data:{
                     user_id: user_id,
                     article_id: article_id
                 }
             }).done(function(){
                 $('#' + article_id + ' .read-late').toggle();
             }).always(function(){
                 button.attr("disabled", false); 
             });
         });

         $(".read-later-flg").click(function(e){
             
             var button = $(this);
             button.attr("disabled", true);
             e.preventDefault();

             var user_id = {{ Auth::user()->id }};
             var article_id = $(this).data('id');

             $.ajax({
                 dataType: 'json',
                 type:'POST',
                 url: '/delete-later',
                 data:{
                     user_id: user_id,
                     article_id: article_id
                 }
             }).done(function(){
                 $('#' + article_id + ' .read-late').toggle(); 
             }).fail(function(){
                 alert('Error occurred!');
             }).always(function(){
                 button.attr("disabled", false);
             });
         });
         

         $(".read-later").click(function(){
             $(this).toggleClass('read-later-flg');
         });
         $(".has-read").click(function(){
             var article_id = $(this).parent().data('id');
             $('#' + article_id + ' .article_wrap').toggleClass('has-read-flg');

         });
     });


     
     //変数[addText]と[Num]を宣言
     var Num = 1;
     // var link = $articles->nextPageUrl();

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

     

     $('#add-sites').click(function() {
         //$('#add-sites').css( 'display', 'none');
         $('#add-sites-edit')
             .val( $( '#add-sites').text())
             .toggle('slow')
             .focus();
     });

     $('#add-sites-edit').blur(function() {
         $('#add-sites-edit').toggle('slow');
     });

     $("#search_box").keyup(function(event){
         if(event.keyCode == 13){
             var searchLink = document.getElementById("searchText").value;
             var str1= "http://homestead.app/search?searchWord=";
             var searchLink= str1.concat(searchLink);
             // console.log(searchLink);
             window.location.href= searchLink;
         }
     });
    </script>
@endsection