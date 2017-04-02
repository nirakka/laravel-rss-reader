@extends('layouts.oishi')

@section('content')
    <div id="header-back">
    </div>
    <div id="articles_magazineview">
        <div class="article_magazine_content_wrap">
            <ul id="magazinelist">
                <!-- マガジンビューの時，各記事にお気に入り，後で読む，読んだのボタンを追加する -->
                @foreach ($articles as $i)
                    <li>
                        <div class="article_magazine_content" id="{{ $i->id }}">
                            <!-- このaタグに記事のURLを挟めばOK -->
                            <div class="has-read-flg">
                                <a href="{{ $i->url}}"  target="_blank">
                                    <div class="article_wrap">
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
                                            <span class="article_date">{{ date('Y/m/d', strtotime($i->date)) }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- 記事下のアクションボタンはココから -->
                            <!-- 正直アイコンは何でも良いけど、とりあえず -->

                            <div class="action_buttons" data-id="{{ $i->id }}">

                                <form action="/articles" method="POST" class="fav test1" @if (in_array($i->id, $fav_article)) style="display:none;" @endif>
                                    {{ csrf_field() }}
                                    <button type="submit" class="star-button btn" data-id="{{ $i->id }}">
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </button>
                                </form>
                                <form action="/delete-fav" method="POST" class="fav test1" @if (!in_array($i->id, $fav_article)) style="display:none;" @endif>
                                    {{ csrf_field() }}
                                    <button type="submit" class="favorited btn" data-id="{{ $i->id }}">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </button>
                                </form>


                                <form action="/read-later" method="POST" class="read-late test2" @if (in_array($i->id, $read_later)) style="display:none;" @endif>
                                    {{ csrf_field() }}
                                    <button type="submit" class="read-later btn" data-id="{{ $i->id }}">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    </button>
                                </form>
                                <form action="/delete-later" method="POST" class="read-late test2" @if (!in_array($i->id, $read_later)) style="display:none;" @endif>
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn read-later-flg" data-id="{{ $i->id }}">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    </button>
                                </form>

                                <form action="/has-read" method="POST" class="has-read-form test3"  @if (in_array($i->id, $has_read)) style="display:none;" @endif>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user_id" value="1">
                                    <input type="hidden" name="article_id" value="1">
                                    <button type="submit" class="has-read btn" data-id="{{ $i->id }}">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </button>
                                </form>
                                <form action="/delete-has-read" method="POST" class="has-read-form test3"  @if (!in_array($i->id, $has_read)) style="display:none;" @endif>
                                    {{ csrf_field() }}
                                    <button type="submit" class="del-has-read btn" data-id="{{ $i->id }}">
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
                <!-- リストビューの時，各記事にお気に入り，後で読む，読んだのボタンを追加する -->
                    @foreach ($articles as $i)
                        <li>
                            <a href="{{ $i->url }}" target="_blank" >
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
                                    <span class="article_title_listview_span">{{ $i->title  }} </span>
                                    <span class="article_content_listview_span">{{ $i->content  }}</span>
                                </div>
                                <div class="article_date">{{ date('Y/m/d', strtotime($i->date)) }}</div>
                            </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
@endsection

@section('endbody')
    @parent
    <script type="text/javascript">
    //スクロール用 jsの読み込み
    //WIP: blade template variable が/public/jsの中にある時，読み込まないためbladeの中に置いた．
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
         //お気に入りボタンが押されたとき
         $("#magazinelist").on('click','.star-button', function(e){
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
                 // console.log(article_id);
                 // console.log("light up done toggle");
             }).always(function(){
                 button.attr("disabled", false); 
             });
         });
         //お気に入りボタンが再度押されたとき
         $("#magazinelist").on('click', '.favorited', function(e){

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
                 // console.log('light  down done togle');
                 $('#' + article_id + ' .fav').toggle();
             }).fail(function(){
                 alert('Error occurred!');
             }).always(function(){
                 button.attr("disabled", false);
             });
         });

         //後で読む押されたとき
         $("#magazinelist").on('click','.read-later',function(e){
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
         //後で読む押された再度押された時
         $("#magazinelist").on('click','.read-later-flg',function(e){

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
         //記事読んだボタン押されたとき
         $("#magazinelist").on('click','.has-read',function(e){
             var article_id = $(this).parent().data('id');
             var button = $(this);
             button.attr("disabled", true);
             e.preventDefault();

             var user_id = {{ Auth::user()->id }};
             var article_id = $(this).data('id');

             $.ajax({
                 dataType: 'json',
                 type:'POST',
                 url: '/has-read',
                 data:{
                     user_id: user_id,
                     article_id: article_id
                 }
             }).done(function(){
                 $('#' + article_id + ' .has-read-form').toggle();
                 $('#' + article_id + ' .has-read-flg').toggleClass('article_magazine_hasread_wrapper');
             }).fail(function(){
                 alert('Error occurred!');
             }).always(function(){
                 button.attr("disabled", false);
             });
         });
         //記事読んだボタン再度押されたとき
         $("#magazinelist").on('click','.del-has-read',function(e){
             var article_id = $(this).parent().data('id');
             var button = $(this);
             button.attr("disabled", true);
             e.preventDefault();

             var user_id = {{ Auth::user()->id }};
             var article_id = $(this).data('id');

             $.ajax({
                 dataType: 'json',
                 type:'POST',
                 url: '/del-has-read',
                 data:{
                     user_id: user_id,
                     article_id: article_id
                 }
             }).done(function(){
                 $('#' + article_id + ' .has-read-form').toggle();
                 $('#' + article_id + ' .has-read-flg').toggleClass('article_magazine_hasread_wrapper');                 
             }).fail(function(){
                 alert('Error occurred!');
             }).always(function(){
                 button.attr("disabled", false);
             });
         });

    //スクロール
    //ローディング画像のトッグル
    var LoadPicToggle =0;
    //マガジンビューのページ番号管理
    var pageNumMagazine =2;
    //リストビューのページ番号管理
    var pageNumList = 2;
    //コントローラへページ番号を送信する時しよう
    var pageNum;
    var contains = function(needle) {
    // Per spec, the way to identify NaN is that it is not equal to itself
        var findNaN = needle !== needle;
        var indexOf;

        if(!findNaN && typeof Array.prototype.indexOf === 'function') {
            indexOf = Array.prototype.indexOf;
        } else {
            indexOf = function(needle) {
                var i = -1, index = -1;
                for(i = 0; i < this.length; i++) {
                    var item = this[i];
                    if((findNaN && item !== item) || item === needle) {
                        index = i;
                        break;
                    }
                }
            return index;
            };
        }
        return indexOf.call(this, needle) > -1;
    };

     $(document).ready(function() {
         $(window).bottom();
         //下までスクロールするとスクロール機能が起動
         $(window).bind("bottom", function() {
            //ユーザid, トークン取得
             var user_id = {{ Auth::user()->id }};
             var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
             if(LoadPicToggle==0){
                LoadPicToggle = 1;
                var obj = $(this);
                //「loading」がfalseの時に実行する
                if (!obj.data("loading"))
                {
                    var base_url = window.location.origin;
                     //「loading」をtrueにする拡張
                    if(flag === 0) {
                        $('#magazinelist').append('<li class="load-li" style="text-align: center;"><img src="'+base_url+'/img/load.gif"></li>');
                    } else if(flag === 1) {
                        $('#listlist').append('<li class="load-li" style="text-align: center;"><img src="'+base_url+'/img/load.gif"></li>');
                    }
                    if(flag==1){
                        pageNum=pageNumList;
                    }else {
                        pageNum=pageNumMagazine;
                    }
                    var getLink;
                    var url=window.location.href;
                    //特定サイトが選択されているかpidを確認
                    if(url.indexOf("pid=") >= 0){
                        //pid がある，
                        var digitEnd=url.indexOf("pid=")+4;
                        do{
                            var letter = url[digitEnd];
                                // console.log(letter);
                                if(!isNaN(letter))
                                    digitEnd++;
                                else break;
                                break;
                        }while(true);
                        //スクロールのために必要なリンクを生成
                        getLink= '/tempArticleGet/pid='+ url.substring(url.indexOf("pid=")+4,++digitEnd) ;
                    }else 
                        getLink= '/tempArticleGet'
                    $.ajax({
                        dataType: 'json',
                        type:'GET',
                        url: getLink,
                        data:{
                            _token: CSRF_TOKEN,
                             page: pageNum
                        },
                        failure: function(data) {
                            alert('failed');
                        }
                        }).done(function(data){
                            // console.log(data);
                            pageNum = pageNum +1 ;
                            if(flag==1){
                                pageNumList=pageNumList+1;
                            // console.log(pageNumList);
                            }else {
                                pageNumMagazine=pageNumMagazine+1;
                                // console.log(pageNumMagazine);
                            }

                            //flagによって，magazine ka list ka wo kimeru
                            if(flag==1){
                            //list
                            //記事の末尾からアッペンド(pagination が初期値１５)
                                var articleNum = 15;

                                //追加する処理を記述
                                setTimeout(function(){
                                    $('#listlist li:last').remove();
                                for (i=0; i<15; i++)
                                {
                                    $('#listlist').append( 
                                        '<li>'+
                                            '<a href="'+data.articles.data[i].url+'">'+
                                                '<div class="article_list_content clearfix">'+
                                                    '<div class="read_or_unread"></div>'+
                                                    '<div class="favo-icon">'+
                                                        '<i class="fa fa-star-o" aria-hidden="true"></i>'+
                                                    '</div>'+
                                                    '<div class="site_title_listview">'+data.site_title_scroll[i]+'</div>'+
                                                    '<div class="article_title_listview">'+
                                                        '<span class="article_title_listview_span">'+data.site_title_scroll[i]+' </span>'+
                                                        '<span class="article_content_listview_span">'+data.articles.data[i].title+'</span>'+
                                                    '</div>'+
                                                    '<div class="article_date">'+data.site_date_scroll[i]+'</div>'+
                                                '</div>'+
                                            '</a>'+
                                        '</li>');}
                                 //処理が完了したら「Loading...」をfalseにする
                                 obj.data("loading", false);
                                 LoadPicToggle=0;
                                }, 1000);
                            }else if(flag==0){
                                //magazineview
                                //dataに格納された記事を全記事の末尾からアッペンド(pagination が初期値１５)
                                var articleNum = 15;
                                 //
                                 setTimeout(function(){
                                    $('#magazinelist li:last').remove();
                                    var favarticle1;
                                    var favarticle2;
                                    var readLater1;
                                    var readLater2;
                                    var hasRead1;
                                    var hasRead2;

                                    for (i=0; i<15; i++)
                                    {
                                        if(contains.call(data.fav_article,data.articles.data[i].id)){
                                            favarticle1='style="display:none"';
                                            favarticle2='';
                                        }else {
                                            favarticle1='';
                                            favarticle2='style="display:none"'};
                                        if(contains.call(data.read_later[i],data.articles.data[i].id)){
                                            readLater1='style="display:none"';
                                            readLater2='';
                                        }else{
                                            readLater2='style="display:none"';
                                            readLater1='';
                                        }
                                        if(contains.call(data.has_read[i],data.articles.data[i].id)){
                                            hasRead1='style="display:none"';
                                            hasRead2='';
                                        }else{
                                            hasRead2='style="display:none"';
                                            hasRead1='';
                                        }  
                                         $('#magazinelist').append(
                                            '<li>'+
                                                '<div class="article_magazine_content" id="'+data.articles.data[i].id+'">'+
                                                    '<div class="has-read-flg">'+
                                                        '<a href="'+data.articles.data[i].url+'" target="_blank"><div class="article_wrap">'+
                                                            '<div class="article_title">'+data.articles.data[i].title+'</div>'+
                                                            '<div class="article_content"><p class="textOverflow">'+data.articles.data[i].content+'</p></div>'+
                                                            '<div class="article_footerclearfix">'+
                                                                '<span class="site_title">'+data.site_title_scroll[i]+'</span>'+
                                                                '<span class="article_date" >'+data.site_date_scroll[i]+'</span></div>'+
                                                        '</div></a></div>'+
                                                    '<div class="action_buttons" data-id="'+data.articles.data[i].id+'"> '+
                                                        '<form action="/articles" method="POST" class="fav test1" '+favarticle1+'>{{csrf_field()}}'+
                                                            '<button type="submit" class="star-button btn" data-id="'+data.articles.data[i].id+'">'+
                                                                '<i class="fa fa-star-o" aria-hidden="true"></i>'+
                                                            '</button></form>'+
                                                        '<form action="/delete-fav" method="POST" class="fav test1" '+favarticle2+'>{{csrf_field()}}'+
                                                            '<button type="submit" class="favorited btn" data-id="'+data.articles.data[i].id+'">'+
                                                                '<i class="fa fa-star" aria-hidden="true"></i></button></form>'+
                                                        '<form action="/read-later" method="POST" class="read-late test2" '+readLater1+'>{{csrf_field()}}'+
                                                            '<button type="submit" class="read-later btn" data-id="'+data.articles.data[i].id+'">'+
                                                                '<i class="fa fa-clock-o" aria-hidden="true"></i></button></form>'+
                                                        '<form action="/delete-later" method="POST" class="read-late test2" '+readLater2+'>{{csrf_field()}}'+
                                                            '<button type="submit" class="btn read-later-flg" data-id="'+data.articles.data[i].id+'">'+
                                                                '<i class="fa fa-clock-o" aria-hidden="true"></i></button></form>'+
                                                        '<form action="/has-read" method="POST" class="has-read-form test3" '+hasRead1+'>{{csrf_field()}}'+
                                                            '<input type="hidden" name="user_id" value="1"><input type="hidden" name="article_id" value="1">'+
                                                            '<button type="submit" class="has-read btn" data-id="'+data.articles.data[i].id+'">'+
                                                                '<i class="fa fa-check" aria-hidden="true"></i></button></form>'+
                                                        '<form action="/delete-has-read" method="POST" class="has-read-form test3" '+hasRead2+'>{{csrf_field()}}'+
                                                            '<button type="submit" class="del-has-read btn" data-id="'+data.articles.data[i].id+'">'+
                                                                '<i class="fa fa-check" aria-hidden="true"></i></button></form>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</li>');}
                                 //処理が完了したら「Loading...」をfalseにする
                                 obj.data("loading", false);
                                 LoadPicToggle=0;
                             }, 1000);}
                        else{
                            console.log("flag error");
                            }
                 });}}
         });
         $('html,body').animate({ scrollTop: 0 }, '1');
     });

    //サイト追加ボタンを押した時，
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
     // エンターキーを押したときサイト追加が実行される
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

    <!-- css 切り替え用 スクリプト -->
    <script type="text/javascript" src="/js/changeViewMode.js"></script>

@endsection